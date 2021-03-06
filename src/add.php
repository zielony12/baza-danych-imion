<?php
	header('Content-Type: text/html; charset=UTF-8');
	session_start();

	// typ dodawania
	if(isset($_POST['type'])) {
		$type = $_POST['type'];
	} else {
		header('Location: index.php');
		exit();
	}

	// imie
	if(isset($_POST['e_name'])) {
		$name = filter_var(mb_strtolower($_POST['e_name']), FILTER_SANITIZE_STRING);
	}

	// nazwisko
	if(isset($_POST['e_surname'])) {
		$surname = filter_var(mb_strtolower($_POST['e_surname']), FILTER_SANITIZE_STRING);
	}

	// login
	if(isset($_POST['e_login'])) {
		$login = strtolower($_POST['e_login']);
	} elseif(isset($_SESSION['login'])) {
		$login = strtolower($_SESSION['login']);
	}

	// email
	if(isset($_POST['e_email'])) {
		$email = mb_strtolower($_POST['e_email']);
	}

	// hasło
	if(isset($_POST['e_password'])) {
		$password = mb_strtolower($_POST['e_password']);
	}

	// hasło 2
	if(isset($_POST['e_password2'])) {
		$password2 = mb_strtolower($_POST['e_password2']);
	}

	// kod
	if(isset($_POST['e_code'])) {
		$code = $_POST['e_code'];
	}

	// czy zaakceptowano regulamin?
	if(isset($_POST['accept'])) {
		$accept = $_POST['accept'];
	}

	// powód
	if(isset($_POST['reason'])) {
		$reason = $_POST['reason'];
	}
	if(isset($reason)) {
		if($reason == "reason1") {
			$reason = "To moje imie";
		} elseif($reason == "reason2") {
			$reason = "Imie zawiera wulgaryzmy";
		} elseif($reason == "reason3") {
			$reason = "Imie w inny sposób niszczy zasady regulaminu";
		}
	}

	// czy jest wszystko w porządku?
	$isOk = true;

	if(!isset($accept)) {
		$error = "Musisz zaakceptować warunki zawarte w <a href='regulamin.php'>regulaminie</a>.";
	}
	if($_SESSION['code'] != $code) {
		$error = "Kod z obrazka nie pasuje do kodu w polu tekstowym.";
	}

	require_once "connect.php";

	$db_connection = new mysqli($db_host, $db_user, $db_password, $db_name);
	$db_connection -> query("SET NAMES 'utf8'");
	mysqli_set_charset($db_connection, "utf-8");

	if(($type == "add") || ($type == "report")) {
		$query_result = mysqli_query($db_connection, "SELECT * FROM `names` WHERE `name` = '$name' AND `surname` = '$surname'");
		$result = $query_result -> num_rows;
		if((isset($login)) && (!empty($login))) {
			$name_author_id = mysqli_fetch_assoc($db_connection -> query("SELECT `id` FROM `users` WHERE `login` = '$login'"))['id'];
		} else {
			$error = "Wystąpił problem z pobraniem wymaganych danych. Przepraszamy.";
		}
	} elseif($type == "register") {
		$query_result = $db_connection -> query("SELECT * FROM `users` WHERE `login` = '$login' OR `email` = '$email'");
		$result = $query_result -> num_rows;
	}

	if($type == "add") {
		if((!isset($name_author_id)) || (empty($name_author_id))) {
			$error = "Wystąpił problem z pobraniem wymaganych danych. Przepraszamy.";
		}
		if((strlen($name) < 3) || (strlen($surname) < 3) || (strlen($name) > 12) || (strlen($surname) > 12)) {
			$error = "Twoje imię i nazwisko nie może być mniejsze od 3 znaków oraz większe od 12.";
		}
		if($result > 0) {
			$error = "W bazie danych istnieje już takie imie.";
		}
	} elseif($type == "report") {
		if((!$report_author_id = mysqli_fetch_assoc($db_connection -> query("SELECT `id` FROM `users` WHERE `login` = '$login'"))['id']) ||
		(!$name_id = mysqli_fetch_assoc($db_connection -> query("SELECT `id` FROM `names` WHERE `name` = '$name' AND `surname` = '$surname'"))['id'])) {
			$error = "Wystąpił problem z pobraniem wymaganych danych. Przepraszamy.";
		}
		if((!isset($name)) || (empty($name)) || (!isset($name)) || (empty($surname))) {
			$error = "Musisz podać imie oraz nazwisko, które chcesz zgłosić.";
		}
		if($result == 0) {
			$error = "Podane imie nie jest w bazie danych.";
		} else {
			$row = mysqli_fetch_assoc($query_result);
			$id = $row['id'];
		}
	} elseif($type == "register") {
		if(!ctype_alnum($login)) {
			$error = "Twój login zawiera niedozwolone znaki.";
		}
		if((!isset($email)) || (empty($email)) || (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
			$error = "Musisz podać poprawny email.";
		}
		if($result != 0) {
			$error = "W bazie danych jest już użytkownik o tym samym loginie lub emailu.";
		}
		if($password != $password2) {
			$error = "Hasła nie są takie same.";
		}
		if((strlen($password) < 6) || (strlen($password) > 20)) {
			$error = "Twoje hasło nie może być mniejsze od 6 znaków oraz większe od 20.";
		}
		if((strlen($login) < 3) || (strlen($login) > 10)) {
			$error = "Twój login nie może być mniejszy od 3 znaków oraz większy od 10.";
		}
	}

	if(isset($error)) {
		$isOk = false;
	}

	if($isOk) {
		if($type == "add") {
			$name = mb_strtoupper($name[0]).mb_substr($name, 1, mb_strlen($name));
			$surname = mb_strtoupper($surname[0]).mb_substr($surname, 1, mb_strlen($surname));
			if(($db_connection -> query("INSERT INTO `names` VALUES (NULL, '$name_author_id', '$name', '$surname')")) && ($db_connection -> query("UPDATE `users` SET `names_added` = `names_added` + 1 WHERE `id` = '$name_author_id'"))) {
				$_SESSION['error'] = "Pomyślnie dodano $name $surname do bazy danych";
				header('Location: addform.php');
			}
		} elseif($type == "report") {
			if($db_connection -> query("INSERT INTO `reports` VALUES (NULL, '$report_author_id', '$name_id', '$name_author_id', '$name', '$surname', '$reason')")) {
				$_SESSION['error'] = "Wysłano zgłoszenie dla $name $surname";
				header('Location: reportform.php');
				if(isset($_SESSION['id'])) {
					unset($_SESSION['id']);
				}
			}
		} elseif($type == "register") {
			$md5_password = md5($password);
			if($db_connection -> query("INSERT INTO `users` VALUES (NULL, '$login', '$email', '$md5_password', 0)")) {
				$_SESSION['login'] = $login;
				$_SESSION['email'] = $email;
				$_SESSION['password'] = $email;
				$_SESSION['islogged'] = true;
				header('Location: registerform.php');
			}
		}
	} else {
		if($type == "add") {
			header('Location: addform.php');
		} elseif($type == "report") {
			header('Location: reportform.php');
		} elseif($type == "register") {
			header('Location: registerform.php');
		}
		if(isset($error)) {
			$_SESSION['error'] = $error;
		} else {
			$_SESSION['error'] = "Wystąpił niezidentyfikowany błąd. Przepraszamy.";
		}
	}
	$db_connection -> close();
?>
