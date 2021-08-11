<?php
	header('Content-Type: text/html; charset=UTF-8');
	session_start();

	if((isset($_SESSION['islogged'])) && ($_SESSION['islogged'])) {
		header('Location: panel.php');
		exit();
	}

	// login
	if(isset($_POST['e_login'])) {
		$login = strtolower($_POST['e_login']);
	}

	// hasło
	if(isset($_POST['e_password'])) {
		$password = md5(strtolower($_POST['e_password']));
	}

	// czy jest wszystko w porządku?
	$isOk = true;

	require_once "connect.php";

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
  $query_result = mysqli_query($db_connection, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
  $result = $query_result -> num_rows;

	if($result == 0) {
		$error = "Login lub hasło są nie poprawne.";
	}
	if((!isset($password)) || (empty($password))) {
		$error = "Proszę podać hasło.";
	}
	if((!isset($login)) || (empty($login))) {
		$error = "Proszę podać login.";
	}

	if(isset($error)) {
		$isOk = false;
	}

	if($isOk) {
    $_SESSION['login'] = $login;
    $_SESSION['password'] = $password;
    $_SESSION['islogged'] = true;
    header('Location: panel.php');
  } else {
    header('Location: loginform.php');
		if(isset($error)) {
			$_SESSION['error'] = $error;
		} else {
			$_SESSION['error'] = "Wystąpił niezidentyfikowany błąd. Przepraszamy.";
		}
	}
	$db_connection -> close();
?>
