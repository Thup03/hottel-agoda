<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Validator;

class AccountController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'phone'=>'required',
            'password'=> 'required',
        ],[
            'name.required'=>'Tên đăng nhập là bắt buộc',
            'phone.required'=>'Số điện thoại là bắt buộc',
            'password.required'=>'Mật khẩu là bắt buộc',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error'=>$validator->errors()->all()]);
        }

        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['password'] = bcrypt($request->password);
        $data['status'] = 1;

        unset($data['_token']);
        $member = User::Create($data);

        if($member){
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone'=>'required',
            'password'=> 'required',
        ],[
            'phone.required'=>'Bạn chưa nhập tài khoản',
            'password.required'=>'Bạn chưa nhập mật khẩu',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message'=>$validator->errors()->all()]);
        }

        if(!Auth::attempt(['phone'=>$request->phone,'password'=>$request->password], [$request->remember === "true"]))
        {
            return response()->json(['success' => false, 'message'=>'Sai tài khoản hoặc mật khẩu!']); 
        }

        if(Auth::user()->status == 0){
            Auth::logout();
            return response()->json(['success' => false, 'message'=>'Tài khoản của bạn đang bị khóa. Vui lòng liên hệ với quản trị viên để được hỗ trợ! Trân trọng!']);
        }

        $exist_customer = User::find(Auth::user()->id);
        if(isset($exist_customer)){
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false, 'message'=>'Hệ thống đang gặp sự cố. Mong quý khách hàng thông cảm!']);
    }

    public function logout(){
        Auth::logout();
        return redirect()->intended('/');
    }

    public function myAccount($user_id){
        if(Auth::check()){
            if($user_id == Auth::user()->id){
                $user = User::where('id', $user_id)->first();
                if($user){
                    return view('my_account', compact('user'));
                }
            }
        }
        return view('404');
    }

    public function updateMyAccount(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required'
        ],
        [
         'name.required'=>'Bạn chưa nhập họ tên!!',
         'address.required' => 'Bạn chưa nhập địa chỉ!!',
        ]);
        if ($validator->fails()) {
            return response()->json(['is' => 'failed', 'error'=>$validator->errors()->all()]);
        }
        $data['user_id'] = $request->user_id;
        $data['name'] = $request->name;
        $data['birthday'] = $request->birthday;
        $data['birthday'] = \Carbon\Carbon::parse($data['birthday'])->format('Y-m-d');
        $data['gender'] = $request->gender;
        $data['address'] = $request->address;
        if(Auth::check()){
            if(Auth::user()->id == $data['user_id']){
                $user = User::where('id', $data['user_id'])
                ->update(['name' => $data['name'], 'birthday' => $data['birthday'], 'gender' => $data['gender'], 'address' => $data['address']]);
                if($user){
                    return response()->json(['is' => 'success', 'complete'=>'Thông tin tài khoản đã được cập nhật']);
                }
                return response()->json(['is' => 'unsuccess', 'uncomplete'=>'Việc cập nhật thông tin tài khoản đã gặp sự cố!']);
            }
        }
        return view('404');
    }
}
