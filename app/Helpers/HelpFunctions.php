<?php

namespace App\Helpers;

use Exception;
use URL;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Crypt;

//use Ixudra\Curl\CurlService;

class HelpFunctions {

    public static function create_token($id, $email, $unique_id, $type = 'user') {
        $accessToken = serialize(array(
            'id' => $id,
            'email' => $email,
            'unique_id' => $unique_id,
            'type' => $type,
            'timestamp' => \Carbon\Carbon::now()->toDateTimeString(),
        ));
        $accessToken = Crypt::encrypt($accessToken);
        return $accessToken;
    }

    public static function thumb_create($image_path = "", $type = 'profile_picture_user') {
        try {
            if ($image_path == "") {
                return "";
            }
            $profile_picture_path_user = base_path() . '/public' . config('app.profile_picture_path_user');
            $product_image_path = base_path() . '/public' . config('app.product_image_path');

            switch ($type) {
                case 'profile_picture_user':
                    $destinationPath = $profile_picture_path_user;
                    break;
                case 'profile_picture_artist':
                    $destinationPath = $profile_picture_path_artist;
                    break;
                case 'profile_picture_admin':
                    $destinationPath = $profile_picture_path_admin;
                    break;
                case 'product_image':
                    $destinationPath = $product_image_path;
                    break;
            }
            $ext = \File::extension($image_path);
            $new_image_name = self::image_name() . '.' . $ext;

            $img = Image::make($destinationPath . $image_path)->orientate();
            $img->resize(640, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($destinationPath . 'thumb/' . $new_image_name);

            if (file_exists($destinationPath . 'thumb/' . $new_image_name)) {
                return $new_image_name;
            } else {
                return "";
            }
        } catch (Exception $e) {
            return response(self::returnError($e->getCode(), $e->getMessage()), $e->getCode())->header('Content-Type', 'application/json');
        }
    }

    public static function image_upload($image_obj, $type = 'profile_picture_user', $create_thumb = true) {
        try {
            $profile_picture_path_user = base_path() . '/public' . config('app.profile_picture_path_user');
            $profile_picture_path_artist = base_path() . '/public' . config('app.profile_picture_path_artist');
            $profile_picture_path_admin = base_path() . '/public' . config('app.profile_picture_path_admin');
            $product_image_path = base_path() . '/public' . config('app.product_image_path');
            $product_other_image_path = base_path() . '/public' . config('app.product_other_image_path');
            switch ($type) {
                case 'profile_picture_user':
                    $destinationPath = $profile_picture_path_user;
                    break;
                case 'profile_picture_artist':
                    $destinationPath = $profile_picture_path_artist;
                    break;
                case 'profile_picture_admin':
                    $destinationPath = $profile_picture_path_admin;
                    break;
                case 'product_image':
                    $destinationPath = $product_image_path;
                    break;
                case 'product_other_image':
                    $destinationPath = $product_other_image_path;
                    break;
            }
            $new_image_name = self::image_name() . '.' . $image_obj->getClientOriginalExtension();
            $uploaded_img = $image_obj->move($destinationPath, $new_image_name);
            if ($uploaded_img) {
                if (file_exists($destinationPath . $new_image_name)) {
                    if (!$create_thumb) {
                        return $uploaded_img;
                    } else {
                        $img = Image::make($destinationPath . $new_image_name);
                        $img->resize(640, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                        $img->save($destinationPath . 'thumb/' . $new_image_name);

                        if (file_exists($destinationPath . 'thumb/' . $new_image_name)) {
                            return $uploaded_img;
                        }
                    }
                }
            }
            return false;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function compress($source, $destination, $quality = 100) {
        $type = getimagesize($source);
        if ($type['mime'] == 'image/jpeg' || $type['mime'] == 'image/jpg') {
            $image = imagecreatefromjpeg($source);
        } else if ($type['mime'] == 'image/gif') {
            $image = imagecreatefromgif($source);
        } else if ($type['mime'] == 'image/png') {
            $image = imagecreatefrompng($source);
        }
        $size = getimagesize($source, $info);
        if (function_exists('exif_read_data') && isset($info["APP1"])) {
            $exif = @exif_read_data($source);
            if (!empty($exif['Orientation'])) {
                switch ($exif['Orientation']) {
                    case 3: $image = imagerotate($image, 180, 0);
                        break;
                    case 6: $image = imagerotate($image, -90, 0);
                        break;
                    case 8: $image = imagerotate($image, 90, 0);
                        break;
                    default: $image = $image;
                }
            }
        }
        imagejpeg($image, $destination, $quality);
        dd($destination);
        return $destination;
    }

    public static function excel_upload($excel_obj, $type = 'user_excel') {
        try {
            $user_excel_path = base_path() . '/public' . config('app.user_excel_path');

            switch ($type) {
                case 'user_excel':
                    $destinationPath = $user_excel_path;
                    break;
            }
            $new_excel_name = self::image_name() . '.' . $excel_obj->getClientOriginalExtension();
            $uploaded_excel = $excel_obj->move($destinationPath, $new_excel_name);
            if ($uploaded_excel) {
                if (file_exists($destinationPath . $new_excel_name)) {
                    return $uploaded_excel;
                }
            }
            return false;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function pdf_upload($pdf_obj, $type = 'user_pdf') {
        try {
            $user_pdf_path = base_path() . '/public' . config('app.user_pdf_path');

            switch ($type) {
                case 'user_pdf':
                    $destinationPath = $user_pdf_path;
                    break;
            }
            $new_pdf_name = self::image_name() . '.' . $pdf_obj->getClientOriginalExtension();
            $uploaded_pdf = $pdf_obj->move($destinationPath, $new_pdf_name);
            if ($uploaded_pdf) {
                if (file_exists($destinationPath . $new_pdf_name)) {
                    return $uploaded_pdf;
                }
            }
            return false;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function pdf_thumb($pdf_obj, $type = 'user_pdf') {
        try {
            $user_pdf_path = base_path() . '/public' . config('app.user_pdf_path');
            $user_pdf_path_thumb = base_path() . '/public' . config('app.user_pdf_path') . 'thumb/';
            $current_pdf_path = $user_pdf_path . basename($pdf_obj);

            if (file_exists($current_pdf_path)) {

                $imagick = new \Imagick($current_pdf_path . '[0]');
                $imagick->setImageFormat('jpg');

                $new_pdf_name = self::image_name() . '.jpg';

                file_put_contents($user_pdf_path . 'thumb/' . $new_pdf_name, $imagick);

                return $new_pdf_name;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public static function video_upload($video_obj, $type = 'user_video') {
        try {
            $user_video_path = base_path() . '/public' . config('app.user_video_path');

            switch ($type) {
                case 'user_video':
                    $destinationPath = $user_video_path;
                    break;
            }
            $new_video_name = self::image_name() . '.' . $video_obj->getClientOriginalExtension();
            $uploaded_video = $video_obj->move($destinationPath, $new_video_name);
            if ($uploaded_video) {
                if (file_exists($destinationPath . $new_video_name)) {
                    return $uploaded_video;
                }
            }
            return false;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function video_thumb($video_obj, $type = 'user_video') {
        try {
            $user_video_path = base_path() . '/public' . config('app.user_video_path');
            $user_video_path_thumb = base_path() . '/public' . config('app.user_video_path') . 'thumb/';
            $current_video_path = $user_video_path . basename($video_obj);

            if (file_exists($current_video_path)) {
                $cmd = "ffmpeg -i $current_video_path 2>&1";

                $second = 0;

                if (preg_match('/Duration: ((\d+):(\d+):(\d+))/s', `$cmd`, $time)) {
                    $total = ($time[2] * 3600) + ($time[3] * 60) + $time[4];
                    $second = rand(0, ($total - 1));
                }
                $ImageFileName = pathinfo($current_video_path);
                $image = $user_video_path_thumb . $ImageFileName["filename"] . '.jpg';

                shell_exec("/usr/bin/ffmpeg -i $current_video_path -pix_fmt yuvj422p -deinterlace -an -ss $second -t 00:00:01 -r 1 -y -vcodec mjpeg -f mjpeg $image 2>&1");

                return $image;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public static function image_name() {
        $unique_name = md5(date('YmdHms') . uniqid());
        return $unique_name;
    }

    public static function getLatLong($Address) {
        $string = 'https://maps.google.com/maps/api/geocode/json?address=' . urlencode($Address) . '&key=key';
        $geocode = file_get_contents($string);
        $output = json_decode($geocode, true);
        if (isset($output['status']) && $output['status'] != "ZERO_RESULTS") {
            if (strtolower($output['status']) == strtolower("OK")) {
                if (!empty($output['results'][0]['geometry']['location'])) {
                    return $output['results'][0]['geometry']['location'];
                }
            }
        }
        return false;
    }

    public static function sendMessage($mobile_number, $message) {
        try {
            $key = config('app.sinch_app_key');
            $secret = config('app.sinch_app_secret');

            $phone_number = $mobile_number;

            $message = array("message" => $message);

            $user = "application\\" . $key . ":" . $secret;
            $data = json_encode($message);
            $ch = curl_init('https://messagingapi.sinch.com/v1/sms/' . $phone_number);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_USERPWD, $user);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

            $result = curl_exec($ch);
            $resopnse = [];
            if (curl_errno($ch)) {
                throw new Exception("Please make sure entered number is correct", 422);
            } else {
                $resopnse['code'] = 200;
                $resopnse['data'] = json_decode($result, true);
            }
            curl_close($ch);
            return $resopnse;
        } catch (Exception $e) {
            return response(self::returnError($e->getCode(), $e->getMessage()), $e->getCode())->header('Content-Type', 'application/json');
        }
    }

    public static function returnError($code = 500, $message = 'Internal server error') {
        return json_encode(array('error' => array
                (
                'message' => $message,
            ), 'code' => $code));
    }

    /*
     *
     * //curl post library 
     * run : composer require ixudra/curl
     * config/app.php  => Ixudra\Curl\CurlServiceProvider::class,
     * 'Curl'          => Ixudra\Curl\Facades\Curl::class,
     */

    public static function curl_post($type = 'GET', $url, $data = [], $headers = [], $isJsonPayload = false) {
        $response = null;
        $return['success'] = false;
        $return['message'] = "";
        $return['data'] = [];
        $curl = \Ixudra\Curl\Facades\Curl::to($url);
        if (!empty($data)) {
            $curl->withData($data);
        }
        if (!empty($headers)) {
            foreach ($headers as $key => $head) {
                $curl->withHeader("$key: $head");
            }
        }
        //dd($curl);
        if ($isJsonPayload) {
            $curl->asJson();
        }
        if ($type == 'GET') {
            $response = $curl->get();
        }
        if ($type == 'POST') {
            $response = $curl->post();
        }
        if ($type == 'PUT') {
            $response = $curl->put();
        }
        if ($type == 'PATCH') {
            $response = $curl->patch();
        }
        if ($type == 'DELETE') {
            $response = $curl->delete();
        }
//        echo "<pre>";
//        print_r($response);
//        exit;
        if (empty($response)) {
            $return['message'] = "Something went wrong while calling FNX request";
            return $return;
        }
        $response = json_decode($response, true);
        if ($response['status'] != true) {
            if (!empty($response['message'])) {
                $return['message'] = "FENIX SERVER ERROR : " . $response['message'];
            } else {
                $return['message'] = "FENIX SERVER ERROR : ";
            }
            return $return;
        }
        $return['success'] = true;
        $return['data'] = $response;
        return $return;
    }

    public static function googleCaptcha($g_recaptcha_response) {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = [
            'secret' => 'secret',
            'response' => $g_recaptcha_response
        ];
        $options = [
            'http' => [
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            ]
        ];
        $context = stream_context_create($options);
        $verify = file_get_contents($url, false, $context);
        $captcha_success = json_decode($verify, true);

        $response['success'] = false;
        if (empty($captcha_success['success'])) {
            $msg = (!empty($captcha_success['error-codes'][0])) ? $captcha_success['error-codes'][0] : 'error';
            $response['message'] = 'Captcha : ' . $msg;
        } else {
            $response['success'] = true;
            $response['message'] = '';
        }

        return $response;
    }

}
