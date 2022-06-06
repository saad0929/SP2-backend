<?php


namespace App\Handlers;


use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTokenHandler
{
    public function createUser($username, $password, $email, $phone, $address): User {
        $newUser = new User();
        $newUser->username = $username;
        $newUser->email = $email;
        $newUser->phone = $phone;
        $newUser->address = $address;
        $newUser->password = Hash::make($password);
        $newUser->save();
        $newUser->token = $newUser->createToken($newUser->username. $newUser->id)->plainTextToken;
        return $newUser;
    }


    public function regenerateUserToken(User $user){
//        $user->tokens()->delete();
        $user->token = $user->createToken($user->username. $user->id)->plainTextToken;
        return $user;
    }

    public function revokeTokens(User $user){
        $user->tokens()->delete();
    }

//    function createSlug($text)
//    {
//        $text = str_replace('!', '', $text);
//        $slug = preg_replace('/\s+/u', '-', trim($text));
//        return $slug;
//    }
//
//
//    function random_string($length)
//    {
//        $pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
//        $random_string = substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
//        return $random_string;
//    }
}
