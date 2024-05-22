<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// khai báo sử dụng loginRequest
use App\Http\Requests\LoginRequest;
use Auth;
use App\Category;
use App\Tag;
use App\Post;

use App\Manufacture;
use App\Pathology;
use App\Pharmacy;
use App\Unit;
use App\SupportTreatment;
use App\Pharmacology;

use App\Prescription;

use App\Order;

use App\User;
use App\Admin;
use App\Product;
use App\ProfileAdmin;
use Validator;
 

use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
	public function homePage()
	{
		// // So luong khach hang
		// $count_user = User::where('level', 0)->count();

		// // So luong nhan vien
		// $count_collaborator = Admin::where('level', 0)->count();

		// // So luong quan tri vien
		// $count_admin = Admin::where('level', 1)->count();

		// // Tong so tai khoan tren he thong
		// $count_user_total = $count_user + $count_collaborator + $count_admin;

		// // So luong chu de
		// $count_category = Category::all()->count();

		// // So luong the bai viet
		// $count_tag = Tag::all()->count();

		// // So luong bai viet
		// $count_post = Post::all()->count();

		// // So luong don thuoc gui len he thong
		// // $count_prescription = Prescription::all()->count();
		// $count_prescription = 0;

		// // So luong don thuoc da duoc tu van
		// // $count_consulted = Prescription::where('status', 1)->count();
		// $count_consulted = 0;

		// // So luong don hang da giao thanh cong
		// $count_order_delivered = Order::where('status', 2)->count();

		// // So luong nha san xuat
		// $count_manufacture = Manufacture::all()->count();

		// // So luong dang benh hoc
		// $count_pathology = Pathology::all()->count();

		// // So luong dang bao che
		// $count_pharmacy = Pharmacy::all()->count();

		// // So luong don vi tinh
		// $count_unit = Unit::all()->count();

		// // So luong nhom ho tro dieu tri
		// $count_support_treatment = SupportTreatment::all()->count();

		// // So luong nhom duoc ly
		// $count_pharmacology = Pharmacology::all()->count();

		// // So luong thuoc
		// $total_medicine = Product::where('type', 0)->where('status', 1)->count();

		// // So luong san pham thuc pham chuc nang
		// $total_healthfood = Product::where('type', 1)->where('status', 1)->count();

		// // So luong hang tieu dung
		// $total_goods = Product::where('type', 2)->where('status', 1)->count();

		// // So luong thiet bi y te
		// $total_equipment = Product::where('type', 3)->where('status', 1)->count();


		return view(
			'admin.home_page'
			// compact(
			// 	'count_user',
			// 	'count_user_total',
			// 	'count_collaborator',
			// 	'count_admin',
			// 	'count_category',
			// 	'count_tag',
			// 	'count_post',
			// 	'count_prescription',
			// 	'count_consulted',
			// 	'total_healthfood',
			// 	'total_goods',
			// 	'total_equipment',
			// 	'count_order_delivered',
			// 	'count_manufacture',
			// 	'count_pathology',
			// 	'count_pharmacy',
			// 	'count_unit',
			// 	'count_support_treatment',
			// 	'count_pharmacology',
			// 	'total_medicine'
			// )
		);
	}

	public function index()
	{
		// So luong khach hang
		// $count_user = User::where('level', 0)->count();

		// // So luong nhan vien
		// $count_collaborator = Admin::where('level', 0)->count();

		// // So luong quan tri vien
		// $count_admin = Admin::where('level', 1)->count();

		// // Tong so tai khoan tren he thong
		// $count_user_total = $count_user + $count_collaborator + $count_admin;

		// // So luong chu de
		// $count_category = Category::all()->count();

		// // So luong the bai viet
		// $count_tag = Tag::all()->count();

		// // So luong bai viet
		// $count_post = Post::all()->count();

		// // So luong don thuoc gui len he thong
		// // $count_prescription = Prescription::all()->count();
		// $count_prescription = 0;

		// // So luong don thuoc da duoc tu van
		// // $count_consulted = Prescription::where('status', 1)->count();
		// $count_consulted = 0;

		// // So luong don hang da giao thanh cong
		// $count_order_delivered = Order::where('status', 2)->count();

		// // So luong nha san xuat
		// $count_manufacture = Manufacture::all()->count();

		// // So luong dang benh hoc
		// $count_pathology = Pathology::all()->count();

		// // So luong dang bao che
		// $count_pharmacy = Pharmacy::all()->count();

		// // So luong don vi tinh
		// $count_unit = Unit::all()->count();

		// // So luong nhom ho tro dieu tri
		// $count_support_treatment = SupportTreatment::all()->count();

		// // So luong nhom duoc ly
		// $count_pharmacology = Pharmacology::all()->count();

		// // So luong thuoc
		// $total_medicine = Product::where('type', 0)->where('status', 1)->count();

		// // So luong san pham thuc pham chuc nang
		// $total_healthfood = Product::where('type', 1)->where('status', 1)->count();

		// // So luong hang tieu dung
		// $total_goods = Product::where('type', 2)->where('status', 1)->count();

		// // So luong thiet bi y te
		// $total_equipment = Product::where('type', 3)->where('status', 1)->count();

		// // So don hang trong moi thang den thoi diem hien tai
		// $order_each_month = DB::select("SELECT MONTHNAME(created_at) as month, COUNT(id) AS count
		// FROM orders
		// WHERE YEAR(created_at) = YEAR(CURDATE())
		// GROUP BY month
		// ");

		// $month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

		// for ($i = 0; $i < count($month); $i++) {
		// 	$flag = true;
		// 	foreach ($order_each_month as $value) {
		// 		if (strcmp($month[$i], $value->month) == 0) {
		// 			$orders_month[$i] = (int) $value->count;
		// 			$flag = false;
		// 		}
		// 	}
		// 	if ($flag) {
		// 		$orders_month[$i] = 0;
		// 	}
		// }

		// // So don hang giao thanh cong trong moi thang den thoi diem hien tai
		// $order_success_each_month = DB::select("SELECT MONTHNAME(created_at) as month, COUNT(id) AS count
		// FROM orders
		// WHERE YEAR(created_at) = YEAR(CURDATE()) AND status = 2
		// GROUP BY month
		// ");

		// for ($i = 0; $i < count($month); $i++) {
		// 	$flag = true;
		// 	foreach ($order_success_each_month as $value) {
		// 		if (strcmp($month[$i], $value->month) == 0) {
		// 			$orders_success_month[$i] = (int) $value->count;
		// 			$flag = false;
		// 		}
		// 	}
		// 	if ($flag) {
		// 		$orders_success_month[$i] = 0;
		// 	}
		// }

		// // So luong tai khoan dang ki thep tung thang
		// $register_each_month = DB::select("SELECT MONTHNAME(created_at) as month, COUNT(id) as count
		// FROM users
		// WHERE YEAR(created_at) = YEAR(CURDATE())
		// GROUP BY month
		// ");

		// for ($i = 0; $i < count($month); $i++) {
		// 	$flag = true;
		// 	foreach ($register_each_month as $value) {
		// 		if (strcmp($month[$i], $value->month) == 0) {
		// 			$register_month[$i] = (int) $value->count;
		// 			$flag = false;
		// 		}
		// 	}
		// 	if ($flag) {
		// 		$register_month[$i] = 0;
		// 	}
		// }

		// // Don hang thanh toan cao nhat moi thang trong 1 nam
		// $max_payment_each_month = DB::select("SELECT MONTHNAME(created_at) as month, MAX(amount)*1000 AS max_amount
		// FROM orders
		// WHERE YEAR(created_at) = YEAR(CURDATE())
		// GROUP BY month
		// ");

		// for ($i = 0; $i < count($month); $i++) {
		// 	$flag = true;
		// 	foreach ($max_payment_each_month as $value) {
		// 		if (strcmp($month[$i], $value->month) == 0) {
		// 			$max_payment_month[$i] = (float) $value->max_amount;
		// 			$flag = false;
		// 		}
		// 	}
		// 	if ($flag) {
		// 		$max_payment_month[$i] = 0;
		// 	}
		// }

		return view(
			'admin.chart'
			// compact(
			// 	'count_user',
			// 	'count_user_total',
			// 	'count_collaborator',
			// 	'count_admin',
			// 	'count_category',
			// 	'count_tag',
			// 	'count_post',
			// 	'count_prescription',
			// 	'count_consulted',
			// 	'total_healthfood',
			// 	'total_goods',
			// 	'total_equipment',
			// 	'count_order_delivered',
			// 	'count_manufacture',
			// 	'count_pathology',
			// 	'count_pharmacy',
			// 	'count_unit',
			// 	'count_support_treatment',
			// 	'count_pharmacology',
			// 	'total_medicine',
			// 	'orders_month',
			// 	'orders_success_month',
			// 	'register_month',
			// 	'max_payment_month'
			// )
		);
	}

	public function profile()
	{
		if (Auth::guard('admin')->check()) {
			$admin_id = Auth::guard('admin')->user()->id;
			$profile = ProfileAdmin::where('admin_id', $admin_id)->first();
			if ($profile) {
				return view('admin.admin_profile', ['profile' => $profile]);
			} else {
				return redirect('/admin/home');
			}
		} else {
			return redirect('/admin/home');
		}
	}

	public function updateProfile(Request $request)
	{
		$validator = Validator::make(
			$request->all(),
			[
				'introduce' => 'required',
				'detail' => 'required',
			],
			[
				'introduce.required' => 'Không được để thiếu phần giới thiệu bản thân',
				'detail.required' => 'Tóm tắt ngắn gọn thông tin chung về bản thân',
			]
		);
		if ($validator->fails()) {
			return response()->json(['is' => 'failed', 'error' => $validator->errors()->all()]);
		}
		$profile = ProfileAdmin::where('admin_id', $request->admin_id)->update(['introduce' => $request->introduce, 'detail' => $request->detail]);
		if ($profile) {
			return response()->json(['is' => 'success', 'complete' => 'Thông tin về bạn được cập nhật thành công']);
		}
		return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Thông tin về bạn chưa được cập nhật']);
	}
}
