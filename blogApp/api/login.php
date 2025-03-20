<?php 
    require_once __DIR__ . '/../../vendor/autoload.php';
    require "../database.php";
    header("Content-Type: application/json");
    use Firebase\JWT\JWT;

    $key = 'arise';
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $payload = file_get_contents("php://input");
        $payload = json_decode($payload, true);
        if(isset($payload)){
            $email = $payload['email'];
            $password = $payload['password'];
            $sql = "SELECT * FROM user_table WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                $user = mysqli_fetch_assoc($result);
                $verify = password_verify( $password, $user["password"] );
                if($verify){
                    $jwt_payload = [
                        "iss" => "http://localhost/",
                        "aud" => $user['email'],
                        "iat" => time(),
                        "exp" => time() + 3600,
                        "user_id" => $user["id"],
                    ];
                    $jwt = JWT::encode($jwt_payload, $key, 'HS256');

                    echo json_encode(
                        [
                            "status" => true,
                            "message" => "Login Success",
                            "data" => [
                                "id" => $user["id"],
                                "fullname" => $user["first_name"] . " " . $user["last_name"],
                                "email"=> $user["email"],
                            ],
                            "token" => $jwt
                        ]
                        );
                }
                else{
                    echo json_encode(
                        [
                            "status"=> false,
                            "message"=> "Wrong Email or Password."
                        ]
                        );
                }
            }
            else{
                echo json_encode(
                    [
                        "status"=> false,
                        "message"=> "Wrong Email or Password."
                    ]
                    );
            }
        }
        
    }


?>