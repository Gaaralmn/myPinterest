<html>
<head>
	<title>User Profile</title>
	<link rel='stylesheet' href='style.css' />
</head>
<body>
	<?php include 'connect.php'; ?>
	<?php include 'function.php'; ?>
	<?php include 'header.php';?>

	<div class='container'>
		<?php
			if (isset($_GET['uid']) && !empty($_GET['uid'])) {
				$uid = $_GET['uid'];
			} else {
				$uid = $_SESSION['myid'];
			}
			$myid = $_SESSION['myid'];
			$username = getuser($uid, 'user_name');
		?>
		<h3><?php echo $username;?></h3>
		<?php 
			$show = true;
			if ($uid == $myid) {
				$show = false;
				include 'title_bar.php';
				echo "<h3><a href='edit.php'>Edit Profile</a></h3>";
			} else {
				$check_friend = "select fid from friends where (uid1='$uid' and uid2='$myid') or (uid2='$uid' and uid1='$myid')";
				$result = $conn->query($check_friend);
				$rows = $result->num_rows;
				if ($rows > 0) {
					echo "<a href='#' class='box'>Already Friends</a> | <a href='actions.php?action=unfriend&uid=$uid' class='box'>Unfriend $username</a>";
				} else {
					$from_query = $conn->query("select rid from request where from_id='$uid' and to_id='$myid'");
					$to_query = $conn->query("select rid from request where from_id='$myid' and to_id='$uid'");
					if ($from_query->num_rows > 0) {
						echo "<a href='actions.php?action=accept&uid=$uid' class='box'>Accept</a> | <a href='actions.php?action=ignore&uid=$uid' class='box'>Ignore</a>";
					} else if ($to_query->num_rows > 0) {
						echo "<a href='actions.php?action=cancel&uid=$uid' class='box'>Cancel Request</a>";
					} else {
						echo "<a href='actions.php?action=send&uid=$uid' class='box'>Send Friend Request</a>";
					}
				}
			}
		?>
		<br/><br/>
		<?php
			include 'user.php';
		?>
	</div>
</body>
</html>