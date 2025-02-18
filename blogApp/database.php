<?php
    $host = '127.0.0.1';
    $user = 'root';
    $password = 'password';
    $db = 'blog_db';

    $conn = mysqli_connect(
        $host,
        $user,
        $password,
        $db
    );

    if(!$conn){
        echo 'Failed to connect to database';
    }

?>