<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserAPIController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'email' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Missing required fields.',
                'data' => $request->all()
            ]);
        }

        $user = User::where('email', '=', $request->get('email'))->first();
        if (empty($user)) {
            return response()->json([
                'success' => false,
                'message' => 'Email does not exist.',
                'data' => $request->all()
            ]);
        }

        if (!Hash::check($request->get('password'), $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials',
                'data' => $request->all()
            ]);
        }

        $user->api_token = bcrypt(time() . $user->id);
        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'Login successfully',
            'data' => [
                'api_token' => $user->api_token
            ]
        ]);
    }
}