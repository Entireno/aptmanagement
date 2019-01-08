<?php

use PHPMailer\PHPMailer\PHPMailer;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail= new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth=true;

$mail->Host='smtp.yandex.com';
$mail->Port=587;
$mail->SMTPSecure='tls';


$mail->Username="redgroupapt@yandex.com.tr";
$mail->Password="asd123456";

$mail->SetFrom("redgroupapt@yandex.com.tr","Apt Yonetici");
$mail->CharSet='UTF-8';
$mail->isHTML(true);
?>