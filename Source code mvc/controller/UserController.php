<?php

 
class UserController
{
 
    public function loginAction($params)
    {
		session_start();
		global $conn;
		
		
		if(isset($_SESSION['usr_id'])!="")
			header("Location: /user"); // đăng nhập rồi thì về trang chủ
		 
		if (isset($_POST['login']))
		{
			$mssv = mysqli_real_escape_string($conn, $_POST['mssv']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);
			
			$result = mysqli_query($conn, "SELECT * FROM user WHERE mssv = '" . $mssv. "'");
			 
			if ($row = mysqli_fetch_array($result))
			{ 
				if (Encrypt::getInstance()->decode($row['keypw'], $row['pass'])==$password)
				{
					$_SESSION['usr_id'] = $row['id'];
					$_SESSION['usr_mssv'] = $row['mssv'];
					$_SESSION['usr_email'] = $row['email'];
					header("Location: /");
				}
				else
				{
					$errormsg = "MSSV or Password không chính xác!!!";
				}
			}
			else
			{
				$errormsg = "MSSV or Password không chính xác!!!";
			}
		}
  
        include 'view/login/loginView.php'; 
    }
	
	
	public function registerAction($params)
    {
		session_start();
		global $conn;
		
		if(isset($_SESSION['usr_id']))
		{
			session_destroy();
			unset($_SESSION['usr_id']);
			unset($_SESSION['usr_mssv']);
		}
  
		$error = false;
 
		if (isset($_POST['signup']))
		{
			$mssv = mysqli_real_escape_string($conn, $_POST['mssv']);
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$password = mysqli_real_escape_string($conn, $_POST['password']); 
 			$idmsg = mysqli_real_escape_string($conn, $_POST['idmsg']);
			
			$user = new UserModel();
			$user->findUserByIdmsg($idmsg); // kiểm tra idmsg này đã dk chưa?
			
			if ($user->getId()!= 0)
			{
				$error = true;
				$errormsg = "FB của bạn đã đăng ký trước đó một tài khoản khác. Vui lòng remove sau đó đăng ký lại!";
				
			}
			
			$typenotice = mysqli_real_escape_string($conn, $_POST['typenotice']);

			if(!filter_var($email,FILTER_VALIDATE_EMAIL))
			{
				$error = true;
				$email_error = "Please Enter Valid Email ID";
			} 
			
			// mã hóa
			$keypw = base64_encode(mcrypt_create_iv(10, MCRYPT_DEV_URANDOM).'_Random_string_key.....');
			$password = Encrypt::getInstance()->encode($keypw, $password);
		 
			if (!$error)
			{
				$user = new UserModel(0, $mssv, $password, $keypw, md5(time()) . "_NULL_web", $email, 1, null, $idmsg, null, null, $typenotice);  
				if($user->InsertUser() ==  true) // insert vao db
				{
					$successmsg = "Đăng ký tài khoản thành công! Ứng dụng sẽ tự động phản hồi trong vòng 5-20p. Nếu sau thời gian này, không nhận được thông báo hãy kiểm tra lại mật khẩu hoặc liên hệ người quản trị.<br>Vui lòng <a href='/user/login'>Bấm vào đây để đăng nhập</a>";
					
					echo "<!--";
					$user = new UserModel();
					$user->findUserByMssv($mssv); // sau khi thêm xong thì tìm user này
					
					$processController = new ProcessController(""); 
					$processController->CheckScoreById($user->getId());
					
					echo "-->";
				}
				else
				{
					$errormsg = "Error in registering...Please try again later!";
				}
			}
		}

  
        include 'view/login/registerView.php'; 
    }
	
	
	public function logoutAction($params)
    {
		session_start();
		if(isset($_SESSION['usr_id']))
		{
			session_destroy();
			unset($_SESSION['usr_id']);
			unset($_SESSION['usr_mssv']);
		}
		header("Location: /user/login");
    }
	 
	
		
	public function index($params)
    {
		session_start(); 
		
		if(!isset($_SESSION['usr_id'])) // chưa đăng nhập
		{
			header("Location: /user/login");
		}
 
		global $conn;
	
		$trangthai = "";
		
		$user = new UserModel();
		$user->findUserById($_SESSION['usr_id']);
		
		 
		if (is_null($user->getCachetkb()) || $user->getCachetkb()=="") // nếu chưa có tkb
		{
			$processController = new ProcessController();
			$processController->ReloadSchedule($user);
		} 
		
		if (isset($_POST['edit']))
		{ 
 			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);
			$idmsg = mysqli_real_escape_string($conn, $_POST['idmsg']);
			
			$typenotice = mysqli_real_escape_string($conn, $_POST['typenotice']);
 
			
			$idmsg = mysqli_real_escape_string($conn, $_POST['idmsg']);
		
 
			if(isset($_POST['active']) && $_POST['active']=="1")
				$user->setActive(1);
			else
				$user->setActive(0);
			 
			if (isset($password) && !empty($password)) // user có nhập MK 
			{ 
				$keypw = base64_encode(mcrypt_create_iv(10, MCRYPT_DEV_URANDOM).'_Random_string_key.....'); 
				$user->setKeypw($keypw);
				$user->setPass(Encrypt::getInstance()->encode($keypw, $password)); // mã hóa mk rồi lưu
			} 
			 
			if (isset($email) && !empty($email)) 
			{
				$checkemail = $email;
				if (filter_var($checkemail,FILTER_VALIDATE_EMAIL)) // email hợp lệ
				{
					$user->setEmail($email);
				}
				else
					$email_error = "Email không hợp lệ!";
			}
			
			
			if (isset($idmsg) && !empty($idmsg))
				$user->setIdmsg($idmsg); 
			
			if (isset($typenotice) && !empty($typenotice))
				$user->setTypenotice($typenotice); 
		 
			if ($user->UpdateUser() == true)
			{
				$trangthai = 'Đã cập nhật thành công!';
			} 
			else
			{
				$trangthai = 'Cập nhật thất bại!';
			}

			 
		}
		
        include 'view/login/indexView.php'; 

	}
	 
	
}

