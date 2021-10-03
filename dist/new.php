<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "../vendor/autoload.php";

$mail = new PHPMailer(true);

//Enable SMTP debugging.
$mail->SMTPDebug = 3;                               
//Set PHPMailer to use SMTP.
$mail->isSMTP();            
//Set SMTP host name                          
$mail->Host = "smtp.elasticemail.com";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;                          
//Provide username and password     
$mail->Username = "kawan.192707@spu.edu.iq";                 
$mail->Password = "977CA2EE050FD78719140DC4009F1182A30D";                           
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "tls";                           
//Set TCP port to connect to
$mail->Port = 2525;                                   

$mail->From = "kawan.192707@spu.edu.iq";
$mail->FromName = "School Managment System";

$mail->addAddress("pshtiwankawan@gmail.com", "Recepient Name");

$mail->isHTML(true);

$mail->Subject = "hi from here :D ";
$mail->Body = "<i>i thing your Email in here :D</i>";
$mail->AltBody = "This is the plain text version of the email content";

try {
    $mail->send();
    echo "Message has been sent successfully";
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
?>