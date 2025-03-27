<?php require 'nav.php' ?>
<?php 
    require_once 'database.php';

    $email = '';
    if(isset($_GET['token'])){
        $token = $_GET['token'];
        $stmt = $conn->prepare('SELECT * FROM reset_password WHERE token = ?');
        $stmt->bind_param('s', $token);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $stmt->close();

        if(isset($row['email'])){
            $email = $row['email'];
        }
        else{
            header('Location: /phpclass/blogApp/login.php');
            exit();
        }
    }else{
        header('Location: /phpclass/blogApp/login.php');
        exit();
    }

    if($_SERVER['REQUEST_METHOD']==="POST"){
        $password = $_POST["password"];

        $hash_password = password_hash($password, PASSWORD_DEFAULT);

        if(isset($email)){
            $stmt = $conn->prepare('UPDATE user_table SET password = ? WHERE email = ?');
            $stmt->bind_param('ss', $hash_password, $email);
            $stmt->execute();
            $stmt->close();
            
            header('Location: /phpclass/blogApp/login.php');
            exit();
        }
    }

?>

<section>
    <div class="container col-md-5 p-3 my-4 shadow-sm">
        <form action="" method="POST">
            <h4 class="text-center">Reset Password</h4>
            <input type="password" placeholder="Password" name="password" class="form-control mb-2">
            <input type="password" placeholder="Confirm Password" name="confirm_password" class="form-control mb-2">
            <button class="btn btn-primary w-100">Reset</button>
        </form>
    </div>
</section>


<?php require 'footer.php' ?>;