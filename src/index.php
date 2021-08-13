<?php
	session_start();
?>
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
					<h3>
						Witaj
					</h3>
					<div class="txt">
						Witaj na stronie! Znajdziesz tutaj wiele przykładowych imion dodanych przez społeczność.
					</div>
					<h3>
						Serwis Ci się spodobał?
					</h3>
					<div class="txt">
						Masz prawo otrzymać jego kod źródłowy, ponieważ został opublikowany jako otwarto
						źródłowy projekt na licencji
						<a href="https://www.gnu.org/licenses/gpl-3.0.en.html" target="_blank">GNU GPL 3</a>
						na platformie
						<a href="https://github.com/" target="_blank">GitHub</a>
						i jest dostępny do
						<a href="https://github.com/zielony12/baza-danych-imion/archive/refs/heads/main.zip" target="_blank">pobrania</a>
						całkowicie za darmo, lub sklonowania za pomocą popularnego narzędzia
						<a href="https://git-scm.com/">Git</a>.
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
