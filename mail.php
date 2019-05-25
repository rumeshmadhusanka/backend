<?php
$verificationCode= $_POST['code'];

$msg = "<html lang='en'>";
$msg = wordwrap($msg,70);
$msg.=wordwrap("<body>",70);
$msg.=wordwrap("<h2>"."Please Verify Your Account by Clicking the Link Below."."</h2>",70);
$msg.=wordwrap("<a href='//localhost/abc/common/verify.php?'>Click here to verify</a>",70);
$msg.=wordwrap("<p style='text-align: left; text-decoration-color: #1b1e21'>Thank you<br>ServiceMe Team.</p>",70);
$msg.=wordwrap("</body>",70);
$msg.=wordwrap("</html>",70);

$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
// send email
mail("rumesh.m.s16@gmail.com","ServiceMe account verification",$msg,$headers);

