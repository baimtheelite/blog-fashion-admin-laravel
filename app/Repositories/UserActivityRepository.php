<?php

namespace App\Repositories;

use App\Models\UserActivity;
use Illuminate\Support\Facades\Auth;

class UserActivityRepository {

    public static function insertLog($menu_halaman, $aktivitas) {
        return UserActivity::create([
            'email' => Auth::user()->email ?? 'GUEST',
            'user_id' => Auth::id() ?? null,
            'menu_halaman' => config('app.name') . ' - ' . $menu_halaman,
            'aktivitas' => $aktivitas,
            'address' => url()->full(),
            'ip' => request()->ip()
        ]);
    }
}
