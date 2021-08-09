<?php
	session_start();
	require_once "connect.php";
	try {
		$db_connection = new mysqli($db_host, $db_user, $db_password, $db_name);
		mysqli_set_charset($db_connection, "utf8");
		if($db_connection -> connect_errno != 0) {
			throw new Exception(mysqli_connect_errno());
		} else {
			$query_result = mysqli_query($db_connection, "SELECT * FROM `regulamin` ORDER BY `id` ASC");
		}
	} catch(Exception $e) {
		$_POST['error'] = $e;
		header('Location: index.php');
		exit();
	}
?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>
			Regulamin
		</title>
	</head>
	<body>
		<h4>
			Regulamin
		</h4>
		<div id="regulamin">
<?php
	while($row = mysqli_fetch_assoc($query_result)) {
		echo "> ".$row['content']."<br />";
	}
?>
		</div>
	</body>
</html>
