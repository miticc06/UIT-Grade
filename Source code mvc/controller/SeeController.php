<?php 
class SeeController
{
    public function SeeScoreAction($params)
    {
		$user = new UserModel(); 
		if ($user->findUserByCode($params[1]) == null)
		{
			echo "Đường dẫn đã hết hạn!";
		}
		else 
			include 'view/see/seescoreView.php'; 
			
	}
	
	
	public function SeeScheduleAction($params)
    {
		$user = new UserModel();
		if ($user->findUserByCode($params[1]) == null)
		{
			echo "Đường dẫn đã hết hạn!";
		}
		else
		{
			$processController = new ProcessController();
			
			if (is_null($user->getCachetkb()) || $user->getCachetkb()=="") // nếu chưa có tkb
				$processController->ReloadSchedule($user);
				
			include 'view/see/seescheduleView.php';
		} 
	}
}