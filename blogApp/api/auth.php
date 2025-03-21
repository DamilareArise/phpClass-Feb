<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


$key = 'arise';
$header = getallheaders();
if (isset($header) && array_key_exists("Authorization", $header)) {
    $auth_header = $header["Authorization"];
    // list($type, $token) = explode(" ", $auth_header, 2);
    $bearer_token = explode(" ", $auth_header, 2);
    $token = $bearer_token[1];
    try {
        $jwt = JWT::decode($token, new Key($key, 'HS256'));
        $user_id = $jwt->user_id;
    }
    catch (Exception $e) {
        http_response_code(400);
        $message = $e->getMessage();
        echo json_encode(
            [
                "status"=> false, 
                "message" => $message           
            ]
            );
        exit;
    }   

}
else{
    http_response_code(400);
    echo json_encode([
        'status'=> false,
        'message'=> 'Invalid Authorization Token'
    ]);
    exit;
}


?>