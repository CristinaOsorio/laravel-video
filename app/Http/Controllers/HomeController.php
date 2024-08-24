<?php

namespace App\Http\Controllers;

use App\Http\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index () {
        $videos = Video::orderBy('id', 'DESC')->paginate(5);
        return view('home')->with('videos', $videos);
    }


}
