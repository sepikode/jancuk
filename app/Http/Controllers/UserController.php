<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->userRepository->all());
    }

    public function show(int $id): JsonResponse
    {
        $user = $this->userRepository->find($id);
        return response()->json($user);
    }

    public function store(Request $request): JsonResponse
    {
        $user = $this->userRepository->create($request->validated());
        return response()->json($user, 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $user = $this->userRepository->update($id, $request->validated());
        return response()->json($user);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->userRepository->delete($id);
        return response()->json(null, 204);
    }
}
