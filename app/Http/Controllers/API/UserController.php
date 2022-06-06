<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Repositories\UserRepository;

class UserController extends Controller
{

    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function store(CreateUserRequest $request) {
        $user = $this->userRepository->storeUser($request->validated());
        return response()->json($user, 201);
    }

    public function updateUser(UpdateUserRequest $request) {
        $user = $this->userRepository->updateUser($request->validated());
        return response()->json($user, 201);
    }

    public function userOnHoldRequest($user_id) {
        $user = $this->userRepository->userOnHoldRequest($user_id);
        return response()->json($user, 201);
    }
    public function keepUserOnHold($user_id) {
        $user = $this->userRepository->keepUserOnHold($user_id);
        return response()->json($user, 201);
    }
    public function fetchOnHoldUsers() {
        $user = $this->userRepository->fetchOnHoldUsers();
        return response()->json($user, 200);
    }
    public function fetchUsers () {
        $users = $this->userRepository->getusers();

        return response()->json($users, 200);
    }

    public function fetchPaginatedUsers () {
        $users = $this->userRepository->getPaginatedUsers();

        return response()->json($users, 200);
    }

    public function fetchUserById($user_id) {
        $user = $this->userRepository->fetchUserById($user_id);

        return response()->json($user, 200);
    }

    public function login(LoginRequest $request) {
        $user = $this->userRepository->login($request->validated());
        return response()->json($user, 201);
    }

//    public function deleteUser(DeleteUserRequest $request){
//        $user = $this->userRepository->deleteUser($request->validated());
//        return response()->json($user, 201);
//    }
}
