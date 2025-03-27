
<?php require 'nav.php' ?>
<?php
    require 'database.php';


    $errors = [
        'email'=>'',
        'password'=>'',
        'errMsg' => ''
    ];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        if(empty($email)){
            $errors['email'] = 'Email is required';
        }
        elseif(empty($password)){
            $errors['password'] = 'Password is required';
        }else{
            $sql = "SELECT * FROM user_table WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) === 1){
                $user = mysqli_fetch_assoc($result);
                if(password_verify($password, $user['password'])){

                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['is_admin'] = $user['is_admin'];
                    setcookie('first_name', $user['first_name'], time() + (86400 * 30), "/");
                    header('Location: index.php');
                    exit;
                }
                else{
                    $errors['errMsg'] = 'Invalid email or password';
                }

            }else{
                $errors['errMsg'] = 'Invalid email or password';
            }
        }
    }

?>

    


    <section class="container col-md-4 p-3 my-5 shadow-sm bg-light rounded">
        <h3 class="text-center">Login</h3>
        <small class="text-danger"><?php echo $errors['errMsg'] ?></small>
        <form action="" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control shadow-none">
                <small class="text-danger"><?php echo $errors['email'] ?></small>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control shadow-none">
                <small class="text-danger"><?php echo $errors['password'] ?></small>
            </div>
            <button type="submit" class="btn btn-primary my-2 w-100">Login</button>
            <div class="d-flex justify-content-between">
                <a href="/phpclass/blogApp/register.php" class="text-black text-decoration-none ">Don't have an account? Register</a>

                <a href="\phpClass\blogApp\forget_password.php" class="text-black text-decoration-none">Forgot password?</a>
            </div>
        </form>
    </section>

<?php require 'footer.php' ?>