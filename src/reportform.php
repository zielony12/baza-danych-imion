<?php
	session_start();
	if((!isset($_SESSION['islogged'])) || (!$_SESSION['islogged'])) {
		$_SESSION['error'] = "Musisz się najpierw zalogować";
		header('Location: loginform.php');
		exit();
	}
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
			Zgłoś
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
						Zgłoś
					</h4>
					<form name="report" method="POST" action="add.php">
						<input class="entry" name="e_name" type="text" placeholder="Imie"
	<?php
		if(isset($_SESSION['name'])) {
			echo 'value="'.$_SESSION['name'].'"';
		}
	?>
						/>
						<br /><br />
						<input class="entry" name="e_surname" type="text" placeholder="Nazwisko"
	<?php
		if(isset($_SESSION['surname'])) {
			echo 'value="'.$_SESSION['surname'].'"';
		}
	?>
						/>
						<br /><br />
						<label>
							<input class="radio" name="reason" value="reason1" type="radio" />
							To moje imie
						</label>
						<br /><br />
						<label>
							<input class="radio" name="reason" value="reason2" type="radio" />
							Imie zawiera wulgaryzmy
						</label>
						<br /><br />
						<label>
							<input class="radio" name="reason" value="reason3" type="radio" checked="true" />
							Imie w inny sposób niszczy zasady regulaminu
						</label>
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
						<input class="button" type="submit" value="ZGŁOŚ" />
						<br /><br />
						<input name="type" type="hidden" value="report" />
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
