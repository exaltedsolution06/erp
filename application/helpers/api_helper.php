<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function call_api_get($url, $headers = []) {
    
    $ch = curl_init();

    curl_setopt_array($ch, [
        CURLOPT_URL            => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_HTTPHEADER     => $headers
    ]);

    $response = curl_exec($ch);
    $error    = curl_error($ch);

    curl_close($ch);
	
	print_r($response);die;

    if ($error) {
        return [
            'status' => false,
            'error'  => $error
        ];
    }

    return [
        'status' => true,
        'data'   => json_decode($response, true)
    ];
}
function api_response($status,$message,$data = [])
{
    header('Content-Type: application/json');

    echo json_encode([
        'status' => $status,
        'message' => $message,
        'data' => $data
    ]);

    exit;
}