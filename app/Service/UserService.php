<?php

namespace App\Service;

use App\Helper\ResponseFormatter;
use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Rules\Password;

class UserService{
    protected $UserRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->UserRepository = $userRepository;
    }

    public function Login(Request $request)
    {
        $request->validate([
            "email"=> 'required|email',
            "password"=> 'required'
        ]);

        $credentials = $request->only('email', 'password');
        $token = Auth::attempt($credentials);
        if (!$token) {
            return ResponseFormatter::error(message:"Invalid Unauthorized", code:401);
        };
        $user = Auth::user();
        return ResponseFormatter::success(data:[
            "access_token" => $token,
            "token_type" => "Bearer",
            "user" => $user
        ], message:"Login Success");
    }

    public function Register(Request $request){
        $request->validate([
            "name" => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', new Password]
        ]);

        $user = $this->UserRepository->CreateUser($request->email, $request->name, $request->password);

        
        return $this->Login($request);
    }

    public function Logout(Request $request)
    {
        Auth::logout();
        return ResponseFormatter::success(message:"Logout Success");
    }
}