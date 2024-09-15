<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{

    public function listUsers(Request $request)
    {
        if (User::all()->count() > 0) {
            return response()->json(User::all(), 200);
        } else {
            return response()->json(['message' => 'No users found'], 404);
        }
    }

    public function userProfile($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json($user, 200);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['message' => 'User deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    public function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(
            ['message' => 'User registered successfully', 'user' => $user],
            201
        );
    }

    
}
