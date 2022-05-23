<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Status;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomHostController extends Controller
{
    public function __construct()
    {
    }
    public function roomHost($id)
    {
        $room = DB::table('rooms')
            ->join('users', 'users.id', '=', 'rooms.user_id')
            ->join('categories', 'categories.id', '=', 'rooms.category_id')
            ->join('city', 'city.id', '=', 'rooms.city_id')
            // ->join('images', 'rooms.id', '=', 'images.room_id')
            ->select('rooms.*', "city.name as cityname", "categories.name as categoryname", "categories.price as price", "users.username as username")
            ->where('rooms.user_id', $id)
            ->get();
        if ($room) {
            return response()->json([
                'status' => 'success',
                'res' => $room
            ], 201);
        } else {
            return response()->json([
                'status' => 'error'
            ], 401);
        }
    }

    public function category()
    {
        $res = Category::all();
        return response()->json($res, 201);
    }

    public function city()
    {
        $res = DB::table('city')->limit(4)->get();
        return response()->json($res, 201);
    }

    public function status()
    {
        $res = Status::all();
        return response()->json($res, 201);
    }
    public function getByid($id)
    {
        $res = DB::table('rooms')
            ->join('users', 'users.id', '=', 'rooms.user_id')
            ->join('categories', 'categories.id', '=', 'rooms.category_id')
            ->join('city', 'city.id', '=', 'rooms.city_id')
            // ->join('images', 'rooms.id', '=', 'images.room_id')
            ->select('rooms.*', "city.name as cityname", "categories.name as categoryname", "categories.price as price", "users.username as username")
            ->where('rooms.id', $id)
            ->get();
        return response()->json($res, 201);
    }
}
