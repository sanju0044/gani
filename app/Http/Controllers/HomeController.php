<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    public function index(){
        return view('pages.login');
    }

    public function home()
    {
        $student_count = User::where('user_type','4')->count();
        $mentor_count = User:: where('user_type','3')->count();
        return view('pages.home',compact('student_count','mentor_count'));
    }

    public function contact_info()
    {
        return view('pages.contact-information');
    }

    public function dashboard(){
        return view('pages.dashboard');
    }

}
