<?php
include 'config.php';

//Phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/vendor/autoload.php';

// Output messages
$responses = [];

$email = $_POST["email"];

$emailSent = ''; //Email sent declaration

$htmlcontent = file_get_contents('/email/xauman_email_2.html');

// Check if the form was submitted
if (isset($email)) {
    // Validate email adress
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $responses[] = 'Email is not valid!';
    }

    // Make sure the form fields are not empty
    if (empty($email)) {
        $responses[] = 'Please complete all fields!';
    }
    // If there are no errors
    if (!$responses) {

        //SMTP Configuration settings
        $phpmailer = new PHPMailer(true);
        $phpmailer->SMTPSecure = 'ssl';
        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.titan.email';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 465;
        $phpmailer->Username = 'info@xauman.com';
        $phpmailer->Password = 'traderjosh@2023';
        $phpmailer->setFrom('info@xauman.com', 'Xauman Forex Website');
        $phpmailer->addReplyTo($email, 'Sender Details');
        $phpmailer->addAddress('info@xauman.com', 'Xauman GMAIL');
        $phpmailer->addBCC('muhindablasio@gmail.com', 'Xauman Titan');
        $phpmailer->Subject = "Website Message";
        $phpmailer->Sender = 'info@xauman.com';
        $exception = new Exception();

        //SMTP Debug setting
        $phpmailer->SMTPDebug = 2;

        // Enable HTML if needed
        $phpmailer->isHTML(true);
        $bodyParagraphs = ["Email: {$email}"];
        $body = join('<br />', $bodyParagraphs);
        $phpmailer->Body = $body;

        if ($phpmailer->send() == true) {
            // Success
            $responses[] = 'Message Sent!';
            $emailSent = 'success';
            echo ($emailSent);
        } else {
            // Error
            $errorMessage = 'Oops, something went wrong. Mailer Error: ' . $phpmailer->ErrorInfo;
            $emailSent = 'error';
            echo ($emailSent);
        }
    }
}

?>