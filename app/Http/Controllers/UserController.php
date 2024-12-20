<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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

    public function update(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nickname' => 'required|string|max:255',
            'image' => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ]);

        $id = Auth::id();
        $user = User::findOrFail($id);

        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->nickname = $request->input('nickname');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '-' . $image->getClientOriginalName();
            Storage::disk('images/profile')->put($imageName, File::get($image));

            if ($user->image && Storage::disk('images/profile')->exists($user->image)) {
                Storage::disk('images/profile')->delete($user->image);
            }

            $user->image = $imageName;
        }

        $user->save();

        return redirect()->back()->with('message', 'Perfil actualizado correctamente.');
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:3|confirmed',
        ], [
            'current_password.required' => __('user.security.validation.current_password'),
            'new_password.required' => __('user.security.validation.new_password'),
            'new_password.min' => __('user.security.validation.password_min'),
            'new_password.confirmed' => __('user.security.validation.password_confirmed'),
        ]);

        // Verifica si la contraseña actual es correcta
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            throw ValidationException::withMessages([
                'current_password' => __('user.security.validation.incorrect_password'),
            ]);
        }

        // Actualiza la contraseña del usuario
        $id = Auth::id();
        $user = User::findOrFail($id);
        $user->password = Hash::make($request->new_password);
        $user->save();
        

        return redirect()->back()->with('message', __('user.profile.message.success'));
    }

    public function getImage($filename) {
        $file = Storage::disk('images/profile')->get($filename);
        return new Response($file, 200);
    }

    public function destroy(Request $request) {
        $id = Auth::id();
        $user = User::findOrFail($id);

        $user->delete();

        return redirect('/')->with('message', 'Tu cuenta ha sido eliminada permanentemente.');
    }

}
