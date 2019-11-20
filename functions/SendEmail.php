<!DOCTYPE html>

    <!--
        This php file is to handle email requests for user subscription cancellation
        To safely represent the content of this file please contain it in a DIV

        Author: Blayde Dietsch, Mitchel King, Noah Jackson
        Date: 18/11/2019
    -->

    <?php
        //phpmailer class
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
        use PHPMailer\PHPMailer\SMTP;

        require 'assets/phpmailer/src/PHPMailer.php';
        require 'assets/phpmailer/src/Exception.php';
        require 'assets/phpmailer/src/SMTP.php';

        $email = $_POST["email"];

        try{
            //set smtp variables
            ini_set("SMTP","ssl://smtp.gmail.com");
            ini_set("smtp_port","465");
            //create new phpmailer object
            $mail = new PHPMailer(true);
            //enable authentication
            $mail->SMTPAuth = true;
            //setup gmail host
            $mail->Host = "smtp.gmail.com"; // SMTP server
            $mail->SMTPSecure = "ssl";
            $mail->Port = "465";
            //account being sent from
            $mail->Username = "acmetestsmtafe@gmail.com";
            $mail->Password = "southmetro";
            $mail->setFrom("acmetestsmtafe@gmail.com", "Accounts");
            //telling the class to use SMTP
            $mail->isSMTP();
            //the address recieving the email
            $mail->AddAddress("acmetestsmtafe@gmail.com");

            //getting user's name for message
            $sql = "SELECT * 
                    FROM email_tbl
                    WHERE email = '$email';";
            $result = mysqli_query($conn, $sql);
            if ($row = mysqli_fetch_assoc($result) > 0) {
                $name = $row['name'];
                //message sent in the email
                $message = "A user has requested to cancel their subscription. \nLogin into the admin page and enter the email " . $email . " to cancel their subscription";

                //actually send the email
                $mail->Subject = "Subscription Cancel Request";
                $mail->Body = $message;
                $mail->send();
            echo "<p>Email Sent to Admin</p>";
            }
            else {
                echo "<p class='note'>NO ACCOUNT WITH THAT EMAIL</p>";
                exit();
            }
        } catch (Exception $e) {
            echo $e;
    }
    ?>
</html>
