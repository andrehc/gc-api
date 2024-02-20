<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser(Request $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return $user;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function index()
    {
        try {
            return User::paginate(10);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getUser($userId)
    {
        try {
            return User::findOrFail($userId);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updateUser(Request $request, $userId)
    {
        try {
            $user = $this->getUser($userId);

            if (!$user) {
                return 'Usuário não encontrado';
            }

            $user->update($request->all());

            return $user;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
