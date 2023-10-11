<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OperatorDashboard extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('operator.dashboard');
    }

    public function baglog(){
        return view('operator.BaglogIndex');
    }

    public function mylea(){
        return view('operator.MyleaIndex');
    }

    public function PostTreatment(){
        return view('operator.PostTreatmentIndex');
    }
}

