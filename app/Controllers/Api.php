<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class Api extends BaseController
{
    public function callApi($url, $headers)
    {
        $client = new Client();
        $request = new Request('GET', $url, $headers);
        $res = $client->sendAsync($request)->wait();
        return json_decode($res->getBody(), true);
    }
}
