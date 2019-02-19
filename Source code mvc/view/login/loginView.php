<?php
	include_once "header.php";
?>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well">
			<form role="form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="loginform">
				<fieldset>
					<legend>Login</legend>
					
					<div class="form-group">
						<label for="name">MSSV</label>
						<input type="text" name="mssv" placeholder="Nhập MSSV" required class="form-control" />
					</div>

					<div class="form-group">
						<label for="name">Password</label>
						<input type="password" name="password" placeholder="Your Password" required class="form-control" />
					</div>

					<div class="form-group">
						<input type="submit" name="login" value="Login" class="btn btn-primary" />
					</div>
				</fieldset>
			</form>
			<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">	
		New User? <a href="/user/register">Sign Up Here</a>
		</div>
	</div>
</div>

<?php
	include_once "footer.php";
?>