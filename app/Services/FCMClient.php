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
        // dd($to);
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
            "project_id" =>  "laravel11-e9b7b",
            "private_key_id" =>  "54acce245caa68f1ec452f6e4b74867f32d14128",
            "private_key" =>  "-----BEGIN PRIVATE KEY-----\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQC7wztO5IlU/9Sf\nsPyba8VM6NkzhlnlDABn4g+0R7Da0uCmZlVv2W49Q0dPmHX7WCtknIoMlZ1g1cvG\n0qWYBjhYYZJN/E1Wek1kUyQ4D+Gll87Z3Y7gt21rTrrgWVQzud/szfbB5ZBDURn2\ng2/S+aECoBGbcCUF8aa46nCbS5yOIeuKJPsmQmazcomANZ47FXkyOkrXSJxOa0HU\n7Ythe672nOLSBCV4ey1Vv+DP90Dp5crY3W26z23ChXd+eU7YYhVNPiw/y8i7++RH\n81/fhasflsbNoziYz+7PJgNYfh6psWXGfSwE8UgkghXoDQh5ysvHmyMSIIys6Osa\n4R1rX6KdAgMBAAECggEAJ/X5HWVORSTdn88PNBTPvPqhn3GsmC7htzpJlVjcrvXK\nkh+dd1yTNb6n4qzUD1ZIhfU6/EqrX/ygjgQu8hgAze6WMLrNyuXkqsF3J+dZYuDY\nSU36JqFjTD9JTo40eX3JxqBfMA0nkuwj1m9K0WAHgIOIu8g2WPmBPkHHDYYeH7GD\nBti3gnKZZqzSPdDHkLyQMRlERH4pMYov4Bq7WIwFZFM70QF+7HkUXziLDWV5NarI\nNDSJrk2iZoZi5by61Ngt1tpfOrG/KkDNwLTTrnGlYwQrG1neSRjQ6gv/teg8Fr2C\no7uZN7/V+C2+VgSyNLW9FPUDjy9lDfOqiTibq4O0AQKBgQDj/krEYeksuY5dEuTt\nMvT+yVbmqTvYDrI2LvUjtzhhm+x9SmYSKFCiXeAz28Yo2E2ElM4V4cL1i3maYAgu\n9veuHkiHWCZ5ONTwJEkb45qzOruZb96h9RDTZIvCeXqgL92Y8+upndmOPw77JEt5\npTK0yVelsV/FNX28ijRdpUmRQQKBgQDS083pCQbbZL5ZA+iQHR8Q9Fnb42pEXVIX\nR4KVRPYIjrqsE+P35JzDDV4g/P3y761Pdh2f48eqkz3oM9AKV0QH6GdA0eWWpuf2\niMjMn679roAHkOuwWqQgbfaBJe8fDfNX7BNv/MSDyeyPpYbSRgWqlRgXeTg4y5zy\n3Kzz+FBeXQKBgQDiGOxMlEyI7fsgkfw0vrP3d/OWC34tZWWWFjtEkA55vgdouL9A\ngnp0imQtCWYaW2eEc41sZdbRat/NGC8FZCV7psyGbAS7coC5JULbRXvFAhnIsAg4\n1K869BslYRMaiF1ZsYujScbWKfLRW8z9dbYzUvh4eM5g5AstTmFf/OpYAQKBgHKW\nNABIq7Vq2BpBiZFqgowQgxaEUCnAHvIQJ+VBige0q7kDRpBhbOKGzXZYix4TLrtV\nk1xnzQnk5WzjXFuCerNhmV0duA9dwA264oh08gNnaKa0GaXMXhBSM/yVxZW3W1+a\nLCZd1+FZSn34lYKMFGBWkLWRaQFViYRmdIpVmDjxAoGAcBoeDZGcKZJT55lKff81\n8oF1KN5zWMRhR1ySZ5hpDPVGPbbKslVjbEmPZX12zl3vtogrveAUJHkakrZN5qbj\n7tKi1vUpjZr2kkJLgiKwn6YzZZxiRJD92D4OSky+/IkEuHd+lx1HSmPVlroa8rpb\n+awyJOnSPAj7PvYiL+lv5Eo=\n-----END PRIVATE KEY-----\n",
            "client_email" =>  "firebase-adminsdk-fbsvc@laravel11-e9b7b.iam.gserviceaccount.com",
            "client_id" => "103108069300771254981",
            "auth_uri" =>  "https://accounts.google.com/o/oauth2/auth",
            "token_uri" => "https://oauth2.googleapis.com/token",
            "auth_provider_x509_cert_url" =>  "https://www.googleapis.com/oauth2/v1/certs",
            "client_x509_cert_url" =>  "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-fbsvc%40laravel11-e9b7b.iam.gserviceaccount.com",
            "universe_domain" =>  "googleapis.com"
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
