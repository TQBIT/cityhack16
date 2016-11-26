<?php 
	session_start();
	class core {
		public function __construct() {
			$this->pdo = new  PDO('mysql:dbname=serendipity;host=127.0.0.1', 'root', '');
			$this->errors = array();
		}
		
		public function validate($string, $type = NULL) {
			if($type === NULL) {
				$string = htmlentities($string);
			} elseif($type == 'email') {
				if(filter_var($string, FILTER_VALIDATE_EMAIL) === false) {
					$this->errors[] = "You must enter a valid email address.";
					return false;
				}
			}
			return $string;
		}
		
		public function isLogged() {
			if(isset($_SESSION['UID'])) {
				return true;
			} else {
				return false;
			}
		}
		
		public function register($username, $email, $password, $confirmPassword) {
			if(preg_match('/^[a-zA-Z0-9]+$/', $username) === false) { //regexp pattern not currently working
				$this->errors[] = "Username must be only letters and numbers";
			}
			if($this->validate($email, 'email') === false) {
				$this->errors[] = "You must enter a valid email address";
			}
			if(preg_match('/^[a-zA-Z]\w{3,14}$/', $password) === false) { //regexp pattern not currently working
				$this->errors[] = "Your password must only contain letters, numbers and underscores and be between 4 and 15 charecters.";
			}
			if($password != $confirmPassword) {
				$this->errors[] = "The two passwords you have enetered do not match.";
			}
			if(empty($this->errors)) {
				$stmt = $this->pdo->prepare("SELECT * FROM `user` WHERE `email` = ? LIMIT 0,1");
				$stmt->execute(array($email));
				$result = $stmt->fetch();
				if(empty($result) === false) {
					$this->errors[] = "That email already exists in our database.";
				}
			}
			$password = password_hash($password, PASSWORD_DEFAULT);
			if(empty($this->errors)) {
				$stmt = $this->pdo->prepare("INSERT INTO `user` (`userName`, `password`, `email`) VALUES (?, ?, ?)");
				$stmt->execute(array($username, $password, $email));
				return json_encode(array(1, 'success'));
			}
			return json_encode(array(0, 'fail', $this->errors));
			
		}
		
		public function login($email, $password) {
			if(empty($email) === false && empty($password) === false) {
				if($this->validate($email, 'email')) {
					$stmt = $this->pdo->prepare("SELECT * FROM `user` WHERE `email` = ?");
					$stmt->execute(array($email));
					$check = $stmt->fetch();
					if(!empty($check)) {
						if(password_verify($password, $check['password'])) {
							$_SESSION['UID'] = $check['UID'];
							$_SESSION['username'] = $check['UserName'];
							return json_encode(array(1, 'success'));
						} else {
							$this->errors[] =  "Invalid password.";
							return json_encode(array(0, 'error', $password, $this->errors));
						}
					} else {
						$this->errors[] = 'Invalid username.';
						return json_encode(array(0, 'error', $this->errors));
					}
				} else {
					return json_encode(array(0, 'error', $this->errors));
				}
			} else {
				return json_encode(array(0, 'error'));
			}
		}
	}
?>