<?php
	include_once "header.php";
?>


<p> Chào bạn, Sinh viên <b><?php echo $user->getMssv(); ?> </b></p><p> Địa chỉ nhận mail: <b> <?php echo $user->getEmail(); ?> </b></p>			
	
<div class="container"><div id="main-content" class="row main-content"><div id="content" class="mc-content span12"><div id="content-wrapper" class="content-wrapper"><div id="content-body" class="row-fluid content-body"><div class="region region-content clearfix"><div id="block-system-main" class="clearfix block block-system"><div class="content" id="uit-tracuu-tkb-data"><div> 
	

Last Update: <b><?php echo $user->getLastupdate(); ?></b><br>

<?php echo $user->getCachediem(); ?>

					
</div></div></div></div></div></div></div></div></div><br><br><br>