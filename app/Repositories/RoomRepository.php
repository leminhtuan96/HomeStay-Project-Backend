<?php

namespace App\Repositories;

use App\Models\Room;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;

class RoomRepository extends BaseRepository
{

    public function getTable()
    {
        return 'rooms';
    }

    public function getModel()
    {
        return Room::class;
    }

    public function createRoom($data)
    {
        $room = new Room();
        $room->name = $data['name'];
        $room->address = $data['address'];
        $room->description = $data['description'];
        $room->bedroom = $data['bedroom'];
        $room->bathroom = $data['bathroom'];
        $room->status_id = $data['status_id'];
        $room->city_id = $data['city_id'];
        $room->category_id = $data['category_id'];
        // $room->image = $data['image'];
        $room->user_id = $data['user_id'];
        $room->save();
    }

    public function updateRoom($data, $id)
    {

        $room = Room::findOrFail($id);
        $room->name = $data['name'] ?? $room->name;
        $room->address = $data['address'] ?? $room->address;
        $room->description = $data['description'] ?? $room->description;
        $room->bedroom = $data['bedroom'] ?? $room->bedroom;
        $room->bathroom = $data['bathroom'] ?? $room->bathroom;
        $room->status_id = $data['status_id'] ?? $room->status_id;
        $room->city_id = $data['city_id'] ?? $room->city_id;
        $room->category_id = $data['category_id'] ?? $room->category_id;
        $room->user_id = $data['user_id'] ?? $room->user_id;
        $room->save();

        // DB::table("rooms")->where('id',$id)->update($data);
    }

    public function getAll()
    {
        return DB::table('rooms')
            ->join('users', 'users.id', '=', 'rooms.user_id')
            ->join('categories', 'categories.id', '=', 'rooms.category_id')
            ->join('city', 'city.id', '=', 'rooms.city_id')
            // ->join('images', 'rooms.id', '=', 'images.room_id')
            ->select('rooms.*', "city.name as cityname", "categories.name as categoryname", "categories.price as price", "users.username as username")
            ->get();
    }

    public function search()
    {
        return DB::table('rooms')->join('users', 'users.id', '=', 'rooms.user_id')
            ->join('categories', 'categories.id', '=', 'rooms.category_id')
            ->join('city', 'city.id', '=', 'rooms.city_id')
            //            ->join('images', 'rooms.id', '=', 'images.room_id')
            ->select('rooms.*', "city.name as cityname", "categories.name as categoryname", "categories.price as price", "users.username as username");
    }
}
