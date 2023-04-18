<?php
include_once 'config.php';

//Phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/vendor/autoload.php';

// Output messages
$responses = [];
$email = $_POST["email"];

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

        if (isset($_POST['sub_button'])) {

            $sql = "INSERT INTO subscribers_details (email_address)
                VALUES ('$email')";

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }
        try {
            //Server Settings
            $phpmailer = new PHPMailer(true);
            $phpmailer->SMTPSecure = 'ssl';
            $phpmailer->isSMTP();
            $phpmailer->Host = 'smtp.titan.email';
            $phpmailer->SMTPAuth = true;
            $phpmailer->Port = 465;
            $phpmailer->Username = 'info@xauman.com';
            $phpmailer->Password = 'traderjosh@2023';
            $phpmailer->setFrom('info@xauman.com', 'Xauman Forex');
            $phpmailer->addReplyTo($email, 'Sender Details');
            $phpmailer->addAddress($email, 'Commodities Trader');
            $phpmailer->addBCC('muhindablasio@gmail.com', 'Administrator');

            //SMTP Debug Setting
            $phpmailer->SMTPDebug = 0;

            //Email Sender & Subject
            $phpmailer->Sender = 'info@xauman.com';
            $phpmailer->Subject = "Welcome to Xauman Forex!";

            //Read the contents of the html file
            $htmlcontent = file_get_contents('email/xauman_email.html');

            // Enable HTML if needed
            $phpmailer->isHTML(true);
            $phpmailer->Body = $htmlcontent;

            $phpmailer->send();

        } catch (Exception $exception) {
            $errorMessage = 'Oops, something went wrong. Mailer Error: ' . $exception->errorMessage();
        }

        try {
            //Server Settings
            $phpmailer = new PHPMailer(true);
            $phpmailer->SMTPSecure = 'ssl';
            $phpmailer->isSMTP();
            $phpmailer->Host = 'smtp.titan.email';
            $phpmailer->SMTPAuth = true;
            $phpmailer->Port = 465;
            $phpmailer->Username = 'info@xauman.com';
            $phpmailer->Password = 'traderjosh@2023';
            $phpmailer->setFrom('info@xauman.com', 'Xauman Forex');
            $phpmailer->addReplyTo('info@xauman.com', 'Sender Details');
            $phpmailer->addAddress('info@xauman.com', 'Administrator');
            $phpmailer->addBCC('muhindablasio@gmail.com', 'Administrator');

            //SMTP Debug Setting
            $phpmailer->SMTPDebug = 0;

            //Email Sender & Subject
            $phpmailer->Sender = 'info@xauman.com';
            $phpmailer->Subject = "Welcome to Xauman Forex!";
            $body = file_get_contents('email/admin_notification.html');

            // Enable HTML if needed
            $phpmailer->isHTML(true);
            $phpmailer->Body = $body;

            $phpmailer->send();

        } catch (Exception $exception) {
            $errorMessage = 'Oops, something went wrong. Mailer Error: ' . $exception->errorMessage();
        }
    }
}
?>