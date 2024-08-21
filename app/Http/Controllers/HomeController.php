<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeModel;
use App\Models\User;

class HomeController extends Controller
{


    public function home(Request $request)
    {
        $user = HomeModel::first();
        return response()->json($user);
    }




    public function about(Request $request)
    {
        return view('components.about');
    }
    public function contact(Request $request)
    {
        return view('components.contact');
    }
    public function portfolio(Request $request)
    {
        return view('components.Portfolio');
    }
    public function service(Request $request)
    {
        return view('components.Service');
    }
}
