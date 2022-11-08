<?php
    use PHPMailer\PHPMailer\PHPMailer;

    include 'C:\xampp\htdocs\farm\resource\PHPMailer\PHPMailer.php';
    include 'C:\xampp\htdocs\farm\resource\PHPMailer\SMTP.php';
    include 'C:\xampp\htdocs\farm\resource\PHPMailer\Exception.php';

    function sendOTP($sadminEMAIL, $sadminOTP){
        $from= 'Forfarmers!';
        $subject= 'OTP Varification.';
        $body= 'Super Admin Login OTP is: <br> <br> '.$sadminOTP.'<br> <br> Please Do Not Share This OTP With Any One.';

        $mail= new PHPMailer();

        $mail->isSMTP();
        $mail->Host= 'smtp.gmail.com';
        $mail->SMTPAuth= true;
        $mail->Username= 'soumalya.server@gmail.com';
        $mail->Password= 'amiSOUMALYA007';
        $mail->Port= 465;
        $mail->SMTPSecure= 'ssl';
        
        $mail->isHTML(isHtml: true);
        $mail->setFrom('soumalya.server@gmail.com', $from);
        $mail->addAddress(address: $sadminEMAIL);
        $mail->Subject= $subject;
        $mail->Body= $body;

        $result= $mail->send();
        
        if($result){
            return $result;
        }
    }
?>