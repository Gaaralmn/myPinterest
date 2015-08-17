<html>
<head>
	<title>Members</title>
	<link rel='stylesheet' href='style.css' />
</head>
<body>
	<?php include 'connect.php'; ?>
	<?php include 'function.php'; ?>
	<?php include 'header.php';?>

	<div class='container'>
		<h3>Members: </h3>
		<?php 
			$myid = $_SESSION['myid'];
			$query = "select uid from users";
			$result = $conn->query($query);
			while ($run = $result->fetch_array()) {
				$uid = $run['uid'];
				$username = getuser($uid, 'user_name');
				if ($uid != $myid) {
					echo "<a href='profile.php?uid=$uid' class='box' style='display:block'>$username</a>";
				}
			}
		?>
	</div>
</body>
</html>