<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Room;
use Auth;
use Validator;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        return view('home');
    }
}
