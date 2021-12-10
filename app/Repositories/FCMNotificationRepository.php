<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ixudra\Curl\Facades\Curl;


class FCMNotificationRepository {

    public static function sendNotification(Request $request) {
        $devicesToken = User::select('device_token')
                                ->hasFCMToken()
                                ->pluck('device_token')
                                ->all();

        $response = Curl::to('https://fcm.googleapis.com/fcm/send')
                    ->withHeader('Content-Type: application/json')
                    ->withHeader('Authorization: ' . env('FIREBASE_SERVER_KEY'))
                    ->withData([
                        "registration_ids" => $devicesToken,
                        "notification" => [
                            "title" => $request->title,
                            "body" => $request->body
                        ]
                    ])
                    ->asJson()
                    ->post();

        return $response;
    }

    public static function sendNotification2($title, $body) {
        $devicesToken = User::select('device_token')
                                ->hasFCMToken()
                                ->pluck('device_token')
                                ->all();

        $response = Curl::to('https://fcm.googleapis.com/fcm/send')
                    ->withHeader('Content-Type: application/json')
                    ->withHeader('Authorization: ' . env('FIREBASE_SERVER_KEY'))
                    ->withData([
                        "registration_ids" => $devicesToken,
                        "notification" => [
                            "title" => $title,
                            "body" => $body
                        ]
                    ])
                    ->asJson()
                    ->post();

        return $response;
    }
}
