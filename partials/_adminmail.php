<?php
    use PHPMailer\PHPMailer\PHPMailer;

    include 'C:\xampp\htdocs\farm\resource\PHPMailer\PHPMailer.php';
    include 'C:\xampp\htdocs\farm\resource\PHPMailer\SMTP.php';
    include 'C:\xampp\htdocs\farm\resource\PHPMailer\Exception.php';

    function sendOTP($adminEMAIL, $adminID, $adminPASSWORD){
        $from= 'Forfarmers!';
        $subject= 'Login Credential.';
        $body= 'Admin ID: '.$adminID.'<br> Password: '.$adminPASSWORD;

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
        $mail->addAddress(address: $adminEMAIL);
        $mail->Subject= $subject;
        $mail->Body= $body;

        $result= $mail->send();
        
        if($result){
            return $result;
        }
    }
?>