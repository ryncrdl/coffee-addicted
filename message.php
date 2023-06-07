<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

session_start();
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connect = getConnection();

    // Retrieve the submitted student number from the session
    $studentNumber = $_SESSION['Student_Number'];

    // Retrieve additional user data from the database
    $usersQuery = "SELECT * FROM users WHERE Student_Number = '$studentNumber'";
    $usersResult = mysqli_query($connect, $usersQuery);

    if (mysqli_num_rows($usersResult) > 0) {
        // Get the form inputs
        $sender_email = $_POST['your_email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $mail = new PHPMailer(true);

        try {
            // SMTP configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ryancordial2k22@gmail.com';
            $mail->Password = 'poogbabjtswwvnmc';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            // Sender and recipient
            $mail->setFrom($sender_email);
            $mail->addAddress("ryancordial2k22@gmail.com");

            $mail->isHTML(true);

            // Email content
            $mail->Subject = $subject;
            $mail->Body = "<h1>Sender Email: <b>$sender_email</b></h1> <br><br><h2>Sender Messages:</h2> <br>-$message";

            // Send the email
            $mail->send();

            echo "<script>
                alert('Message has been successfully sent.');
                location.href = 'index.php';
            </script>";
        } catch (Exception $e) {
            echo "Failed to send email. Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "<script>
                window.alert('You need to login first.');
                location.href = 'login.php';
            </script>";
        // header("Location: loginFirst.php");
    }

    mysqli_close($connect);
}
?>
