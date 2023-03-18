<?php

namespace App\Http\Controllers;

use App\Table;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function json($code, $status, $message, $data = null)
    {

        return response()->json(['status' => [
            'code' => $code, 'status' => $status, 'message' => $message
        ], 'data' => $data], $code);

    }


    function notfiy($msg = 'test', $sub = 'test', $head = 'test', $ids = array(), $type = 1, $id = 0)
    {


        $content = array(
            "en" => $msg, "ar" => $msg
        );
        $headings = array(
            "en" => $head, "ar" => $head
        );
        $subtitle = array(
            "en" => $sub, "ar" => $sub
        );
        $hashes_array = array();
        array_push($hashes_array, array(
            "id" => "like-button",
            "text" => "Like",
            "icon" => "http://i.imgur.com/N8SN8ZS.png",
            "url" => "https://yoursite.com"
        ));
        array_push($hashes_array, array(
            "id" => "like-button-2",
            "text" => "Like2",
            "icon" => "http://i.imgur.com/N8SN8ZS.png",
            "url" => "https://yoursite.com"
        ));
        $fields = array(
            'app_id' => "162c155f-97c3-4457-bbf5-e9f6da22b0dc",
//            'included_segments' => array('All'),
            'include_player_ids' => $ids ?? [],
            'data' => array(
                "order_id" => $id
            ),
            'contents' => $content,
            'headings' => $headings,
            'subtitle' => $subtitle,

        );

        $fields = json_encode($fields);


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic MGI3Nzc3OTYtNDc0OC00YmUyLWIxY2ItZGQ3MzcyOTdmMmM4'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
//        dd($response);
        return $response;
//        $content = array(
//            "en" => $msg, "ar" => $msg
//        );
//        $headings = array(
//            "en" => $head, "ar" => $head
//        );
//        $subtitle = array(
//            "en" => $sub, "ar" => $sub
//        );
//
//            $fields = array(
//                'app_id' => "162c155f-97c3-4457-bbf5-e9f6da22b0dc",
//                'include_player_ids' => $ids,
//                'data' => array("foo" => "bar"),
//                'large_icon' => "https://qdentgroup.com/qdent.png",
//                'contents' => $content,
//                'subtitle' => $subtitle,
//                'headings' => $headings,
//            );
//
//
//
//
//        $fields = json_encode($fields);
////        print("\nJSON sent:\n");
////        print($fields);
//
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
//            'Authorization: Basic MWVkMDVjY2MtZTY4YS00Yjk5LTlhMTMtNThlMjk1NGIyNGNh'));
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//        curl_setopt($ch, CURLOPT_HEADER, FALSE);
//        curl_setopt($ch, CURLOPT_POST, TRUE);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
//
//        $response = curl_exec($ch);
//        curl_close($ch);
//        dd($response);
//        return $response;

    }

    public function fcmNotification($token, $title, $sub_title, $body)
    {
        if (count($token) < 1)
            return null;


        $msg = [
            'title' => $title,
            'sub_title' => $sub_title,
            'message' => $body,
            'icon' => 'myicon',
            'sound' => 'mySound',
        ];
        
        $fields = [
            'registration_ids' => $token,
            'notification' => $msg,
        ];

        $headers = [
            'Authorization: key=' . 'AAAACVfav2c:APA91bGDT3fQ4rac2GvonTSXEJ96nDxhLrIz5yv-SFM2zFcVLTf-7Dljt4i8AmAwNbqBoTbj3p7BqfXbCNDd5EQ_MVI713e_RPr_ScTeSBmU9z5pvftjB-4wFxs03gD0rcMxh2TCxdtv',
            'Content-Type: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
//    dd($result);
        return $result;
    }

}
