<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;

class TeamMemberController extends Controller
{
    public function index()
    {
        return view('backend.admin.team-member.index');
    }
}
