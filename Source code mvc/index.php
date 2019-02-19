<?php
 
require_once 'vendor/autoload.php'; 

include_once 'config.php';

include_once 'Utility/Encrypt.php';

// Define the routes table
$routes = array( 
//	'/home/' => array('HomeController', 'index') ,
	'/\/user\/login$/' => array('UserController', 'loginAction'),
	'/\/user\/register\/([0-9]{1,})(()|(\/)|(\?.*))$/' => array('UserController', 'registerAction'),
	
	'/\/user\/register/' => array('UserController', 'registerAction'),
	'/\/user\/logout$/' => array('UserController', 'logoutAction'),
	'/\/user((\/)|())$/' => array('UserController', 'index'),
	'/\/process$/' => array('ProcessController', 'processAction'),
	'/score\/([a-f0-9]{32})(()|(\/)|(.*))$/' => array('SeeController', 'SeeScoreAction'),
	'/schedule\/([a-f0-9]{32})(()|(\/)|(.*))$/' => array('SeeController', 'SeeScheduleAction'),

	'/\/(.*)$/' => array('HomeController', 'index') // các kí tự còn lại thì đẩy về trang chủ

	
);

// Decide which route to run
foreach ($routes as $url => $action)
{ 
    // See if the route matches the current request
    $matches = preg_match($url, $_SERVER['REQUEST_URI'], $params); 
 
    // If it matches...
    if ($matches > 0)
	{

        // Run this action, passing the parameters.
        $controller = new $action[0];
        $controller->{$action[1]}($params);

        break;
    }
}