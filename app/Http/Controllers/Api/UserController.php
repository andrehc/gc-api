<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Traits\ValidatesRequestsTrait;

class UserController extends Controller
{
    use ValidatesRequestsTrait;
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index()
    {
        $users = $this->userService->index();
        return response()->json([
            'message' => $users
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $userId)
    {
        try {
            $user = $this->userService->getUser($userId);

            return response()->json([
                'message' => $user
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $userId)
    {
        try {
            $rules = [
                'admin' => 'string',
                'email' => 'email|unique:users,email,' . $userId,
                'name' => 'string',
            ];

            $validator = $this->validateData($request->all(), $rules);

            if ($validator->fails()) {
                return $this->respondWithValidationErrors($validator);
            }

            $user = $this->userService->updateUser($request, $userId);

            return response()->json([
                'message' => $user
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
