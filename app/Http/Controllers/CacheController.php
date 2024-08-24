<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class CacheController extends Controller
{
    public function clear()
    {
        Artisan::call('cache:clear');
        return response()->json(['message' => 'Cache cleared']);
    }
}
