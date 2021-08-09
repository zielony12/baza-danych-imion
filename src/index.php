<!DOCTYPE html>
<html lang="pl">
	<head>
		<link rel="stylesheet" href="styles.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>
			Imiona
		</title>
	</head>
	<body>
		<div id="container">
			<div id="dodaj">
				<h4>
					Dodaj imie
				</h4>
				<form name="f1" method="POST" action="add.php">
					<input class="entry" name="e1" type="text" placeholder="Imie" />
					<br /><br />
					<input class="entry" name="e2" type="text" placeholder="Nazwisko" />
					<br /><br />
					<img border="2" src="verify.php" width="170" height="25" />
					<br />
					<input class="entry" name="e3" type="text" placeholder="Kod z obrazka" />
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
		session_start();
		if(ISSET($_SESSION['error'])) {
			echo "<p class='error'>".$_SESSION['error']."</p><br />";
			unset($_SESSION['error']);
		}
	?>
			</div>
		</div>
		<div id="bottom">
			<h4>
				Dodatkowe linki
			</h4>
			<a href="names.php">
				Pokaż imiona
			</a>
			<br />
			<a href="reports.php">
				Pokaż zgłoszenia
			</a>
		</div>
	</body>
</html>
