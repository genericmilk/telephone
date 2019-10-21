<?php

namespace Genericmilk\Telephone;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Telephone extends Controller
{
    public static function get($Url,$Headers = []){

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $Url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => $Headers
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if (!$err) {
            $response = json_decode($response);
            $response = json_decode(json_encode($response)); // force convert to php object
            return $response;
        } else {
            throw new \Exception('Telephone dropped call; '.$err);
        }
    }
    public static function post($Url,$Headers = [],$Body = []){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $Url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $Body,
          CURLOPT_HTTPHEADER => $Headers,
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            $response = json_decode($response);
            $response = json_decode(json_encode($response)); // force convert to php object
            return $response;
        } else {
            throw new \Exception('Telephone dropped call; '.$err);
        }
    }
}