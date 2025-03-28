<?php require 'nav.php' ?>
<?php 
    require_once 'database.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require '../vendor/autoload.php';


    $mail = new PHPMailer(true);

    $message = '';
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

                $to = $email;
                $subject = 'Reset Password';
                $body = "follow this link to reset your password http://localhost/phpClass/blogApp/reset_password.php/?token=$token";


                // echo "http://localhost/phpClass/blogApp/reset_password.php/?token=$token";
                // mail($to, $subject, $message);
                // $message = 'Password reset link has been sent to your email';

                try {
                    // SMTP Configuration
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'arisedamilare5@gmail.com';
                    $mail->Password = 'devx jhlm hvpt bmiu'; // Use App Password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Port = 465;
                
                    // Sender and Recipient
                    $mail->setFrom('arisedamilare5@gmail.com', 'My Blog App');
                    $mail->addAddress($email);
                
                    // Email Content
                    $mail->isHTML(true);
                    $mail->Subject = $subject;
                    $mail->Body    = $body;
                
                    $mail->send();
                    $message = 'Password reset link has been sent to your email';
                } catch (Exception $e) {
                    echo "Error: {$mail->ErrorInfo}";
                }
            } 
        }
    }

?>

<section>
    <div class="container col-md-5 p-3 my-4 shadow-sm">
        <b class="text-success"><?php echo $message ?></b>
        <form action="" method="POST">
            <h4 class="text-center">Send Password reset link</h4>
            <input type="email" placeholder="Insert your email" name="email" class="form-control mb-2">
            <button class="btn btn-primary w-100">Send</button>
        </form>
    </div>
</section>


<?php require 'footer.php' ?>;