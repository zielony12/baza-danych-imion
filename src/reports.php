<?php
	session_start();
	require_once "connect.php";

	try {
		$db_connection = new mysqli($db_host, $db_user, $db_password, $db_name);
		mysqli_set_charset($db_connection, "utf8");

		if($db_connection -> connect_errno != 0) {
			throw new Exception(mysqli_connect_errno());
		} else {
			$query_result = $db_connection -> query("SELECT * FROM `reports` ORDER BY `id` ASC");
		}
	} catch(Exception $e) {
		$_POST['error'] = $e;
		header('Location: index.php');
		exit();
	}
?>
<!DOCTYPE html>
<html>
	<head lang="pl">
		<link rel="stylesheet" href="styles.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>
			Lista zgłoszeń
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
					<h4>
						Lista dodanych zgłoszeń
					</h4>
					<table id="zgloszenia">
						<thead>
							<tr>
								<th>
									Nr
								</th>
								<th>
									Imie
								</th>
								<th>
									Nazwisko
								</th>
								<th>
									Autor im.
								</th>
								<th>
									Autor zgł.
								</th>
								<th>
									Powód
								</th>
							</tr>
						</thead>
						<tbody>
			<?php
				$i = 1;
				while($row = mysqli_fetch_assoc($query_result)) {
			?>
							<tr>
								<td>
			<?php
				echo $i;
			?>
								</td>
								<td>
			<?php
				echo $row['name'];
			?>
								</td>
								<td>
			<?php
				echo $row['surname'];
			?>
								</td>
								<td>
			<?php
				$name = $row['name'];
				$surname = $row['surname'];
				$name_author_id = @mysqli_fetch_assoc($db_connection -> query("SELECT `name_author_id` FROM `names` WHERE `name` = '$name' AND `surname` = '$surname'"))['name_author_id'];
				if(isset(mysqli_fetch_assoc($db_connection -> query("SELECT `login` FROM `users` WHERE `id` = '$name_author_id'"))['login'])) {
					echo mysqli_fetch_assoc($db_connection -> query("SELECT `login` FROM `users` WHERE `id` = '$name_author_id'"))['login'];
				} else {
					echo "<div style=\"color:red\">ERROR</div>";
				}
			?>
								</td>
								<td>
			<?php
				$report_author_id = $row['name_author_id'];
				if(isset(mysqli_fetch_assoc($db_connection -> query("SELECT `login` FROM `users` WHERE `id` = '$report_author_id'"))['login'])) {
					echo mysqli_fetch_assoc($db_connection -> query("SELECT `login` FROM `users` WHERE `id` = '$report_author_id'"))['login'];
				} else {
					echo "<div style=\"color:red\">ERROR</div>";
				}
			?>
								</td>
								<td>
			<?php
				echo $row['reason'];
			?>
			<?php
				$i ++;
			}
			?>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>
