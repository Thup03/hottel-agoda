<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use Auth;
use Validator;

class RoomController extends Controller
{
    public function index()
    {
        $title = 'Danh sách phòng';
        return view('room.rooms_list', ['rooms' => Room::all(), 'title' => $title]);
    }

    // ADMIN
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|min:3|regex:/^[a-zA-Z0-9_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽếềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ_(\s)_(\.)_(\,)_(\-)_(\_)]+$/',
                'content' => 'required',
                'description' => 'required',
            ],
            [
                'title.required' => 'Bạn chưa nhập Tên phòng.',
                'title.regex' => 'Tên phòng không được chứa kí tự đặc biệt',
                'title.min' => 'Tên phòng phải có ít nhất 3 kí tự.',
                'content.required' => 'Nội dung Phòng không được để trống',
                'description.required' => 'Phần mô tả không được để trống',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['is' => 'failed', 'error' => $validator->errors()->all()]);
        }
        $data = $request->all();
        unset($data['_token']);
        $data['slug'] = str_slug($data['title']);
        if ($files = $request->file('thumbnail')) {
            $destinationPath = 'images/'; // upload path
            $time = time();
            $fileName = $time . "" . date('YmdHis') . "" . $files->hashName();
            $files->move($destinationPath, $fileName);
            $data['thumbnail'] = $fileName;
        }
        if (Auth::guard('admin')->check()) {
            $data['author'] = Auth::guard('admin')->user()->name;
        }

        unset($data['_token']);
        unset($data['tags']);

        $room = Room::create($data);

        if (isset($room)) {
            return response()->json(['is' => 'success', 'complete' => 'Phòng được thêm thành công']);
        }
        return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Phòng chưa được thêm']);
    }

    public function show($id)
    {
        return Room::find($id);
    }

    public function showRoom($id)
    {
        $room = Room::find($id);
        $tags = [];
        return view('room.room_detail', ['room' => $room, 'tags' => $tags]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $room = Room::find($data['id']);
        unset($data['_token']);
        unset($data['id']);
        $room->update($data);
    }

    public function destroy($id)
    {
        // $room_tags = Room::findOrFail($id)->post_tags()->delete();
        return Room::findOrFail($id)->delete();
    }

    // admin update post
    public function updateRoom(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|min:3||regex:/^[a-zA-Z0-9_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽếềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ_(\s)_(\.)_(\,)_(\-)_(\_)]+$/',
                'description' => 'required|min:10',
                'content' => 'required',
            ],
            [
                'title.required' => 'Bạn chưa nhập Tên phòng.',
                'title.regex' => 'Tên phòng không được chứa kí tự đặc biệt',
                'title.min' => 'Tên phòng phải có ít nhất 3 kí tự.',
                'description.required' => 'Bạn chưa nhập mô tả.',
                'description.min' => 'Mô tả phải chứa ít nhất 10 kí tự',
                'content.required' => 'Bạn chưa nhập nội dung',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['is' => 'failed', 'error' => $validator->errors()->all()]);
        }

        $data = $request->all();

        $room = Room::findOrFail($data['id']);

        $time = time();
        if ($files = $request->file('thumbnail')) {
            $destinationPath = 'images/'; // upload path
            $time = time();
            $fileName = $time . "" . date('YmdHis') . "" . $files->hashName();
            $files->move($destinationPath, $fileName);
            $data['thumbnail'] = $fileName;
        } else {
            $data['thumbnail'] = $room->thumbnail;
        }

        if (Auth::guard('admin')->check()) {
            $data['author'] = Auth::guard('admin')->user()->name;
        }

        unset($data['_token']);
        unset($data['tags']);

        $room = $room->update($data);

        return response()->json(['is' => 'success', 'complete' => 'Phòng được cập nhật thành công']);
    }
}
