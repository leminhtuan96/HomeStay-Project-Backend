<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function bookingDetail()
    {
        $bkd = $this->userRepository->bookingDetail(Auth::user()->id);
        return response()->json($bkd, 201);
    }

    public function booking(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'price' => 'required',
            'startDay' => 'required',
            'endDay' => 'required',
            //            'bookingDay' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $this->userRepository->bookingRoom($request);
        Mail::to(Auth::user()->email)->send(new TestMail());
        return response()->json([
            'message' => 'booking room success',
            'status' => 'success',
        ], 201);
    }

    public function cancelBooking($id)
    {
        $res = $this->userRepository->cancelBooking($id);
        if ($res) {
            return response()->json([
                'message' => 'cancel booking room success',
                'status' => 'success'
            ], 201);
        } else {
            return response()->json([
                'message' => 'cancel booking room fail',
                'status' => 'error'
            ], 401);
        }
    }

    public function show($id)
    {
        $user = $this->userRepository->getById($id);
        return response()->json($user, 201);
    }

    public function edit(Request $request, $id)
    {
       $res = $this->userRepository->updateUser($request, $id);
        // return response()->json([
        //     'message' => "Successfully updated",
        //     'success' => true
        // ], 201);
        return response()->json($request, 201);
    }
}
