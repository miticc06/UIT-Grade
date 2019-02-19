<?php
require_once 'vendor/autoload.php'; 
require_once 'config.php'; 
require_once 'controller/UserController.php'; 

use Mpociot\BotMan\BotManFactory;
use Mpociot\BotMan\BotMan;

$config = [
    'hipchat_urls' => [
        'YOUR-INTEGRATION-URL-1',
        'YOUR-INTEGRATION-URL-2',
    ],
    'nexmo_key' => 'YOUR-NEXMO-APP-KEY',
    'nexmo_secret' => 'YOUR-NEXMO-APP-SECRET',
    'microsoft_bot_handle' => 'YOUR-MICROSOFT-BOT-HANDLE',
    'microsoft_app_id' => 'YOUR-MICROSOFT-APP-ID',
    'microsoft_app_key' => 'YOUR-MICROSOFT-APP-KEY',
    'slack_token' => 'YOUR-SLACK-TOKEN-HERE',
    'telegram_token' => 'YOUR-TELEGRAM-TOKEN-HERE',
    'facebook_token' => $tokenfb,
    'facebook_app_secret' => $appsecretfb,
    'wechat_app_id' => 'YOUR-WECHAT-APP-ID',
    'wechat_app_key' => 'YOUR-WECHAT-APP-KEY',
];

// create an instance
$botman = BotManFactory::create($config);
$botman->verifyServices($verifyServicesFB);



// give the bot something to listen for.
$botman->hears('id', function (BotMan $bot) {
    $bot->reply('ID messenger cua ban la:  '.$bot->getUser()->getId());
	exit;

});
 

$botman->hears('help', function (BotMan $bot) 
{
    $bot->reply("*Hãy sử dụng các cú pháp sau:*
- Thêm tài khoản: dangky
- Xóa tài khoản: remove
- Xem nhanh TKB: tkb
- Xem điểm: diem");
	exit;
});


$botman->hears('dangky', function (BotMan $bot) 
{
	global $linkSite; 
	$user = new UserModel();
	if ($user->findUserByIdmsg($bot->getUser()->getId())==null)
	{
		$bot->reply('Bấm vào đường dẫn sau để đăng ký tài khoản:  '.$linkSite.'user/register/'.$bot->getUser()->getId());
	} 
	else
	{
		$bot->reply('Bạn đã đăng ký trước đó với tài khoản: '.$user->getMssv().'. Để thay đổi vui lòng sử dụng lệnh remove để xóa tài khoản cũ.');
	} 
	exit;
});

  
$botman->hears('tkb', function (BotMan $bot) 
{ 
	global $linkSite; 
 	$user = new UserModel();
	if ($user->findUserByIdmsg($bot->getUser()->getId())==null)
	{
		$bot->reply('Bạn chưa có tài khoản tại Grade UIT. Vui lòng đăng ký trước khi sử dụng.');
	} 
	else
	{
		$bot->reply("*Thời khóa biểu*
".$linkSite."schedule/".$user->getCode());
	}
 
	exit;
});

$botman->hears('diem', function (BotMan $bot) 
{  
	global $linkSite;
 	$user = new UserModel();
	if ($user->findUserByIdmsg($bot->getUser()->getId())==null)
	{
		$bot->reply('Bạn chưa có tài khoản tại Grade UIT. Vui lòng đăng ký trước khi sử dụng.');
	} 
	else
	{
		$bot->reply("*Điểm học tập*
".$linkSite."score/".$user->getCode());
	}
	exit;
}); 

$botman->hears('remove', function (BotMan $bot) 
{  
	$user = new UserModel();
	if ($user->findUserByIdmsg($bot->getUser()->getId()) == null )
	{
		$bot->reply('Bạn chưa có tài khoản tại Grade UIT. Vui lòng kiểm tra lại!');
	} 
	else
	{
		 if ($user->RemoveUser() == true)
		 {
			$bot->reply('Đã xóa thành công tài khoản '.$user->getMssv().'!');
		 }
		 else
		 {
			$bot->reply('Xảy ra lỗi trong quá trình xóa '.$user->getMssv().'. Vui lòng liên hệ người quản trị!');
		 }
	}  
	exit;
});


 


$botman->hears('{er}', function (BotMan $bot) {
    $bot->reply("Sai cú pháp! vui lòng gõ \"help\" để được giúp đỡ!");
});



// start listening
$botman->listen();