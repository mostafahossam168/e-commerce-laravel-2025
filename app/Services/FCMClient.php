<?php


namespace App\Services;


use Google_Client;
use Illuminate\Support\Facades\Log;

class FCMClient
{
    public static function send($device_token, $notification, $data = [], $image = null)
    {
        $accessToken = (setting('fire_base_server_key')) ? setting('fire_base_server_key') : self::getAccessToken();
        $data = is_array($data) ? $data : [];  // Ensure $data is an array
        $dataResult = [];
        foreach ($data ?? [] as $key => $val) {
            $dataResult[$key] = (string) $val;
        }
        $to = $device_token->token;
        Log::info(json_encode(['data' => $data, 'dataResult' => $dataResult], JSON_UNESCAPED_UNICODE));
        $arr_data = [
            'message' => [
                "token" => $to,
                "notification" => [
                    "title" => $notification->title,
                    'body' => $notification->subtitle,
                    'image' => $image,
                ],
                "data" => $dataResult,
                "android" => [
                    "priority" => "high",
                    'notification' => [
                        'sound' => 'notification.wav',
                    ]
                ],
                "apns" => [
                    "headers" => [
                        "apns-priority" => "5"
                    ],
                    'payload' => [
                        'aps' => [
                            'mutable-content' => 1,
                            'sound' => 'notification.wav'
                        ]
                    ]
                ],
            ]
        ];
        // dd($arr_data);
        $dataString = json_encode($arr_data);
        Log::info($dataString);
        // Log::info($dataString);
        $headers = [
            'Content-Type: application/json',
            "Authorization: Bearer $accessToken",

        ];
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/v1/projects/son-7f11f/messages:send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        $result = curl_exec($ch);
        $decodedResult = json_decode($result, true);
        // dd($data);
        if (isset($decodedResult['error'])) {
            if ($decodedResult['error']['code'] == 401 && $decodedResult['error']['status'] == "UNAUTHENTICATED") {
                $accessToken = self::getAccessToken();
                return self::send($device_token, $notification, $data, $image);
            }
        }
        Log::info($result);
        return $decodedResult;
    }

    private static function getAccessToken(): string
    {
        $data = [
            "type" => "service_account",
            "project_id" => "son-7f11f",
            "private_key_id" => "a3dcda2a993e5b198d4ee418d5fc7cb5ec8cf7c2",
            "private_key" => "-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCty+j48ClQFpFj\nZSGUyuGwTT0imzyBfDHByuTtCMuhEaAog2NJUItr2tmKUgp12CWK1zM9nBN5qrTq\nOrI92OuINVzB5UXc8yW1+pK93W0JRmre7fGUuh6bNeokAQU4WzitE2RqVBSSv18f\nXoEXxdHlSA3w8eRYajnMZFZFjX9LT2dtyakmcyryq3FmYUGLxzhEtuKMl+SXD8WP\ndmddurZhGJ/nnZIm5jBzJTT7AC/Wui6NLfbeyWpEDr+pYToz+9EuztMWG4y/giIP\nvwMMWrNXOb95GtAO09mHJhaB+abSRmTzXrjieYwIIb5SCtl2GlPpPXlr/NvyytvO\nD8gFiJM9AgMBAAECggEAFopUdhrRxNsUcp9uZkmU0USHOgqHo6SLoH5zx+FE5agv\nTSnTMfJCDtQ0tBmVVTjaD6J++Q3ZwcUXzywbK2XLkGAZXmVhtPkNCkfMCddiuZn6\nKN0T4K3t48PvkMlYF7nPBTV3Z8ntXCX5TIx5ci+cHCBG/Jmmu6fVRLK7tKwYFxhn\nlzKaxgNxTZU3DD2DVV1UJyZCKWjhuoMkyLIBjh8ki08G6WWmZBcbdoSXlz1+pxKr\nx+1Mq2nRPrrGVMRN89aspDSy9vpbCwSMnENV5rXSFUMncPRz8vzpzgvnhldo3q4B\noZAZeBOeVQRdJ/K70rejDk0V3+gDbSzfijQv1/+EkQKBgQDnYCcT7n1JqrZpqwNG\nRGA9sXIhAyTiXGZumAwmors8x59IsPsDtdxCXgkHeaG2YpP1iBdSEwHmWonGOpja\n+7gOIQdaherKJFDbzTaZax8eEoJckUL1BdND0mNV9LDn7LgRDyKNhB3mVx2cuIq/\nfF5XTBPOvz+3piFlNSt9kQs5UQKBgQDASwLCf42hVrMatTqHoo0V9CPVqJcrW/Qu\n0Nbrpje9LAGLi/GhqFBaYosMX1romqdUiakILkZeqWOSMVRLyf1JAIgmLRscomNV\nyqmolW1YWee2gutOutGXT6WDL31PrH4bZvM2vZUnXslhPPrGC09H390P/Hk26DM5\n+zq+obeALQKBgQCWAIhVK7CeKcbJCs28qGecl4XeUSOAfVcLLBf0lFu/M8vYXKTf\n6u85N62y4vAsRgyWifxUgW4h4WCg2yxuC/NvdYpG7bsiAhlJ5ukW3ZP28xkA2kwG\nfhhRR/yOpWxrb9SFesJz7MtVofTYvet16TNgdToCN4sfjNzpuGbRqU8VgQKBgHio\nGIk2RAYyQpvFj34/7ssRr9KGwKQCRMuDWvfuChd3H1kSbIGE/TZZkuomgwJk2A3h\neuCZOKp5GvNGZKBRk85UuRlLQDHNawsP6TjQ2hWQBCavKzrxWkXZQf94suZlU5Oa\nG44Dky1q+m07OBdATXTJ8Qnw35YmSM5e51NqYZvZAoGBAOY4M6F41qdlx1gWisFc\nGnzWUC48aPVBAK201EmzE134yLjWxxRm3laYB49w8k3HIF0jTKE7EfEenfCiUo1v\nd5ZLXm2J2xsmseSrID84XE4huQH6YWvA7GoXQ3kaMDrlkrc+1d3lGr1QZVgHGqXE\nlMku4CtQxr7W1/G4AIsngND2\n-----END PRIVATE KEY-----\n",
            "client_email" => "firebase-adminsdk-x4vz8@son-7f11f.iam.gserviceaccount.com",
            "client_id" => "116670676265251312335",
            "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
            "token_uri" => "https://oauth2.googleapis.com/token",
            "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
            "client_x509_cert_url" => "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-x4vz8%40son-7f11f.iam.gserviceaccount.com",
            "universe_domain" => "googleapis.com",
        ];

        $client = new Google_Client();
        $client->setAuthConfig($data);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithAssertion();
        }

        $accessToken = $client->getAccessToken();
        setting([
            'fire_base_server_key' => $accessToken['access_token']
        ])->save();
        return $accessToken['access_token'];
    }
}
