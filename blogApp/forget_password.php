<?php require 'nav.php' ?>
<?php 
    require_once 'database.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = $_POST['email'];
        if(isset($email)){
            $stmt = $conn->prepare('SELECT * FROM user_table WHERE email = ? ');
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $user = $stmt->fetch();  #returns true
            // $result = $stmt->get_result();
            // $user = $result ->fetch_assoc();
            $stmt->close();
            if($user){
                $token = bin2hex(random_bytes(50));
                // echo $token;
                $stmt = $conn->prepare('INSERT INTO reset_password (email, token) VALUES (?, ?)');
                $stmt->bind_param('ss', $email, $token);
                $stmt->execute();
                $stmt->close();

                echo "http://localhost/phpClass/blogApp/reset_password.php/?token=$token";
            }
            
            
        }
    }

?>

<section>
    <div class="container col-md-5 p-3 my-4 shadow-sm">
        <form action="" method="POST">
            <h4 class="text-center">Send Password reset link</h4>
            <input type="email" placeholder="Insert your email" name="email" class="form-control mb-2">
            <button class="btn btn-primary w-100">Send</button>
        </form>
    </div>
</section>


<?php require 'footer.php' ?>;