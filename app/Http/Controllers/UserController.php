<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
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
    
    public function channel($user_id) {
        $user = User::find($user_id);
        if (!is_object($user)) {
            return redirect()->route('home');
        }
        $videos = Video::withCount('likes')->withCount('dislikes')->where('user_id', $user_id)->paginate(5);
        return view('user.channel')->with('user', $user)->with('videos', $videos);
    }
}
