<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Models\User;
use App\Http\Models\Video;

class UserController extends Controller
{
    public function index()
    {
        // Aquí va la lógica que tenías en la Closure
        return response()->json(['message' => 'Hello, user!']);
    }
    
    public function channel(Request $request,$user_id) {
        $user = User::find($user_id);

        if (!is_object($user)) {
            return redirect()->route('home');
        }

        $filter = $request->input('sort', "recent");
        $filterConfig = config("filters.{$filter}");
        
        $videos = Video::withCount('likes', 'dislikes', 'comments')
            ->where('user_id', $user_id)
            ->orderBy($filterConfig['order_by'], $filterConfig['direction'])
            ->paginate(12);

        if ($request->ajax()) {
            return view('user.partials.videos', compact('videos'))->render();
        }

        return view('user.channel', compact('user', 'videos'));

    }

    public function edit() {
        return view('user.profile');
    }


}
