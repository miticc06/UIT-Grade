<?php  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
			
class ProcessController
{
	private $cookie = "cookie_get.txt"; 
	private $tokenfb;

	private $UsernameEmail;
	private $PasswordEmail;
	private $linkSite;

	
	
	public function __construct()
	{
		global $tokenfb, $linkSite, $UsernameEmailSMTP, $PasswordEmailSMTP;
		$this->tokenfb = $tokenfb;
		
		$this->UsernameEmail = $UsernameEmailSMTP;
		$this->PasswordEmail = $PasswordEmailSMTP;
		$this->linkSite = $linkSite;
	}
	
	public function sendMessengerCurl($message, $senderid)
	{ 
		$jsonData = "{
		\"recipient\":{
		\"id\":\"$senderid\"
		},
		\"message\":{
		\"text\":\"$message\"
		}
		}";

		$url = "https://graph.facebook.com/v2.6/me/messages?access_token=".$this->tokenfb; 
		
		$jsonDataEncoded = $jsonData; 
		$ch = curl_init($url); 
		curl_setopt($ch, CURLOPT_POST, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);
		curl_close($ch);
		
		return $result; 
	}
	
	public function sendMessenger($user, $msgsend)
	{
		if ($user->getIdmsg()=="") // chưa có idmsg
			return;  
			
		$result = $this->sendMessengerCurl($msgsend, $user->getIdmsg()); // nhận thông điệp khi gửi bằng curl 
		
		if (preg_match('/recipient_id/', $result)==true)
		{
 
		}
		else
		{
		} 
	}
	
	public function sendEmail($user, $title_mail, $content_mail)
	{
		if ($user->getEmail()=="") // chưa có email thì bỏ qua
			return;  
		
		$email_address = $user->getEmail();
		$username = $user->getMssv();
		
		$mail = new PHPMailer;
		$mail->CharSet = 'UTF-8';
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = $this->UsernameEmail;
		$mail->Password = $this->PasswordEmail;
		$mail->SMTPSecure = 'ssl';
		$mail->Port = 465; 
		$mail->addAddress($email_address);
		$mail->isHTML(true); 
		$mail->setFrom($email_address,$title_mail);
		$mail->Subject = $title_mail.' - Hệ thống thông báo tự động.';
		$mail->Body    = $content_mail;
		$mail->AltBody = 'Đây là email trả lời tự động, vui lòng không trả lời ở đây.';

		if(!$mail->send())
		{
			echo '<br>Lỗi : <b>'.$username.'</b> ' . $mail->ErrorInfo.'<br>';
		}
		else 
		{
			echo 'Sent mail! <b>'.$username.'</b> '.$email_address.'<br>';
		}
	}
		
	public function LoginWebUIT($user)
	{
		$username = $user->getMssv();
		$password = Encrypt::getInstance()->decode($user->getKeypw(),$user->getPass());
		$postdata = "name=".addslashes($username)."&pass=".addslashes($password).'&form_build_id=form-W11t3MIKTXdLaVPkKFP9VXXaHb7XpbbZyrrLHtz375k&form_id=user_login&op=Đăng%20nhập';
		
		$ch = curl_init(); 
		$url="https://daa.uit.edu.vn/user/login/";
		curl_setopt ($ch, CURLOPT_URL, $url); 
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6"); 
		curl_setopt ($ch, CURLOPT_TIMEOUT, 120); 
		curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 0); 
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt ($ch, CURLOPT_COOKIEJAR, $this->cookie); 
		curl_setopt ($ch, CURLOPT_REFERER, $url); 
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $postdata); 
		curl_setopt ($ch, CURLOPT_POST, 1); 
		$dataweb = curl_exec($ch);
		//echo $dataweb;
		if (preg_match("/(unrecognized username or password)|(failed login)/", $dataweb))
		{
			//echo "Sai mật khẩu";
			return false;
		}
		else
		{
			//echo "Login OK!"; 
			return $ch;
		} 
	}

	public function GetScheduleFromWebUIT($user)
    { 
		global $conn;	
		 
		$ch = $this->LoginWebUIT($user);
 
		if ($ch == false)
			return false;
		
		curl_setopt ($ch, CURLOPT_URL, "https://daa.uit.edu.vn/sinhvien/thoikhoabieu"); 
		curl_setopt($ch, CURLOPT_POST, false);
		$result = curl_exec($ch); 
		curl_close($ch);
		
		preg_match('#<div class=\"title_thongtindangky\">(.*?)<\/table>#s', $result, $res);
		
		return $res[0];
	}
	
	public function ReloadSchedule($user)
    { 
		$data = $this->GetScheduleFromWebUIT($user);
		if ($data == false) // đăng nhập thất bại
		{
			
		}
		else
		{
			$user->setCachetkb($this->GetScheduleFromWebUIT($user)); // lưu tkb
			$user->UpdateUser(); // cập nhật user
		}
		
	}
	
	public function GetScoreFromWebUIT($user)
    { 
		global $conn;	
		$ch = $this->LoginWebUIT($user); // đăng nhập
		if ($ch == false)
			return false;
		curl_setopt ($ch, CURLOPT_URL, "https://daa.uit.edu.vn/print/sinhvien/kqhoctap"); 
		curl_setopt($ch, CURLOPT_POST, false);
		$result = curl_exec($ch);
		curl_close($ch);
		preg_match('#<center><h1>(.*?)<\/strong><\/font>#s', $result, $res);
		$data = '<div class="print-content">'.$res[0].'</div>';
		return $data; 
	}
	
	function CheckScoreById($id) 
	{
		global $conn, $linkSite;  
		
		$user = new UserModel();
		$user->findUserById($id);

		if ($user->getActive() != 1)// nếu không đang active thì bỏ qua
			return;
			
		$username = $user->getMssv();
		$keypw = $user->getKeypw();
		$password = Encrypt::getInstance()->decode($keypw, $user->getPass());
		
		$oldcode = $user->getCode();
		 

		$data = $this->GetScoreFromWebUIT($user);
		if ($data == false) // nếu đăng nhập thất bại
		{
			echo "login fail!";
			$user->setActive(2); // active 2 : sai mật khẩu
			$user->UpdateUser(); // cập nhật lại trạng thái
			  
			$timenow = date('H : i d/m/Y');
			$msgsend = '*Chào bạn '.$username.'*. \n\nGrade UIT không thể đăng nhập vài tài khoản của bạn vào lúc : '.$timenow.' \nLý do: Có thể do sai mật khẩu. \n\nTạm thời apps sẽ dừng báo điểm tài khoản của bạn\n\nVì thế bạn vui lòng đăng nhập '.$linkSite.'user/login và điều chỉnh lại mật khẩu! \n\nNếu bạn cho rằng đây là lỗi, vui lòng liên hệ người quản trị.';
			if ($user->getTypenotice()=="msg" || $user->getTypenotice()=="emailmsg")
			{ 
				$this->sendMessenger($user, $msgsend);
			}
			
			if ($user->getTypenotice()=="email" ||$user->getTypenotice()=="emailmsg")
			{
				$title_mail = '['.$username.'] Grade UIT không thể đăng nhập - '.$timenow;
				 
				$this->sendEmail($user, $title_mail, $msgsend);
			}
			
			
			
		}
		
		if ($user->getActive() != 1)// nếu vẫn đang ko active thì bỏ qua
			return;
		
		$newcode = md5($data);
		 
		
		if ($oldcode!=$newcode && $newcode!='3e598d76745e5a0951c17eec14019ea1' && $newcode!='de3bcca3416ae0290e046d4057e0d033') 
		{
			echo "<br>#Update <b>".$username."</b><br>";
			
			$user->setCachediem($data);
			$user->setCode($newcode);
			 
			$user->UpdateUser();
			
			echo "<font color=\"green\">Record updated successfully</font><br>";
			 
			
			$timenow = date('H : i d/m/Y'); 
			
			if ($user->getTypenotice()=="msg" || $user->getTypenotice()=="emailmsg")
			{
				$msgsend = '*Chào bạn '.$username.'*. \n\nĐiểm thi của bạn đã được cập nhật vào lúc '.$timenow.' \n\nBạn có thể xem điểm của mình tại đây: \n '.$this->linkSite.'score/'. $newcode .'  \n\nThân mến!';
				$this->sendMessenger($user, $msgsend);
			}
			
			if ($user->getTypenotice()=="email" ||$user->getTypenotice()=="emailmsg")
			{
				$title_mail = '['.$username.'] Điểm thi được cập nhật - '.$timenow;
				$content_mail = 'Vui lòng xem điểm thi tại đây : <br><a href="'.$this->linkSite.'score/'. $newcode .'" target="_blank">'.$this->linkSite.'score/'. $newcode .'</a><br>'. $data .'<br>Code check '.$newcode.'';
				$this->sendEmail($user, $title_mail, $content_mail);
			}
		}
		else
		{
			echo 'Don\'t change: <b>'.$username.'</b>';
		}

	}
	
    public function processAction($params)
    { 
		global $conn;
 
		date_default_timezone_set('Asia/Krasnoyarsk');
	   
		$sql = "SELECT id FROM user";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{
				$this->CheckScoreById($row["id"]); // kiểm tra điểm user by id
			}
		} 
		else 
		{
			echo "Chưa có user!<br>";
		}
		
    } 
	
	
	
}

