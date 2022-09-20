<?php
require_once("module/model/koneksi/koneksi.php");
require 'assets/phpmailer/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->isSendmail();
set_time_limit(120); // set the time limit to 120 seconds

$mail->setFrom('no-reply@megamarinepride.com','Testing Email');
$mail->addAddress("sysdev@baramudabahari.com");
$mail->Subject = "Test Email";
$mail->msgHTML("Test");

if($mail->send())
{
    echo "Message has been";
    ?><script>document.location.href='ptk';</script><?php
}
else
{
    echo "Mailer Error: " . $mail->ErrorInfo;
}
?>