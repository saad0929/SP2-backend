<?php


namespace App\Repositories;


use App\Handlers\UserTokenHandler;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository
{

    public function getusers() {
        $users = User::with('roles')->get();
        $users = $users->filter(function ($user) {
            return ($user->roles->contains('name', 'general'));
        })->values();
        return $users;
    }
    public function getPaginatedUsers(){
        $users = User::with('roles')->paginate(10);
        return $users;
    }

    public function storeUser(array $request) {
        $userHandler = new UserTokenHandler();

        $user = $userHandler->createUser($request['username'], $request['password'], $request['email'], $request['phone'], $request['address']);
        $user->assignRole('general');
        $user->load('roles');
        return $user;
    }
    public function updateUser(array $request) {
            $user = User::where('id', $request['id'])->firstOrFail();
            $user->username = $request['username'];
            $user->email = $request['email'];
            $user->phone = $request['phone'];
            $user->address = $request['address'];
            $user->on_hold = $request['on_hold'];

            $user->save();

            $user->load('roles');
            return $user;
    }

    public function userOnHoldRequest($user_id) {
        $user = User::where('id', $user_id)->firstOrFail();
        $user->is_forwarded = 1;
        $user->save();
        return $user;
    }
    public function keepUserOnHold($user_id) {
        $user = User::where('id', $user_id)->firstOrFail();
        $user->on_hold = 1;
        $user->is_forwarded = 2;
        $user->save();
        return $user;
    }
   public function fetchOnHoldUsers() {
        $users = User::where('on_hold', 1)->get();
        return $users;
    }



    public function login(array $request)
    {
        $user = User::where('username', $request['username'])->firstOrFail();
        if($user && Hash::check($request['password'], $user->password)){
            $userTokenHandler = new UserTokenHandler();
            $user = $userTokenHandler->regenerateUserToken($user);
            $user->load('roles');
            return $user;
        }

        return null;
    }

    private function getUserType(User $user)
    {
        if($user->hasAnyRole(['admin', 'super_admin'])){
           return $user->admin;
        } elseif ($user->hasAnyRole(['employee'])){
            return $user->employee;
        } else{
            return $user;
        }

    }


    public function fetchUserById($user_id)
    {
        // TODO: Implement fetchUserById() method.
        $user = User::where('id', $user_id)->firstOrFail();
        $user->load('roles');
        return $user;
    }
}
