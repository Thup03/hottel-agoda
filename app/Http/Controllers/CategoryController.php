<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Danh sách loại phòng';
        return view('category.categories_list', ['categories' => Category::all(), 'title' => $title]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255|regex:/^[a-zA-Z0-9_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽếềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ_(\s)_(\.)_(\,)_(\-)_(\_)]+$/',
                'description' => 'required|max:255',
                'sort_id' => 'required|numeric|integer|min:0',
            ],
            [
                'name.required' => 'Loại phòngkhông được để trống',
                'name.max' => 'Loại phòngkhông được nhiều hơn :max kí tự',
                'name.regex' => 'Loại phòngkhông được chứa kí tự đặc biệt',
                'description.required' => 'Mô tả về Loại phòngkhông được để trống',
                'max' => 'Mô tả về Loại phòngkhông được nhiều hơn :max kí tự',
                'sort_id.numeric' => 'Thứ tự sắp xếp phải là số',
                'sort_id.min' => 'Thứ tự sắp xếp phải là số lớn hơn hoặc bằng 0',
                'sort_id.integer' => 'Thứ tự sắp xếp phải là số nguyên',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['is' => 'failed', 'error' => $validator->errors()->all()]);
        }

        $data = $request->all();
        unset($data['_token']);
        $data['slug'] = str_slug($data['name']);

        if ($files = $request->file('thumbnail')) {
            $destinationPath = 'images/categories/'; // upload path
            $time = time();
            $fileName = $time . "" . date('YmdHis') . "" . $files->hashName();
            $files->move($destinationPath, $fileName);
            $data['thumbnail'] = $fileName;
        } else {
            unset($data['thumbnail']);
        }

        $category = Category::create($data);

        if (isset($category)) {
            return response()->json(['is' => 'success', 'complete' => 'Loại phòngđược thêm thành công']);
        }
        return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Loại phòngchưa được thêm']);
    }

    public function show($id)
    {
        $category = Category::find($id);
        return $category;
    }

    public function edit(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255|regex:/^[a-zA-Z0-9_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽếềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ_(\s)_(\.)_(\,)_(\-)_(\_)]+$/',
                'description' => 'required|max:255',
                'sort_id' => 'required|numeric|integer|min:0',
            ],
            [
                'name.required' => 'Loại phòngkhông được để trống',
                'name.max' => 'Loại phòngkhông được nhiều hơn :max kí tự',
                'name.regex' => 'Loại phòngkhông được chứa kí tự đặc biệt',
                'description.required' => 'Mô tả về Loại phòngkhông được để trống',
                'max' => 'Mô tả về Loại phòngkhông được nhiều hơn :max kí tự',
                'sort_id.numeric' => 'Thứ tự sắp xếp phải là số',
                'sort_id.min' => 'Thứ tự sắp xếp phải là số lớn hơn hoặc bằng 0',
                'sort_id.integer' => 'Thứ tự sắp xếp phải là số nguyên',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['is' => 'failed', 'error' => $validator->errors()->all()]);
        }
        $data = $request->all();
        $category = Category::find($data['id']);
        if ($files = $request->file('thumbnail')) {
            $destinationPath = 'images/categories/'; // upload path
            $time = time();
            $fileName = $time . "" . date('YmdHis') . "" . $files->hashName();
            $files->move($destinationPath, $fileName);
            $data['thumbnail'] = $fileName;
        } else {
            $data['thumbnail'] = $category->thumbnail;
        }
        $data['slug'] = str_slug($data['name']);
        unset($data['_token']);
        unset($data['id']);

        $flag = $category->update($data);
        if ($flag) {
            return response()->json(['is' => 'success', 'complete' => 'Loại phòng đã được cập nhật']);
        }
        return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Loại phòng chưa được cập nhật']);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $category = Category::find($data['id']);
        unset($data['_token']);
        unset($data['id']);
        $category->update($data);
        return response()->json(['is' => 'success', 'complete' => 'Loại phòng đã được cập nhật']);
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return response()->json(['is' => 'success', 'complete' => 'Loại phòng đã được xóa']);
    }
}
