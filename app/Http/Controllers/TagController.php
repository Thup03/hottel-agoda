<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use Validator;


class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('tag.tags_list', ['tags' => $tags]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255|regex:/^[a-zA-Z0-9_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽếềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ_(\s)_(\.)_(\,)_(\-)_(\_)]+$/',
            ],

            [
                'name.required' => 'Tên thẻ không được để trống',
                'name.max' => 'Tên thẻ không được quá :max kí tự',
                'name.regex' => 'Tên thẻ không được chứa kí tự đặc biệt',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['is' => 'failed', 'error' => $validator->errors()->all()]);
        }
        $data = $request->all();
        unset($data['_token']);
        $data['slug'] = str_slug($data['name']);

        $tag = Tag::create($data);

        if (isset($tag)) {
            return response()->json(['is' => 'success', 'complete' => 'Tag được thêm thành công']);
        } 
        return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Tag chưa được thêm']);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255|regex:/^[a-zA-Z0-9_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽếềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ_(\s)_(\.)_(\,)_(\-)_(\_)]+$/',
            ],

            [
                'name.required' => 'Tên thẻ không được để trống',
                'name.max' => 'Tên thẻ không được quá :max kí tự',
                'name.regex' => 'Tên thẻ không được chứa kí tự đặc biệt',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['is' => 'failed', 'error' => $validator->errors()->all()]);
        }
        $data = $request->all();
        $tag = Tag::find($data['id']);
        unset($data['_token']);
        unset($data['id']);
        $data['slug'] = str_slug($data['name']);
        $flag = $tag->update($data);
        if ($flag) {
            return response()->json(['is' => 'success', 'complete' => 'Thẻ được cập nhật thành công']);
        }
        return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Thẻ chưa được cập nhật']);
    }

    public function destroy($id)
    {
        Tag::findOrFail($id)->post_tags()->delete();
        Tag::findOrFail($id)->delete();
    }
}
