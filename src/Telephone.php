<?php

namespace Genericmilk\Telephone;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Telephone extends Controller
{

    protected static $url = null;
    protected static $headers = [];
    protected static $body = [];
    

    public static function call($url){
        Telephone::$url = $url; // Add url to top
        $o = new self;
        return $o;
    }

    public static function headers($header){
        Telephone::$headers = $header; // Add headers to top
        $o = new self;
        return $o;

    }    
    public static function body($body){
        Telephone::$body = $body; // Add body to top
        $o = new self;
        return $o;
    }
    public static function bearer($bearer){
        Telephone::$headers[] = 'Authorization: Bearer '.$bearer; // Add body to top
        $o = new self;
        return $o;
    }
    

    public static function get(){

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => Telephone::$url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => Telephone::$headers
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
    public function post(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => Telephone::$url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => Telephone::$body,
          CURLOPT_HTTPHEADER => Telephone::$headers,
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
}