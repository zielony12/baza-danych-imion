<?php
	header('Content-Type: text/html; charset=UTF-8');
	session_start();
	$type = $_POST['type'];

	// imie
	if(isset($_POST['e_name'])) {
		$name = filter_var($_POST['e_name'], FILTER_SANITIZE_STRING);
	}

	// nazwisko
	if(isset($_POST['e_surname'])) {
		$surname = $_POST['e_surname'];
	}

	// kod
	$code = $_POST['e_code'];


	// powód
	if(isset($_POST['reason'])) {
		$reason = $_POST['reason'];
	}

	// czy jest wszystko w porządku?
	$isOk = true;

	require_once "connect.php";

	if(!isset($_POST['accept'])) {
		$error = "Musisz zaakceptować warunki zawarte w <a href='regulamin.php'>regulaminie</a>.";
	}
	if($_SESSION['code'] != $code) {
		$error = "Kod z obrazka nie pasuje do kodu w polu tekstowym.";
	}
	try {
		$db_connection = new mysqli($db_host, $db_user, $db_password, $db_name);
		$db_connection -> query("SET NAMES 'utf8'");
		mysqli_set_charset($db_connection, "utf-8");
		if($db_connection -> connect_errno != 0) {
			throw new Exception(mysqli_connect_errno());
		}
	} catch(Exception $e) {
		$error = "Nie można się połączyć z bazą danych. Przepraszamy.";
	}

	$query_result = mysqli_query($db_connection, "SELECT * FROM `names` WHERE `name` = '$name' AND `surname` = '$surname'");
	$result = $query_result -> num_rows;

	if($type == "add") {
		if((strlen($name) < 3) || (strlen($surname) < 3) || (strlen($name) > 12) || (strlen($surname) > 12)) {
			$error = "Twoje imie i nazwisko nie może być mniejsze od 3 znaków oraz większe od 12.";
		}
		if($result > 0) {
			$error = "W bazie danych istnieje już takie imie.";
		}
	} elseif($_POST['type'] == "report") {
		if((!isset($name)) || (empty($name)) || (!isset($name)) || (empty($surname))) {
			$error = "Musisz podać imie oraz nazwisko, które chcesz zgłosić.";
		}
		if($result == 0) {
			$error = "Podane imie nie jest w bazie danych.";
		} else {
			$row = mysqli_fetch_assoc($query_result);
			$id = $row['id'];
		}
	}
	if(isset($error)) {
		$isOk = false;
	}

	if($isOk) {
		if($type == "add") {
			if($db_connection -> query("INSERT INTO names VALUES (NULL, '$name', '$surname')")) {
				$_SESSION['error'] = "Pomyślnie dodano $name $surname do bazy danych";
				header('Location: addform.php');
			}
		} elseif($type == "report") {
			if($db_connection -> query("INSERT INTO reports VALUES (NULL, '$id', '$name', '$surname', '$reason')")) {
				$_SESSION['error'] = "Wysłano zgłoszenie dla $name $surname";
				header('Location: addform.php');
				if(isset($_SESSION['id'])) {
					unset($_SESSION['id']);
				}
			}
		}
	} else {
		if($type == "add") {
			header('Location: addform.php');
		} elseif($type == "report") {
			header('Location: reportform.php');
		}
		if(isset($error)) {
			$_SESSION['error'] = $error;
		} else {
			$_SESSION['error'] = "Wystąpił niezidentyfikowany błąd. Przepraszamy.";
		}
	}
	$db_connection -> close();
?>
