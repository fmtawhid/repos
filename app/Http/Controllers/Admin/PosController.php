<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PosController extends Controller
{

    public function __construct()
    {
    }

    public function index(Request $request)
    { 
        return view("backend.admin.pos.index");
    }
}
