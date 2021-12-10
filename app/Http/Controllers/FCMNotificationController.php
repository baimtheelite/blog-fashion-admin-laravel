<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\FCMNotificationRepository;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

class FCMNotificationController extends Controller
{
    public $fCMNotificationRepository;

    public function __construct(FCMNotificationRepository $fCMNotificationRepository)
    {
        $this->fCMNotificationRepository = $fCMNotificationRepository;
    }

    public function notification(Request $request)
    {
        $this->fCMNotificationRepository->sendNotification($request);
    }
}
