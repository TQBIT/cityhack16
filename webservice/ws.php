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
				print $result;
			} else {
				print('Invalid fields.');
			}
				break;
			
		case "login":
			if(isset($_GET['email']) && isset($_GET['password'])) {
				$result = $core->login($_GET['email'], $_GET['password']);
				print $result;
			} else {
				print('Invalid fields.');
			}
			break;
			
		case "acceptRequest":
			if(isset($_GET['rid'])) {
				print $core->acceptRequesr($_GET['rid']);
			}
			break;
		
		case "getRating":
			if(isset($_GET['uid'])) {
				print $core->getRating($_GET['uid']);
			}
			break;
			
		case "rateUser":
			if(isset($_GET['uid']) && isset($_GET['oid']) && isset($_GET['rating'])) {
				print $core->setRating($_GET['uid'], $_GET['oid'], $_GET['rating']);
			}
			break;
		
		case "rejectRequest":
			if(isset($_GET['rid'])) {
				print $core->rejectRequest($_GET['rid']);
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
		case "createOffer":
			if(isset($_GET['name']) && isset($_GET['desc']) && isset($_GET['lat']) && isset($_GET['long']) && isset($_GET['startDate']) && isset($_GET['endDate']) && isset($_GET['limit']) && isset($_GET['catID']) && isset($_GET['address']) && isset($_GET['url'])) {
				array_map('urlencode', $_GET);
				print $core->createOffer($_GET['name'], $_GET['desc'], $_GET['lat'], $_GET['long'], $_GET['startDate'], $_GET['endDate'], $_GET['limit'], $_GET['catID'], $_GET['address'], $_GET['url']);
			} else {
				print('invalid fields');
			}
			break;
		case "offerDetails":
			if(isset($_GET['oid'])) {
				print $core->offerDetails($_GET['oid']);
			}
			break;
			
		case "listCategories":
			print $core->listCategories();
			break;
		case "requestOffer":
			if(isset($_GET['oid'])) {
				print $core->requestOffer($oid);
			}
			break;
		
		case "logout":
			print $core->logout();
			break;
	}
?>