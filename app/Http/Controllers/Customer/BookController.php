<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Room;
use App\Category;
use App\Reservation;
use Auth;
use Validator;

class BookController extends Controller
{
    public function bookingRoomCheck(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'code' => 'NOT_LOGIN']);
        }
        $room = Room::find($request->room_id);
        $categories = Category::all();
        return response()->json(['success' => true, 'room' => $room, 'categories' => $categories]);
    }

    public function bookingRoom(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'code' => 'NOT_LOGIN']);
        }
        $validator = Validator::make($request->all(), [
            'room_id' => 'required',
            'check_in_at' => 'required',
            'check_out_at' => 'required',
        ], [
            'room_id.required' => 'Chọn phòng là bắt buộc',
            'check_in_at.required' => 'Thời điểm  nhận phòng là bắt buộc',
            'check_out_at.required' => 'Thời điểm trả phòng là bắt buộc',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()->all()]);
        }

        $data['name'] = Auth::user()->name;
        $data['phone'] = Auth::user()->phone;
        $data['address'] = Auth::user()->address;
        $data['check_in_at'] = $request->check_in_at;
        $data['check_out_at'] = $request->check_out_at;
        $data['user_id'] = Auth::user()->id;
        $data['room_id'] = $request->room_id;
        unset($data['_token']);

        $room = Room::find($request->room_id);
        if (!$room || $room->avaiable == 0) {
            return response()->json(['success' => false, 'title' => 'Phòng tạm ngừng sử dụng', 'text' => 'Bạn vui lòng chọn sang phòng khác']);
        }

        $reservations = Reservation::where('room_id',  $request->room_id)->get();

        if ($reservations) {
            foreach ($reservations as $value) {
                if (!(($request->check_in < $value->check_in_at && $request->check_out < $value->check_in_at) ||
                    ($request->check_in > $value->check_out_at && $request->check_out > $value->check_out_at))) {
                    return response()->json(['success' => false, 'title' => 'Đã có người đặt', 'text' => 'Bạn vui lòng chọn khoảng thời gian khác']);
                }
            }
        }

        $booking = Reservation::create($data);

        if ($booking) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
