<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Models\Video;

class VideoController extends Controller
{


    public function create() {
        return view('video.create');
    }

    public function store(Request $request) {
        $validated = $this->validate($request, [
            'title' => 'required|min:5',
            'description' => 'required',
            'video'  => 'required|mimes:mp4'
        ]);


        $video = new Video;

        $user = Auth::user();
        $video->user_id = $user->id;
        $video->title = $request->input('title');
        $video->description = $request->input('description');

        $image = $request->file('image');

        if($image) {
            $image_path = time()  .'-' . $image->getClientOriginalName();
            Storage::disk('images')->put($image_path, File::get($image));
            $video->image = $image_path;
        }

        $video_file = $request->file('video');
        if ($video) {
            $video_path = time() . '-' . $video_file->getClientOriginalName();
            Storage::disk('videos')->put($video_path, File::get($video_file));
            $video->video_path = $video_path;
        }

        $video->save();

        return redirect()->route('home')->with(array('message' => 'El video se ha subido correctamente'));
    }

    public function getImage($filename) {
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    public function getVideo($filename) {
        $file = Storage::disk('videos')->get($filename);
        return new Response($file, 200);
    }

    public function detail($video_id) {
        $video = Video::where('id', $video_id)->first();
        return view('video.detail')->with('video', $video);
    }

    public function delete($video_id) {
        $user  = Auth::user();
        $video = Video::find($video_id);
        $comments = $video->comments();
        // dd($comments);

        if($user && $video->user_id == $user->id) {
            // Eliminar comentarios
            if ($comments) {
                $comments->delete();
            }

            // Eliminar ficheros
            Storage::disk('images')->delete($video->image);
            Storage::disk('videos')->delete($video->video_path);

            // Eliminar video
            $video->delete();

            $message = array('message', 'El video a sido eliminado exitosamente.');
        } else {
            $message = array('message', 'EL VIDEO NO SE HA ELIMINADO CORRECTAMENTE.');
        }

        return redirect()
                        ->route('home')
                        ->with($message);
    }

    public function edit($id) {
        $user = Auth::user();
        $video = Video::findOrFail($id);

        if ($user && $video->user_id == $user->id) {
            return view('video.edit')->with('video', $video);
        }
        return redirect()->route('home');
    }

    public function update($video_id, Request $request) {
        $validated = $this->validate($request, [
            'title' => 'required|min:5',
            'description' => 'required',
            'video'  => 'mimes:mp4'
        ]);

        $user = Auth::user();
        $video = Video::findOrFail($video_id);
        $video->user_id = $user->id;
        $video->title = $request->input('title');
        $video->description = $request->input('description');

        $image = $request->file('image');

        if($image) {
            $image_path = time()  . '-' . $image->getClientOriginalName();
            Storage::disk('images')->put($image_path, File::get($image));
            Storage::disk('videos')->delete($video->image);
            $video->image = $image_path;
        }

        $video_file = $request->file('video');

        if ($video_file) {
            $video_path = time() . '-' . $video_file->getClientOriginalName();
            Storage::disk('videos')->put($video_path, File::get($video_file));
            Storage::disk('videos')->delete($video->video_path);
            $video->video_path = $video_path;
        }

        $video->update();

        return redirect()
                        ->route('home')
                        ->with('message', 'El video a sido actualizado exitosamente.');

    }

    public function search($search = null, $order = 'new') {

        if (is_null($search)) {
            $search = Input::get('search');
            if (is_null($search)) {
                return redirect()->route('home');
            }
            return redirect()->route('video.search', array('search' => $search));
        }

        $order = Input::get('order');

        if(is_null($order) && $order && !is_null($search)) {
            return redirect()->route('video.search', array('search' => $search, 'order' => $order));
        }

        $order_by = $this->order_type($order);
        $videos = Video::where('title', 'LIKE', '%' .$search . '%')->orderBy($order_by['column'], $order_by['order'])->paginate(5);
        return view('video.search', array('videos' => $videos, 'search' => $search, 'order' => $order));
    }

    public function order_type($type) {

        $type = is_null($type) ? 'new' : $type;

        $types = [
            'new' => ['column' => 'id', 'order' => 'desc'],
            'old' => ['column' => 'id', 'order' => 'asc'],
            'alfa' =>['column' => 'title', 'order' => 'asc'],
        ];
        return $types[$type];
    }

}
