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
			$myid = $_SESSION['myid'];
			include 'title_bar.php';
			$location = $_GET['location'];
		?>
		<h4>Photos that pin from <?php echo $location;?></h4>
		<?php
			if ($conn->connect_error) die("Couldn't connect to database!".$conn->connect_error);
            $query = "select pid, url, uid from pins join pinboards using(bid) where location = '$location'"; 
            $result = $conn->query($query);  
            if(!$result) die ($conn->error);
            while ($run = $result->fetch_array()) {	
            	$uid = $run['uid'];
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