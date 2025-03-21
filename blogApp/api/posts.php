<?php
    session_start();
    // include "../getBlog.php";
    require "../database.php";
    header("Content-Type: application/json");
    require 'auth.php';    

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        // $id = $_GET['id'] ?? null;

        if (isset($_GET['id'])){
            $id = $_GET['id'];
            $sql = "SELECT * FROM blog WHERE id = $id" ;
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            echo json_encode($row);

        }else{

            $sql = "SELECT * FROM blog";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                $blogs = mysqli_fetch_all($result, MYSQLI_ASSOC);
                echo json_encode($blogs);
            }
            else{
                echo json_encode([
                    "message" => "No post found"
                ]);
            }
        }    
    }
    else if($_SERVER["REQUEST_METHOD"] == 'POST'){
        $payload = file_get_contents("php://input");
        $payload = json_decode($payload, true);

        if(isset($payload)){
            $title = $payload['title'] ?? null;
            $category = $payload['category'] ?? null;
            $content = $payload['content'] ?? null; 
            $created_by = $payload['created_by'] ?? null;

            if(empty($title)){
                echo json_encode([
                    'message'=> 'Title field is required'
                    ]);
                exit;
            }


            // echo $title .' '. $category .' '. $content;
            $sql = "INSERT INTO blog(title, category, content, created_by) VALUES('$title', '$category', '$content', '$created_by')";
            $result = mysqli_query($conn, $sql);
            if($result){
                echo json_encode(
                    [
                        "message" => "Posted successfully",
                        "status" => true,
                    ]
                );
            }
            else{
                echo json_encode([
                    "message"=> "Error occured while posting",
                    "status"=> false
                    ]);
            }
        }
        else{
            echo json_encode([
                "message"=> "No payload",
                "status"=> false
                ]);
        }
        
    }

    
    // print_r($blogs);
    // echo json_encode($blogs)
?>