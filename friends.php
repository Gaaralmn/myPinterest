<html>
<head>
	<title>My Friends</title>
	<link rel='stylesheet' href='style.css' />
</head>
<body>
	<?php include 'connect.php'; ?>
	<?php include 'function.php'; ?>
	<?php include 'header.php';?>

	<div class='container'>
		<h3>Friend lists : </h3>
		<?php
			$myid = $_SESSION['myid'];
			$query = $conn->query("select uid1, uid2 from friends where uid1='$myid' or uid2='$myid'");
			while ($run = $query->fetch_array()) {
				$uid1 = $run['uid1'];
				$uid2 = $run['uid2'];
				$fid = $uid1;
				if ($uid1 == $myid) {
					$fid = $uid2;
				}
				$friendname = getuser($fid, 'user_name');
				echo "<a href='profile.php?uid=$fid' class='box' style='display:block'>$friendname</a>";
			}
		?>
	</div>
</body>
</html>