<?php

namespace App\Http\Controllers;

use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PhpParser\Node\Stmt\TryCatch;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function Login(Request $request)
    {
        $data = $this->userService->Login($request);
        // dd($data);
        return response()->json(
            $data,
            $data['meta']['code']
        );
    }

    public function Register(Request $request)
    {
        $data = $this->userService->Register($request);
        return response()->json(
            $data,
            $data['meta']['code']
        );
    }

    public function Logout(Request $request)
    {
        $data = $this->userService->Logout($request);
        return response()->json(
            $data,
            $data['meta']['code']
        );
    }
}
