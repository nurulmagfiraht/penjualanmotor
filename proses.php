<?php

include 'koneksi.php';


$nama_panggilan 		= $_POST['nama_panggilan'];
						$nama_lengkap 		= $_POST['nama_lengkap'];
                        $alamat 		= $_POST['alamat'];
						$email 		= $_POST['email'];
						$password 		= $_POST['password'];
$code = md5($email.date('Y-m-d H:i:s'));



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'ngetesajalah04@gmail.com';                     //SMTP username
    $mail->Password   = 'eggxepvufpozwjpu';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('ngetesajalah@gmail.com', 'Verifikasi');
    $mail->addAddress($email, $nama_panggilan);     //Add a recipient
      //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Verifikasi Akun';
    $mail->Body    = 'Hallo Gan '.$nama_panggilan.' Jika Kamu Baik Silahkan Verifikasi Email Kamu Ya Tamvan <br> ini Linknya ! 
    <a href="http://localhost/gula%20aren/verif.php?code='.$code.'">Klik Disini Cuy</a>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if($mail->send()){
        $con->query("INSERT INTO tb_user(nama_panggilan,nama_pengkap,alamat,email,password,verifikasi_code) VALUES (
            '".$nama_panggilan."',
                            '".$nama_lengkap."',
                            '".$alamat."',
                            '".$email."',
                            '".$password."',
                            '".$code."'
            ) ");

            echo "<script>alert('$username');window.location='login.php'</script>";
    }
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}