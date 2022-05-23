<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserRepository extends BaseRepository
{
    public function getTable()
    {
        return "users";
    }

    public function createUser($data)
    {
        $this->models::create($data);
    }

    public function getModel()
    {
        return User::class;
    }

    public function register($request)
    {
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id
        ]);
    }

    public function bookingRoom($request)
    {
        $booking = new Booking();
        $booking->startDay = $request->startDay;
        $booking->endDay = $request->endDay;
        $booking->bookingDay = $request->bookingDay;
        $booking->price = $request->price;
        $booking->status_id = $request->status_id;
        $booking->user_id = $request->user_id;
        $booking->room_id = $request->room_id;
        $booking->save();
    }

    public function bookingDetail($id)
    {
        return DB::table('bookings')->join('users', 'users.id', '=', 'bookings.user_id')
            ->join('status', 'status.id', '=', 'bookings.status_id')
            ->join('rooms', 'rooms.id', '=', 'bookings.room_id')
            ->join('categories', 'categories.id', '=', 'rooms.category_id')
            ->select('bookings.*', 'users.name as username', 'rooms.name as roomname', 'status.name as statusname', 'categories.name as categoryname')
            ->where('users.id', $id)
            ->get();
    }

    public function cancelBooking($id)
    {
        $booking = Booking::where('id', $id)
            ->where('bookingDay', '>', Carbon::now()->subDay(2))
            ->get();
        if (count($booking) > 0) {
            Booking::destroy($id);
            return true;
        } else {
            return false;
        }
    }

    public function updateUser($data, $id)
    {
        $user = User::findOrFail($id);
        $user->username = $data['username'] ?? $user->username ;
        $user->fullname = $data['fullname'] ?? $user->fullname;
        $user->phone = $data['phone'] ?? $user->phone;
        $user->email = $data['email'] ?? $user->email;
        $user->password = $data['password'] ?? $user->password ;
        $user->avatar = $data['avatar'] ?? $user->avatar;
        $user->address = $data['address'] ?? $user->address;
        $user->role_id = $user->role_id;
        $user->save();
        return $user;
    }

}
