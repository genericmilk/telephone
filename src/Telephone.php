<?php

namespace Genericmilk\Telephone;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Telephone extends Controller
{

    protected $url = null;
    protected $headers = [];
    protected $body = [];

    public static function call($url){
        $this->url = $url; // Add url to top
    }

    public static function headers($header){
        $this->headers = $headers; // Add headers to top
    }    
    public static function body($body){
        $this->body = $body; // Add body to top
    }
    

    public static function get(){

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $this->url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => $this->headers
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
    public static function post(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $this->url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $this->body,
          CURLOPT_HTTPHEADER => $this->headers,
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