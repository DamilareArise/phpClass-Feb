<?php
    require 'database.php';

    $errors = [
        'first_name'=>'',
        'last_name'=>'',
        'email'=>'',
        'password'=>'',
        'confirm_password'=>''
    ];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
        
        if(empty($first_name)){
            $errors['first_name'] = 'Please enter your first name';
        }
        elseif(empty($last_name)){
            $errors['last_name'] = 'Please enter your last name';
        }
        elseif(empty($email)){
            $errors['email'] = 'Please enter your email';
        }
        elseif(empty($password)){
            $errors['password'] = 'Please enter your password';
        }
        elseif(empty($confirm_password)){
            $errors['confirm_password'] = 'Please confirm your password';
        }
        elseif($password !== $confirm_password){
            $errors['confirm_password'] = 'Passwords do not match';
        }
        else{

            $sql = "SELECT * FROM user_table WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                $errors['email'] = 'Email already exists';
            }else{
    
                $hash_password = password_hash($password, PASSWORD_DEFAULT);
                echo $hash_password;
                $sql = "INSERT INTO user_table(first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$hash_password')";
                
                $query = mysqli_query($conn, $sql);
                if($query){
                    header('Location: login.php');
                    exit;
                }
                else{
                    echo 'Error: ' . mysqli_error($conn);
                }

            }

        }


    }


?>

<?php require 'nav.php' ?>
    <section class="container col-md-4 p-3 my-5 shadow-sm bg-light rounded">
        <h3 class="text-center">Register</h3>
        <form action="" method="POST">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" class="form-control shadow-none">
                <small class="text-danger"><?php echo $errors['first_name'] ?></small>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control shadow-none">
                <small class="text-danger"><?php echo $errors['last_name'] ?></small>
            </div>
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
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control shadow-none">
                <small class="text-danger"><?php echo $errors['confirm_password'] ?>
            </small>
            <button type="submit" class="btn btn-primary my-2 w-100">Register</button>
            <div>
                <a href="/phpclass/blogApp/login.php" class="text-black text-decoration-none ">Already have account? login</a>
            </div>
        </form>
    </section>

<?php require 'footer.php' ?>