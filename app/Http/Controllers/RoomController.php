<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Repositories\RoomRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    public function index()
    {
        $rooms = $this->roomRepository->getAll();
        if (!$rooms) {
            $res = [
                'message' => 'Room not found',
                'status' => 'error',

            ];
        } else {
            $res = [
                'status' => 'success',
                'room' => $rooms,
            ];
        }
        return response()->json($res, 201);
    }

    public function create()
    {
    }


    public function store(Request $request)
    {
        $this->roomRepository->createRoom($request);
        return response()->json([
            'message' => 'Room created successfully',
            'status' => true,
        ]);
    }


    public function show($id)
    {
        $room = $this->roomRepository->getById($id);
        if (!$room) {
            $res = [
                'message' => 'Room not found',
                'status' => 'error',

            ];
        } else {
            $res = [
                'status' => 'success',
                'room' => $room,
            ];
        }
        return response()->json($res);
    }


    public function edit($id)
    {
    }


    public function update(Request $request, $id)
    {
        $room = $this->roomRepository->getById($id);
        if (!$room) {
            $res = [
                'message' => 'Room not found',
                'status' => 'error',

            ];
        } else {

            $this->roomRepository->updateRoom($request, $id);

            $res = [

                'status' => 'success',
                'message' => 'Room updated successfully'
            ];
        }
        return response()->json($res);
    }


    public function destroy($id)
    {
        $room = $this->roomRepository->getById($id);
        if (!$room) {
            $res = [
                'message' => 'Room not found',
                'status' => 'error',

            ];
        } else {

            $this->roomRepository->deleteById($id);
            $res = [
                'message' => 'Room deleted successfully',
                'status' => 'success',
            ];
        }
        return response()->json($res);
    }

    public function multiSearch(Request $request)
    {
        $result = $this->roomRepository->search();
        if (!empty($request->name)) {
            $result = $result->where('rooms.name', 'like', '%' . $request->name . '%');
        }
        if (!empty($request->bedroom)) {
            $result = $result->where('rooms.bedroom', 'like', '%' . $request->bedroom . '%');
        }
        if (!empty($request->bathroom)) {
            $result = $result->where('rooms.bathroom', 'like', '%' . $request->bathroom . '%');
        }
        if (!empty($request->address)) {
            $result = $result->where('rooms.address', 'like', '%' . $request->address . '%');
        }
        if (!empty($request->categoryname)) {
            $request = $result->where('categories.name', 'like', '%' . $request->categoryname . '%');
        }
        if (!empty($request->price)) {
            if ($request->price == 1) {
                $result = $result->where('categories.price', '<', '5000');
            }
            if ($request->price == 2) {
                $result = $result->whereBetween('categories.price', [500, 5000]);
            }
            if ($request->price == 3) {
                $result = $result->where('categories.price', '>', '5000');
            }
        };
        $res = $result->get();
        return response()->json($res, 201);
    }

    public function getCity($id)
    {
        $res = DB::table('city')
            ->join('rooms', 'rooms.city_id', '=', 'city.id')
            ->join('categories', 'rooms.category_id', '=', 'categories.id')
            ->where('rooms.city_id', $id)
            ->select('rooms.*', 'city.name as cityname', 'categories.name as categoryname', 'categories.price as price')
            ->get();
        return response()->json($res, 201);
    }

    public function getByIdRoom($id)
    {
        $res = DB::table('rooms')
            ->join('city', 'city.id', '=', 'rooms.city_id')
            ->join('categories', 'categories.id', '=', 'rooms.category_id')
            // ->join('ratings', 'ratings.room_id', '=', 'rooms.id')
            ->where('rooms.id', $id)
            ->select('rooms.*', 'city.name as cityname', 'categories.name as categoryname', 'categories.price as price')
            ->first();
        return response()->json($res, 201);
    }
}
