<?php
	session_start();
	if((!isset($_SESSION['islogged'])) || (!$_SESSION['islogged'])) {
		$_SESSION['error'] = "Musisz się najpierw zalogować";
		header('Location: loginform.php');
		exit();
	}
?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<link rel="stylesheet" href="styles.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>
			Dodaj imie
		</title>
	</head>
	<body>
		<div id="container">
			<div id="dodaj">
				<h4>
					Dodaj imie
				</h4>
				<form name="add" method="POST" action="add.php">
					<input class="entry" name="e_name" type="text" placeholder="Imie" />
					<br /><br />
					<input class="entry" name="e_surname" type="text" placeholder="Nazwisko" />
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
					<input class="button" type="submit" value="DODAJ" />
					<br /><br />
					<input name="type" type="hidden" value="add" />
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
