<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/session.php');
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../lib/PHPMailer.php');
include_once($filepath . '/../lib/SMTP.php');
use PHPMailer\PHPMailer\PHPMailer;
?>

<?php
/**
 * 
 */
class user
{
	private $db;
	public function __construct()
	{
		$this->db = new Database();	}

	public function login($email, $password)
	{
		$query = "SELECT * FROM users WHERE email = '$email' ";
		$result = $this->db->select($query);
		if ($result) {
			$value = $result->fetch_assoc();
			Session::set('user', true);
			Session::set('userId', $value['id']);
			Session::set('role_id', $value['role_id']);
			if($value['role_id'] == 2 && password_verify($password,$value['password']) && $value['status'] == 1){
				header("Location:index.php");
			}
			
			if($value['role_id'] == 1 && password_verify($password,$value['password'])  && $value['status'] == 1){
				header("location:admin/index.php");
			}
			
			if($value['role_id'] == 3 && password_verify($password,$value['password']) && $value['status'] == 1){
				header("location:manager/index.php");
			}
			if(password_verify($password,$value['password'])==false){
				$alert = "Tên đăng nhập hoặc mật khẩu không đúng!";
				return $alert;
			}
		
		} else {
			$alert = "Tên đăng nhập hoặc mật khẩu không đúng!";
			return $alert;
		}
	}

	public function insert($data)
	{
		$fullName = $data['fullName'];
		$email = $data['email'];
		$dob = $data['dob'];
		$address = $data['address'];
		$password=password_hash($data['password'],PASSWORD_DEFAULT);


		$check_email = "SELECT * FROM users WHERE email='$email' LIMIT 1";
		$result = $this->db->select($check_email);
		if ($result) {
			return false;
		} 
		else {
			// Genarate captcha
			$captcha = rand(10000, 99999);

			$query = "INSERT INTO users VALUES (NULL,'$email','$fullName','$dob','$password',2,1,'$address',0,'" . $captcha . "') ";
			$result = $this->db->insert($query);
			if ($result) {
				// Send email
				$mail = new PHPMailer();
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
				$mail->Subject = "Xác nhận email tài khoản - Computers Store";
				$mail->Body = "<h3>Cảm ơn bạn đã đăng ký tài khoản tại website ComputerStore</h3></br>Đây là mã xác minh tài khoản của bạn: " . $captcha . "";

				$mail->Send();
				header("Location:/index.php");
				return true;
			}
		}
	}
	public function forgot_pass($data)
	{
		$email = $data['email'];
		$check_email = "SELECT * FROM users WHERE email='$email'";
		$result = $this->db->select($check_email);
		if ($result) {
			$captcha = rand(1000000, 9999999);
			$password=password_hash($captcha,PASSWORD_DEFAULT);
			$query = "UPDATE users SET password = '$password' WHERE email = '$email'";
			$result = $this->db->update($query);
			if ($result) {
				$mail = new PHPMailer();
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
				$mail->Subject = "Quên mật khẩu - Computers Store";
				$mail->Body = "Mật khẩu mới của bạn là: $captcha";
				$mail->Send();
				return true;
			}
			return true;
		} 
	}

	public function get()
	{
		$userId = Session::get('userId');
		$query = "SELECT * FROM users WHERE id = '$userId' LIMIT 1";
		$mysqli_result = $this->db->select($query);
		if ($mysqli_result) {
			$result = mysqli_fetch_all($this->db->select($query), MYSQLI_ASSOC)[0];
			return $result;
		}
		return false;
	}

	public function getLastUserId()
	{
		$query = "SELECT * FROM users ORDER BY id DESC LIMIT 1";
		$mysqli_result = $this->db->select($query);
		if ($mysqli_result) {
			$result = mysqli_fetch_all($this->db->select($query), MYSQLI_ASSOC)[0];
			return $result;
		}
		return false;
	}

	public function confirm($userId, $captcha)
	{
		$query = "SELECT * FROM users WHERE id = '$userId' AND captcha = '$captcha' LIMIT 1";
		$mysqli_result = $this->db->select($query);
		if ($mysqli_result) {
			// Update comfirmed
			$sql = "UPDATE users SET isConfirmed = 1 WHERE id = $userId";
			$update = $this->db->update($sql);
			if ($update) {
				return true;
			}
		}
		return 'Mã xác minh không đúng!';
	}
}
?>