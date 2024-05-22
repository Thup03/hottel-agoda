<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Question;
use App\Intro;
use App\Policy;
use App\Regular;
use App\Payment;
use App\Contact;
use Validator;

use Illuminate\Support\Facades\DB;

class NavigatorController extends Controller
{
    public function getAllFaq(){
        $faqs = Question::all();
        return view('faq', ['faqs' => $faqs]);
    }

    public function getIntro(){
        $intro = DB::table('introductions')->select('content')->where('content', '!=', null)->get()->first();
        return view('common_information', ['intro' => $intro]);
    }

    public function getPolicy(){
        $policy = DB::table('policies')->select('content')->where('content', '!=', null)->get()->first();
        return view('common_information', ['policy' => $policy]);
    }

    public function getRegular(){
        $regular = DB::table('regulars')->select('content')->where('content', '!=', null)->get()->first();
        return view('common_information', ['regular' => $regular]);
    }

    public function getPayment(){
        $payment = DB::table('payments')->select('content')->where('content', '!=', null)->get()->first();
        return view('common_information', ['payment' => $payment]);
    }

    public function getShipment(){
        $shipment = DB::table('shipping_methods')->select('content')->where('content', '!=', null)->get()->first();
        return view('common_information', ['shipment' => $shipment]);
    }

    public function getFormContact(){
        return view('contact');
    }

    public function postFormContact(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'content' => 'required',
        ],
        [
            'name.required' => 'Bạn cần nhập tên',
            'email.required' => 'Bạn cần nhập email',
            'email.email' => 'Email không đúng định dạng',
            'content.required' => 'Bạn cần nhập nội dung',
        ]);
        if ($validator->fails()) {
            return response()->json(['is' => 'failed', 'error'=>$validator->errors()->all()]);
        }
        $data = $request->all();
        unset($data['_token']);
        $flag = Contact::create($data);
        if($flag){
            return response()->json(['is' => 'success', 'complete'=>'Cám ơn bạn đã liên hệ với chúng tôi. Chúc bạn sức khỏe và thành công!']);
        }
        return response()->json(['is' => 'unsuccess', 'uncomplete'=>'Nội dung của bạn gửi đã gặp lỗi']);
    }
}
