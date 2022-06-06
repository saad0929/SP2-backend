<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\CreateEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Repositories\EmployeeRepository;

class EmployeeController extends Controller
{

    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new EmployeeRepository();
    }

    public function store(CreateEmployeeRequest $request) {
        $user = $this->userRepository->storeEmployee($request->validated());
        return response()->json($user, 201);
    }

    public function updateUser(UpdateEmployeeRequest $request) {
        $user = $this->userRepository->updateEmployee($request->validated());
        return response()->json($user, 201);
    }

    public function fetchEmployees () {
        $users = $this->userRepository->getEmployees();

        return response()->json($users, 200);
    }

    public function fetchPaginatedEmployees () {
        $users = $this->userRepository->getPaginatedEmployees();

        return response()->json($users, 200);
    }

    public function fetchEmployeeById($employee_id) {
        $user = $this->userRepository->fetchEmployeeById($employee_id);

        return response()->json($user, 200);
    }

}
