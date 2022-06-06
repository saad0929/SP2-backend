<?php


namespace App\Repositories;


use App\Handlers\UserTokenHandler;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;

class EmployeeRepository
{

    public function getEmployees() {
        $users = Employee::get();
        $users = $users->filter(function ($employee) {
            return ($employee->user->roles->contains('name', 'employee'));
        })->values();
        return $users->load('user','user.roles');
    }
    public function getPaginatedEmployees(){
        $users = Employee::with('user', 'user.roles')->paginate(10);
        return $users;
    }

    public function storeEmployee(array $request) {
        $userHandler = new UserTokenHandler();

        $user = $userHandler->createUser($request['username'], $request['password'], $request['email'], $request['phone'], $request['address']);
        $newEmployee = new Employee();
        $newEmployee->user_id = $user->id;
        $newEmployee->employee_id = Carbon::now()->year .'_'. $user->id;
        $newEmployee->save();
        $user->assignRole('employee');
        $user->load('roles');
        return $newEmployee->load('user');
    }
    public function updateEmployee(array $request) {
            $user = User::where('id', $request['user_id'])->firstOrFail();
            $user->username = $request['username'];
            $user->email = $request['email'];
            $user->phone = $request['phone'];
            $user->address = $request['address'];
            $user->save();

            $user->load('roles');
            return $user;
        }

    public function fetchEmployeeById($employee_id)
    {
        // TODO: Implement fetchEmployeeById() method.
        $user = Employee::where('id', $employee_id)->firstOrFail();
        $user->load('user','user.roles');
        return $user;
    }
}
