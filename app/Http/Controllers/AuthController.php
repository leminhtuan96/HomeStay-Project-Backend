<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;

//use Validator;



class AuthController extends Controller
{
    public $authService;

    public function __construct(UserRepository $userRepository)
    {
        $this->authService = $userRepository;
    }

    public function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users',
            'phone'=>'required|max:10',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $this->authService->register($request);
        return response()->json('susscess', 201);
    }

    public function getAll()
    {
        $user = User::all();
        return response()->json($user, 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Tài khoản hoặc mật khẩu không đúng'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 99999999999,
            'user' => auth()->user(),
            'message' => 'Đăng nhập thành công'
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
           'message'=>'logout success',
           'status'=>'success'
        ],201);
    }


    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user = Auth::user();
        if (Hash::check($request->oldPassword, $user->password)) {
            $user->update([
                'password' => Hash::make($request->newPassword)
            ]);
            return response()->json([
                'message' => 'Password successfully updated',
                'status' => 'Success'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Mật khẩu cũ không khớp',
                'status' => 'Errors'
            ], 400);
        }

    }


}
