<?php

namespace App\Http\Controllers\API;

use App\Post;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PostAPIController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'title' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Missing required fields.',
                'data' => $request->all()
            ]);
        }

        $user = $request->user();
        $input = $request->all();
        $input['creator_id'] = $user->id;
        $post = Post::create($input);


        return response()->json([
            'success' => true,
            'message' => 'Login successfully',
            'data' => $post
        ]);
    }
}