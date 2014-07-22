<?php
/**
 * Created by PhpStorm.
 * User: HUNG NGUYEN
 * Date: 7/22/14
 * Time: 11:19 PM
 */

class ImgurAPI {
    public static function uploadImage($image_url,$client_id)
    {
        $pvars   = array('image' => $image_url);
        $timeout = 30;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
        $out = curl_exec($curl);
        curl_close ($curl);
        $pms = json_decode($out,true);
        $url=$pms['data']['link'];

        return $url;
    }
} 