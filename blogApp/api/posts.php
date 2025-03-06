<?php
    // include "../getBlog.php";
    require "../database.php";

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

    
    // print_r($blogs);
    // echo json_encode($blogs)
?>