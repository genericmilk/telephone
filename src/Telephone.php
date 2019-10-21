<?php

namespace Genericmilk\Telephone;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Telephone extends Controller
{
    public static function get($Url,$Headers = []){
        // throw new \Exception('No Element Configuration Set');
        return (object)[
            'telephone' => 'ringring'
        ];
    }
}