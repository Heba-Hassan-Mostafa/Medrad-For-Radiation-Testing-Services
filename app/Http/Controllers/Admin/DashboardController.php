<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function activity_log()
    {
        $activities = Activity::orderBy('id','desc')->get();

        return view('admin.activity-logs.index', [
          'activities' => $activities,

        ]);
    }
}