<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Admin;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function member()
    {
        $users = User::where('level', 0)->orderBy('created_at', 'desc');
        return view('user.members_list', ['users' => $users->paginate()]);
    }

    public function collaborator()
    {
        $users = Admin::where('level', 0)->orderBy('created_at', 'desc');
        return view('user.collaborators_list', ['users' => $users->paginate()]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'birthday' => 'required',
            'gender' => 'required',
            'indetity_cart' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'password' => 'required|min:8|max:32',
        ],

        [
            'name.required' => 'Tên nhân viên không được để trống',
            'avatar.required' => 'Ảnh nhân viên không được để trống',
            'birthday.required' => 'Ngày sinh nhân viên không được để trống',
            'gender.required' => 'Giới tính nhân viên không được để trống',
            'indetity_cart.required' => 'Số chứng minh nhân dân của nhân viên không được để trống',
            'phone_number.required' => 'Số điện thoại nhân viên không được để trống',
            'email.required' => 'Email nhân viên không được để trống',
            'email.email' => 'Email chưa đúng định dạng',
            'address.required' => 'Địa chỉ nhân viên không được để trống',
            'password.required' => 'Yêu cầu nhập mật khẩu',
            'password.min' => 'Mật khẩu tối thiểu 8 kí tự',
            'password.max' => 'Mật khẩu tối đa 32 kí tự',
            'avatar.image' => 'Yêu cầu phải là ảnh có đuôi jpeg,png,jpg,gif',
            'avatar.mimes' => 'Yêu cầu phải là ảnh có đuôi jpeg,png,jpg,gif',
            'avatar.max' => 'Ảnh không vượt quá 2MB',
        ]);

        if ($validator->fails()) {
            return response()->json(['is' => 'failed', 'error'=>$validator->errors()->all()]);
        }else{
            $data = $request->all();
            unset($data['_token']);
            $time = time();
            if($files = $request->file('avatar')) {
                $destinationPath = 'images/admins/'; // upload path
                $time = time();
                $fileName = $time."".date('YmdHis')."".$files->hashName();
                $files->move($destinationPath, $fileName);
                $data['avatar'] = $fileName;
            }
            
            $data['birthday'] = \Carbon\Carbon::parse($data['birthday'])->format('Y-m-d H:i:s');

            $data['level'] = 0;
            $data['status'] = 1;
            $data['password'] = bcrypt($data['password']);

            $admin = Admin::create($data);

            if(isset($admin)){
                return response()->json(['is' => 'success', 'complete'=>'Một nhân viên mới đã được thêm thành công']);
            }
            else{
                return response()->json(['is' => 'unsuccess', 'uncomplete'=>'Một nhân viên mới chưa được thêm thành công']);
            }
        }
    }


    public function show($id)
    {
        $user = User::find($id);
        return $user;
    }

    public function updateMember(Request $request, $id)
    {
        $data = $request->all();
        $user = User::find($data['id']);
        unset($data['_token']);

        if($user->status == 0)
        {
            $user->status = 1;
        }
        else{
            $user->status = 0; 
        }

        $user->save();
    }

    public function destroyMember($id)
    {
        User::findOrFail($id)->delete();
    }

    public function updateCollaborator(Request $request, $id)
    {
        $data = $request->all();
        $collaborator = Admin::find($data['id']);
        unset($data['_token']);

        if($collaborator->status == 0)
        {
            $collaborator->status = 1;
        }
        else{
            $collaborator->status = 0; 
        }

        $flag = $collaborator->save();
    }

    public function destroyCollaborator($id)
    {
        $collaborator = Admin::findOrFail($id)->delete();
    }
}
