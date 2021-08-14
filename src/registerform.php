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
			<!--topbar begin-->
			<div id="topbar">
				<div id="topbar-left">
					<div class="topbar-item">
						<a href="index.php">
							Indeks
						</a>
					</div>
					<div class="topbar-item">
						<a href="names.php">
							Imiona
						</a>
					</div>
<?php
	if((isset($_SESSION['islogged'])) && ($_SESSION['islogged'])) {
		echo "<div class=\"topbar-item\"><a href=\"addform.php\">Dodaj</a></div>";
	}
?>
				</div>
				<div id="topbar-right">
					<div class="topbar-item">
<?php
	if((isset($_SESSION['islogged'])) && ($_SESSION['islogged'])) {
		echo "<a href=\"panel.php\">".$_SESSION['login']."</a>";
	} else {
		echo "<a href=\"loginform.php\">Zaloguj</a>";
	}
?>
					</div>
					<div class="topbar-item">
<?php
	if((isset($_SESSION['islogged'])) && ($_SESSION['islogged'])) {
		echo "<a href=\"logout.php\">Wyloguj</a>";
	} else {
		echo "<a href=\"registerform.php\">Zarejestruj</a>";
	}
?>
					</div>
				</div>
			</div>
			<!--topbar end-->
			<div id="content">
			<div id="center">
<?php
		if(isset($_SESSION['error'])) {
			echo "<div id=\"session-info\">
						<div class=\"info\">i</div>";
			echo $_SESSION['error']."<br />";
			echo "</div>";
			unset($_SESSION['error']);
		}
?>
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
						<img class="code" src="verify.php" />
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
				</div>
			</div>
		</div>
	</body>
</html>
