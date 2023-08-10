<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class Api extends BaseController
{
    /**
     * The function `callApi` sends a GET request to a specified URL with headers and returns the
     * response body as a JSON-decoded array.
     * 
     * @param string $url The URL of the API endpoint you want to call. This is the address where the API is
     * hosted and the specific route you want to access.
     * @param array $headers The `` parameter is an array that contains the headers to be sent with
     * the API request. Headers are used to provide additional information about the request, such as
     * authentication credentials or content type. Each header in the array should be in the format
     * `header_name: header_value`. For example:
     * 
     * @return array of the response body of the API call as a JSON-decoded array.
     */
    public function callApi(string $url, array $headers)
    {
        $client = new Client();
        $request = new Request('GET', $url, $headers);
        $res = $client->sendAsync($request)->wait();
        return json_decode($res->getBody(), true);
    }
}
