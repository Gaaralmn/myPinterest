<html>
<head>
	<title>Photos View</title>
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
			if ($uid == $myid) {
				include 'title_bar.php';
			}
		?>
		<?php
			$bid = $_GET['bid'];
			if ($conn->connect_error) die("Couldn't connect to database!".$conn->connect_error);
            $query = "select pid, url from pins where bid = '$bid'"; 
            $result = $conn->query($query);  
            if(!$result) die ($conn->error);
            while ($run = $result->fetch_array()) {	
            	$pid = $run['pid'];	    
            	$picur = $run['url'];
            
		?>
		<div id="view_box">
			<a href='viewphoto.php?pid=<?php echo $pid?>&uid=<?php echo $uid?>'><img src='<?php echo $picur; ?>' /></a>
			<br />
		</div>
		<?php 
			}
		?>
	</div>
</body>
</html>