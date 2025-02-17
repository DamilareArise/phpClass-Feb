<?php
    $host = 'localhost';
    $user = 'php_class';
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