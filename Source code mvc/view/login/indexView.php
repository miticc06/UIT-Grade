<?php
	include_once "header.php";
?>

 
<?php if (isset($_SESSION['usr_id'])) { ?>

  

 <style>
 .form-control{ width: 900px;}
 </style>
 

 
 <div class="container">
 
 

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item active">
    <a class="nav-link active" data-toggle="tab" href="#info" role="tab" aria-controls="info">Đổi thông tin</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#tkb" role="tab" aria-controls="tkb">Thời khóa biểu</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#diem" role="tab" aria-controls="diem">Điểm</a>
  </li>
   
</ul>

<div class="tab-content"><br />
  <div class="tab-pane active" id="info" role="tabpanel">
  
  
  
  
  
  
  
  
  
  <form role="form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="editform">
				<fieldset>
				
				
				
				
				
				  <p>Kích hoạt tài khoản <input type="checkbox" name="active" value="1" <?php 
				  if ($user->getActive()==1) 
					  echo ' CHECKED ';
				  ?>> <?php if ($user->getActive()==2) echo "<font color='red'><b>(Tài khoản của bạn dừng kích hoạt do sai mật khẩu. Hãy cập nhật mật khẩu và kích hoạt lại tài khoản)</b></font>"; ?> <br /> </p>

				  
				  
					

					<div class="form-group">
						<label for="name">MSSV</label>
						<input type="text" name="mssv" class="form-control" value="<?php echo $user->getMssv(); ?>" readonly="readonly"/>
					</div>
					
					<div class="form-group">
						<label for="name">Email</label>
						<input type="text" name="email" placeholder="Email" class="form-control" value="<?php echo $user->getEmail(); ?>"/>
						<span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
					</div>

					<div class="form-group">
						<label for="name">Password UIT</label>
						<input type="password" name="password" placeholder="Password" class="form-control" />
						<span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
					</div>
					
					<div class="form-group">
						<label for="name">ID msg facebook</label>
						
						<input type="text" name="idmsg" placeholder="Nhập id msg của bạn" class="form-control" <?php 
						$idmsg = $user->getIdmsg();
						
						if (isset($idmsg)) echo 'value="'.$user->getIdmsg().'"'; ?>/>
						<p>Lấy IDmsg: gửi <b>ID</b> vào FB <b>Grade UIT</b></p>
						<span class="text-danger"><?php if (isset($idmsg_error)) echo $idmsg_error; ?></span>
					</div>
					
					
					<div class="form-group">
						<label for="name">Nhận thông báo</label>
						
						<select name="typenotice" >
							<option value="disable" <?php if($user->getTypenotice()=="disable") echo "selected"; ?>>Disable</option>
							<option value="email" <?php if($user->getTypenotice()=="email") echo "selected"; ?> >Email</option>
							<option value="msg" <?php if($user->getTypenotice()=="msg") echo "selected"; ?> >Messenger Facebook</option>
							<option value="emailmsg" <?php if($user->getTypenotice()=="emailmsg") echo "selected"; ?> >Email + Messenger Facebook</option>
						</select>
					</div>
					
					<?php
						if (!empty($trangthai))
							echo "<font color=blue>".$trangthai."</font><br /><br />";
					
					?>
					
					<div class="form-group">
						<input type="submit" name="edit" value="Cập nhật" class="btn btn-primary" />
					</div>
				</fieldset>
			</form>
   
  </div>
  
  
  
  	
  
  
  
  
  <div class="tab-pane" id="tkb" role="tabpanel">
  
	<div class="content" id="uit-tracuu-tkb-data"> 
	  
	  
	  <?php echo $user->getCachetkb(); ?>
<br /><br />
	  
 </div>
  </div>
  
  <div class="tab-pane" id="diem" role="tabpanel">
  
  
  
   <?php echo 'Last Update: <b>'.$user->getLastupdate().'</b><br>'.$user->getCachediem(); ?>
  
  
  <br /><br />
  
  </div> 

  </div>
 </div>
  </div>

 
 
 
 
 
 
<script>
  $(function () {
    $('#myTab a:last').tab('show')
  })
</script>

<?php } else { ?>




<?php } ?>




 
<?php
	include_once "footer.php";
?>