<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
use Auth;
use Validator;


class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::orderBy('updated_at', 'desc')->get();
        return view('slide.slides_list', ['slides' => $slides]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'display_order' => 'required',
                'link' => 'required',
                'description' => 'required',
                'sponsor' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [
                'required' => 'Trường :attribute không được để trống',
                'image.image' => 'Yêu cầu phải là ảnh có đuôi jpeg,png,jpg,gif',
                'image.mimes' => 'Yêu cầu phải là ảnh có đuôi jpeg,png,jpg,gif',
                'image.max' => 'Ảnh không vượt quá 2MB',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['is' => 'failed', 'error' => $validator->errors()->all()]);
        }
        $data = $request->all();
        unset($data['_token']);
        $time = time();
        if ($files = $request->file('image')) {
            $destinationPath = 'images/slides/'; // upload path
            $time = time();
            $fileName = $time . "" . date('YmdHis') . "" . $files->hashName();
            $files->move($destinationPath, $fileName);
            $data['image'] = $fileName;
        }

        if (Auth::guard('admin')->check()) {
            $data['createby'] = Auth::guard('admin')->user()->name;
        }

        unset($data['_token']);

        $slide = Slide::create($data);

        if (isset($slide)) {
            return response()->json(['is' => 'success', 'complete' => 'Banner được thêm thành công']);
        }
        return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Banner chưa được thêm']);
    }

    public function edit(Request $request)
    {
        $data = $request->all();
        if ($files = $request->file('image')) {
            $destinationPath = 'images/slides/'; // upload path
            $time = time();
            $fileName = $time . "" . date('YmdHis') . "" . $files->hashName();
            $files->move($destinationPath, $fileName);
            $data['image'] = $fileName;
        } else {
            unset($data['image']);
        }
        $slide = Slide::find($data['id']);
        unset($data['_token']);
        unset($data['id']);
        $slide->update($data);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $slide = Slide::find($data['id']);
        unset($data['_token']);
        unset($data['id']);
        $slide->update($data);
    }

    public function destroy($id)
    {
        Slide::findOrFail($id)->delete();
    }

    public function updateStatus(Request $request, $id)
    {
        $data = $request->all();
        $slide = Slide::find($data['id']);
        unset($data['_token']);
        $slide->status == 0 ? $slide->status = 1 : $slide->status = 0;
        $slide->save();
    }
}
