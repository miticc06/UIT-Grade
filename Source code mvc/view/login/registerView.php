<?php
	include_once "header.php";
?>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well">
			<form role="form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="signupform">
				<fieldset>
					<legend>Sign Up</legend>

					<div class="form-group">
						<label for="name">MSSV</label>
						<input type="text" name="mssv" placeholder="Nhập MSSV" required value="<?php if($error) echo $mssv; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($mssv_error)) echo $mssv_error; ?></span>
					</div>
					
					
					<div class="form-group">
						<label for="name">Password UIT</label>
						<input type="password" name="password" placeholder="Password" required class="form-control" />
						<span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
					</div>
					
					<div class="form-group">
						<label for="name">Email</label>
						<input type="text" name="email" placeholder="Email" required value="<?php if($error) echo $email; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
					</div>		
					
					<div class="form-group">
						<label for="name">ID msg facebook</label>
						
						<input type="text" name="idmsg" placeholder="Nhập id msg của bạn"  required class="form-control" <?php if (isset($params[1])) echo 'readonly="readonly" value="'.$params[1].'"';?>/>
						<?php if (!isset($params[1])) echo '<p>Lấy ID msg bằng cách gõ <b>ID</b> vào fanpage <b><a href="https://www.facebook.com/messages/t/2061206617503835" target="_blank">Grade UIT</a></b></p>'; ?>
						<span class="text-danger"><?php if (isset($idmsg_error)) echo $idmsg_error; ?></span>
					</div>
					
					<div class="form-group">
						<label for="name">Nhận thông báo</label>
						<br />
						<select name="typenotice" >
							<option value="msg" selected">Messenger Facebook</option>
							<option value="email">Email</option>
							<option value="emailmsg">Email + Messenger Facebook</option>
							<option value="disable">Disable</option>
						</select>
					</div>
					
<!--
					<div class="form-group">
						<label for="name">Confirm Password UIT</label>
						<input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control" />
						<span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
					</div>
-->
					<div class="form-group">
						<input type="submit" name="signup" value="Sign Up" class="btn btn-primary" />
					</div>
				</fieldset>
			</form>
			<span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
			<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">	
		Already Registered? <a href="/user/login">Login Here</a>
		</div>
	</div>
</div>


<?php
	include_once "footer.php";
?>