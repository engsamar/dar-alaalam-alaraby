<?php

namespace App\Services;

class SMS
{
    /*
    https://smsmisr.com/api/SMS/?
environment=2&username=X&password=X&language=X&sender=X&mobile=X&message=X

(*)language=(int) 1 For English , 2 For Arabic , 3 For Unicode
     */
    public static function send($numbers, $message, $language = 1)
    {
        $environment = config('sms.sms_environment');
        $username = config('sms.sms_username');
        $password = config('sms.sms_password');
        $apiKey = config('sms.sms_apiKey');
        $userSender = config('sms.sms_userSender');
        $url = config('sms.sms_url');
        $data = [
            "environment" => $environment,
            "username" => $username,
            "password" => $password,
            "apiKey" => $apiKey,
            "sender" => $userSender,
            "message" => $message,
            "mobile" => trim($numbers)
        ];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Cookie: SERVERID=MBE1; userLang=Ar'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}
