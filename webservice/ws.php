<?php 
	include 'core.php';
	$core = new core();
	
	if(isset($_GET['action'])) {
		$action = $_GET['action'];
	} else {
		$action = '';
	}
	switch($action) {
		default:
			print('Incorrect use.');
			break;
			
		case "register":
			if(isset($_GET['username']) && isset($_GET['password']) && isset($_GET['confirmPassword']) && isset($_GET['email'])) {
				$result = $core->register($_GET['username'], $_GET['email'], $_GET['password'], $_GET['confirmPassword']);
				$result = json_decode($result);
				var_dump($result);
			} else {
				print('Invalid fields.');
			}
				break;
			
		case "login":
			if(isset($_GET['email']) && isset($_GET['password'])) {
				$result = $core->login($_GET['email'], $_GET['password']);
				$result = json_decode($result);
				var_dump($result);
			} else {
				print('Invalid fields.');
			}
			break;
		case "checkLogin":
			if($core->isLogged()) {
				print('logged');
			} else {
				print('not Logged');
			}
			break;
		case "search":
			if(isset($_GET['lat']) && isset($_GET['lang']) && is_numeric($_GET['lat']) && is_numeric($_GET['lang']) && isset($_GET['radius']) && is_numeric($_GET['radius'])) {
				if(isset($_GET['cat']) === false) {
					$_GET['cat'] = '';
				}
				print $core->search($_GET['lat'], $_GET['lang'], $_GET['radius'], $_GET['cat']);
			} else {
				print('Invalid Fields.');
			}
			break;
	}
?>