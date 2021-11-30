<?php
    use PHPMailer\PHPMailer\PHPMailer;

    // Add Path to autoload.php since you are using composer.
    require 'PHPMailer/vendor/autoload.php';    

    if (isset($_POST['name']) && isset($_POST['email'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $body = $_POST['message'];

        // require_once "PHPMailer/PHPMailer.php";
        // require_once "PHPMailer/SMTP.php";
        // require_once "PHPMailer/Exception.php";

        $mail = new PHPMailer();

        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = "mail.tactical-security.org";
        $mail->SMTPAuth = true;
        $mail->Username = "info@tactical-security.org"; //enter you email address
        $mail->Password = 'tacticalsecurity12345'; //enter you email password
        $mail->Port = 465;
        $mail->SMTPSecure = "ssl";

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom("info@tactical-security.org");
        $mail->addAddress("emungati@gmail.com"); //enter you email address
        // $mail->addAddress("emungati@gmail.com");
        $mail->Name = $_POST['name'];
        $mail->Email= $_POST['email'];
        $mail->Subject= $_POST['subject'];
        $mail->Body = "<i>Dear Tactical Security,<br> Follow up on:</i>". $_POST['name'].
        "<br>email:".$_POST['email'].
        "<br><b>Message</b>:".$_POST['message'];

        if ($mail->send()) {
            $status = "success";
            $response = "Email is sent!";
        } else {
            $status = "failed";
            $response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
        }

        $_SESSION["msg"]=array("status" => $status, "response" => $response);
        header('Location: http://tactical-security.org/contact');
    }
?>
