<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
use Illuminate\Http\JsonResponse;
class JsonHelper {
    function jsonResponse($data) {
        $response = JsonResponse::create($data,200);
        $response->send();
    }
    private function _getJsonData($path, $isDecode) {
        $headers = [];
        if(defined("API_TOKEN_KEY")) {
            $headers = [
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Bearer ' . API_TOKEN_KEY,
            ];
        } else {
            $headers = [
                'Content-Type: application/x-www-form-urlencoded',
            ];
        }
        $optHttp = [
            'method' => 'GET',
            'timeout' => 30,
            'ignore_errors' => true,
        ];
        $optHttp['header'] = implode( "\r\n", $headers );
        $options = array('http' => $optHttp);
        $stream = stream_context_create( $options );
        $body_ori = file_get_contents($path, false, $stream);
        if($isDecode) {
            $body = json_decode($body_ori, "assoc", 512);
        }
        if(null === $body) {
            die("404 : Not Found\r\n" . htmlspecialchars($body_ori));
        } else if(!empty($body['code'])){
            die("{$body['code']} : {$body['message']}");
        }
        return $body;
    }
    function getJsonDataNoDebug($path, $isDecode) {
        return self::_getJsonData($path, $isDecode);
    }
    function getJsonData($path, $isDecode) {
        return self::_getJsonData($path, $isDecode);
    }

    function getLocalJsonData($filePath, $isDecode) {
        $body = file_get_contents(ROOT . $filePath);
        if($isDecode) {
            $body = json_decode($body, "assoc", 512);
        }
        return $body;
    }

    function viewJson($data) {
        header('content-type: application/json; charset=utf-8');
        if(is_array($data)) {
            $data = json_encode($data);
        }
        print($data);
    }
}
