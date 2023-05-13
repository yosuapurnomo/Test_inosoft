<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository{
    protected $User;

    public function __construct(User $user)
    {
        $this->User = $user;
    }

    public function GetUser(string $email){
        return $this->User::where('email', $email)->first();
    }

    public function CreateUser(string $email, string $name, string $password){
        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);
    }
}