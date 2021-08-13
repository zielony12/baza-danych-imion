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
						Dodaj imie
					</h4>
					<form name="add" method="POST" action="add.php">
						<input class="entry" name="e_name" type="text" placeholder="Imie" />
						<br /><br />
						<input class="entry" name="e_surname" type="text" placeholder="Nazwisko" />
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
						<input class="button" type="submit" value="DODAJ" />
						<br /><br />
						<input name="type" type="hidden" value="add" />
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
