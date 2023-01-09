<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Thread;

class PostController extends Controller
{
    public function post(Request $request)
    {
        $post = Thread::all();
        return response()->json($post);
    }
}
