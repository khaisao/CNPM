<?php
include_once 'lib/PHPMailer.php';
include_once 'lib/SMTP.php';
$conn= mysqli_connect("localhost","root","","computerstore");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST["email"])){  
    
        $email=$_POST["email"];
        $sql = "SELECT * from users WHERE email='$email'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0){
            $captcha = rand(10000, 99999);
            $password = md5($captcha);
            $sql="UPDATE users SET password ='$password' ";
            mysqli_query($conn,$sql); 
		        $mail = new PHPMailer(true);  
				$mail->IsSMTP();
				$mail->Mailer = "smtp";

				$mail->SMTPDebug  = 0;
				$mail->SMTPAuth   = TRUE;
				$mail->SMTPSecure = "tls";
				$mail->Port       = 587;
				$mail->Host       = "smtp.gmail.com";
				$mail->Username   = "khailovesao@gmail.com";
				$mail->Password   = "pwplbbfimiyvmfzs";

				$mail->IsHTML(true);
				$mail->CharSet = 'UTF-8';
				$mail->AddAddress($email, "recipient-name");
				$mail->SetFrom("khailovesao@gmail.com", "Computer Store");
				$mail->Subject = "Quên mật khẩi";
				$mail->Body = "<h3>Mật khẩu mới của bạn là: $captcha</h3>";

				$mail->Send();
            echo 'Message has been sent';
            echo $captcha ;
            echo md5($captcha);
			header("location:login.php");
        
    }
        
}
else{
    echo "Khong co emai";
}
?>