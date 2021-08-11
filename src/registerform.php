<?php
	session_start();
	if((isset($_SESSION['islogged'])) && ($_SESSION['islogged'])) {
		header('Location: panel.php');
		exit();
	}
?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<link rel="stylesheet" href="styles.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>
			Zarejestruj
		</title>
	</head>
	<body>
		<div id="container">
			<div id="dodaj">
				<h4>
					Zarejestruj
				</h4>
				<form name="register" method="POST" action="add.php">
					<input class="entry" name="e_login" type="text" placeholder="Login" />
					<br /><br />
					<input class="entry" name="e_email" type="text" placeholder="E-mail" />
					<br /><br />
					<input class="entry" name="e_password" type="password" placeholder="Hasło" />
					<br /><br />
					<input class="entry" name="e_password2" type="password" placeholder="Powtórz hasło" />
					<br /><br />
					<img border="2" src="verify.php" width="170" height="25" />
					<br />
					<input class="entry" name="e_code" type="text" placeholder="Kod z obrazka" />
					<br /><br />
					<label>
						<input name="accept" type="checkbox" />
						Akceptuję <a href="regulamin.php">regulamin</a>
					</label>
					<br /><br />
					<input class="button" type="submit" value="ZAREJESTRUJ" />
					<br /><br />
					<input name="type" type="hidden" value="register" />
				</form>
<?php
	if(ISSET($_SESSION['error'])) {
		echo "<p class='error'>".$_SESSION['error']."</p><br />";
		unset($_SESSION['error']);
	}
?>
			</div>
		</div>
	</body>
</html>
