<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\User;
use App\Models\UserActivity;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $userActivities = UserActivity::with('user')
                            // ->take(10)
                            ->latest()
                            ->get();

        $latestUsers = User::latest()->get();

        $announcement = Announcement::isHighlight()->latest()->first();

        $data = compact(
            'userActivities',
            'latestUsers',
            'announcement'
        );

        return view('index', $data);
    }
}
