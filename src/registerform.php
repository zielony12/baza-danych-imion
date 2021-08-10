<?php
	session_start();
	if((isset($_POST['name'])) && (isset($_POST['surname']))) {
		$_SESSION['name'] = $_POST['name'];
		$_SESSION['surname'] = $_POST['surname'];
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
					<input class="entry" name="e_login" type="text" placeholder="Login" value="<?php echo $_SESSION['login']; ?>" />
					<br /><br />
					<input class="entry" name="e_email" type="text" placeholder="" value="<?php echo $_SESSION['email']; ?>" />
					<br /><br />
					<label>
						<input class="radio" name="reason" value="To moje imie" type="radio" />
						To moje imie
					</label>
					<br /><br />
					<label>
						<input class="radio" name="reason" value="Imie zawiera wulgaryzmy" type="radio" />
						Imie zawiera wulgaryzmy
					</label>
					<br /><br />
					<label>
						<input class="radio" name="reason" value="Imie w inny sposób niszczy zasady regulaminu" type="radio" checked="true" />
						Imie w inny sposób niszczy zasady regulaminu
					</label>
					<br /><br />
					<img border="2" src="verify.php" width="170" height="25" />
					<br />
					<input class="entry" name="e3" type="text" placeholder="Kod z powyższego obrazka" />
					<br /><br />
					<label>
						<input name="accept" type="checkbox" />
						Akceptuję <a href="regulamin.php">regulamin</a>
					</label>
					<br /><br />
					<input class="button" type="submit" value="ZGŁOŚ" />
					<br /><br />
					<input name="type" type="hidden" value="report" />
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
