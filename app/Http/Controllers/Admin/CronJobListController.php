<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CronJobListController extends Controller
{
    public function index()
    {
        return view('backend.admin.settings.cron_list');
    }
}
