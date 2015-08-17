<html>
<head>
	<title>Friend System</title>
	<link rel='stylesheet' href='style.css' />
</head>
<body>
	<?php include 'connect.php'; ?>
	<?php include 'function.php'; ?>
	<?php include 'header.php';?>

	<div class='container'>
		<h3>Request : </h3>
		<?php
			$myid = $_SESSION['myid'];
			$query = $conn->query("select from_id from request where to_id='$myid'");
			while ($run = $query->fetch_array()) {
				$from_id = $run['from_id'];
				$from_username = getuser($from_id, 'user_name');
				echo "<a href='profile.php?uid=$from_id' class='box' style='display:block'>$from_username</a>";
			}
		?>
	</div>
</body>
</html>