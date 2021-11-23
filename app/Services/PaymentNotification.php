<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Model\ChildParent;


class PaymentNotification
{
    public  function  sendNotification($title,$body,$type)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = ChildParent::whereNotNull('device_Token')->pluck('device_Token')->all();
        $serverKey = 'AAAAnmqyfXk:APA91bGv5QBbDNCuJI_TemiuWWWyDK0dK_Frt1FlywbbdM7IG_n7grcGg09Y_Br8h132d9EM1rslDAoEha8v7o0KeMvlS5jDIVQM240NH2lI6VSpoI8JlF99OandOMRqen_Tec0GglOz';
        $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "type"=> $type,
                "title" => $title,
                "body" => $body,
            ]
        ];

        $encodedData = json_encode($data);
        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);

        // Execute post
        $result = curl_exec($ch);

        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);

        // FCM response
        // dd($result);
    }
}
