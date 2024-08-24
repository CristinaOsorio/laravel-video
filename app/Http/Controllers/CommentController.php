<?php

namespace App\Http\Controllers;

use App\Http\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request) {
        $validate = $this->validate($request, [
            'body' => 'required',
        ]);

        $comment = new Comment();
        $user = Auth::user();

        $comment->user_id = $user->id;
        $comment->video_id = $request->input('video_id');
        $comment->body = $request->input('body');
        $comment->save();

        return redirect()
                        ->route('video.detail', ['video_id' => $comment->video_id])
                        ->with('message', 'Comentado añadido correctamente.');

    }

    public function delete($commet_id) {

        $user = Auth::user();
        $comment = Comment::find($commet_id);

        if($user && ($comment->user_id == $user->id || $comment->video->user_id == $user->id)) {
            $comment->delete();
        }

        return redirect()
                        ->route('video.detail', ['video_id' => $comment->video_id])
                        ->with('message', 'El comentario a sido eliminado exitosamente.');

    }
}
