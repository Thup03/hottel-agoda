<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Intro;
use Validator;
 

class IntroController extends Controller
{
	public function intro()
	{
		if (Auth::guard('admin')->check()) {
			$intro = Intro::get()->first();
			if ($intro) {
				return view('informations.introductions', ['intro' => $intro]);
			}
			return redirect('/admin/home');
		}
		return redirect('/admin/home');
	}

	public function updateIntro(Request $request)
	{
		$validator = Validator::make(
			$request->all(),
			[
				'content' => 'required',
			],
			[
				'content.required' => 'Không được để trống nội dung giới thiệu',
			]
		);
		if ($validator->fails()) {
			return response()->json(['is' => 'failed', 'error' => $validator->errors()->all()]);
		}
		$profile = Intro::where('id', $request->id)->update(['content' => $request->content]);
		if ($profile) {
			return response()->json(['is' => 'success', 'complete' => 'Thông tin giới thiệu được cập nhật thành công']);
		}
		return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Thông tin giới thiệu chưa được cập nhật']);
	}
}
