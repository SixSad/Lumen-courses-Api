<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class UserController extends BaseController
{
    public function index()
    {
        return User::all();
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            "email" => 'required|unique:users',
            'password' => 'required',
            'phone' => 'required',
        ]);
        $user = User::create($request->all());
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->json()->all());
        return $user;
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['message' => 'Пользователь удален']);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            "email" => 'required',
            'password' => 'required',
        ]);

        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
