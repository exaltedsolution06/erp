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
	
    if ($error) {
        return [
            'status' => false,
            'error'  => $error
        ];
    }
	$data = json_decode($response, true);
//echo "<pre>";print_r($response);
    return [
        'status' => true,
        'msg' => $data['msg'],
        'data'   => $data['data']
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
function call_api_post_with_file($url, $postData = [], $files = [])
{
    $curl = curl_init();

    // check multiple files
    if (
        isset($files['files']['name']) &&
        !empty($files['files']['name'][0])
    ) {

        foreach ($files['files']['tmp_name'] as $key => $tmp_name) {

            // skip empty file
            if (empty($tmp_name)) {
                continue;
            }

            $postData['file_'.$key] = new CURLFile(
                $tmp_name,
                $files['files']['type'][$key],
                $files['files']['name'][$key]
            );
        }
    }

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postData,
        CURLOPT_SSL_VERIFYPEER => false,
    ));

    $response = curl_exec($curl);

    if (curl_errno($curl)) {

        echo curl_error($curl);
        exit;
    }

    curl_close($curl);

    return json_decode($response, true);
}