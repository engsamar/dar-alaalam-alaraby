<?php

namespace App\Services;

class Firebase
{
    public static function send($tokens, $title, $message, $other)
    {
        if (!empty($tokens) && count($tokens) > 0) {
            $data = [
                'body' => $message,
                'title' => $title,
                'priority' => 'high',
                'message' => $message,
                'data' => $other,
            ];

            $fields = [
                'registration_ids' => $tokens,
                'notification' => $data,
                'priority' => 'high',
                'data' => $data,
            ];
            $headers = ['Authorization: key=' . config('app.fcm_token'), 'Content-Type: application/json'];

            //Send Reponse To FireBase Server
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            curl_close($ch);
            //Echo Result Of FireBase Server
            logger(print_r($result, true));

            return $result;
        }
    }
}
