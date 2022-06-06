<?php


namespace App\Repositories;


use App\Handlers\UserTokenHandler;
use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;

class AdminRepository
{

    public function getAdmins() {
        $users = Admin::get();
        $users = $users->filter(function ($employee) {
            return ($employee->user->roles->contains('name', 'admin'));
        })->values();
        return $users->load('user','user.roles');
    }
    public function getPaginatedAdmins(){
        $users = Admin::with('user', 'user.roles')->paginate(10);
        return $users;
    }

    public function storeAdmin(array $request) {
        $userHandler = new UserTokenHandler();

        $user = $userHandler->createUser($request['username'], $request['password'], $request['email'], $request['phone'], $request['address']);
        $newAdmin = new Admin();
        $newAdmin->user_id = $user->id;
        $newAdmin->save();
        $user->assignRole('admin');
        $user->load('roles');
        return $newAdmin->load('user');
    }
    public function updateAdmin(array $request) {
            $user = User::where('id', $request['user_id'])->firstOrFail();
            $user->username = $request['username'];
            $user->email = $request['email'];
            $user->phone = $request['phone'];
            $user->address = $request['address'];
            $user->save();

            $user->load('roles');
            return $user;
        }

    public function fetchAdminById($admin_id)
    {
        // TODO: Implement fetchAdminById() method.
        $user = Admin::where('id', $admin_id)->firstOrFail();
        $user->load('user','user.roles');
        return $user;
    }
}
