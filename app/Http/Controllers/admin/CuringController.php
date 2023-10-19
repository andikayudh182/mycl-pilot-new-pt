<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CuringController extends Controller
{
    public function CuringIndex()
    {
        return view('admin.Curing.Index');
    }
}
