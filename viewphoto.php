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
			$pid = $_GET['pid'];
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
			$query = "select location from pins where pid = '$pid'"; 
            $result = $conn->query($query);  
            $run = $result->fetch_array();
            $location = $run['location']; 
		?>
		<h4>Pin from: <a href='locphoto.php?location=<?php echo $location;?>'><?php echo $location;?></a></h4>
		<?php 
			if ($uid == $myid) {
				include 'title_bar.php';
			}
		?>
		<?php
			if ($conn->connect_error) die("Couldn't connect to database!".$conn->connect_error);
            $query = "select url from pins where pid = '$pid'"; 
            $result = $conn->query($query);  
            if(!$result) die ($conn->error);
            $run = $result->fetch_array();
            $picur = $run['url'];   
        ?>
			<div id="view_box">
				<a href='<?php echo $picur; ?>'><img src='<?php echo $picur; ?>' /></a>
				<br />
			</div>
			<br/>
			<form action = "comment.php?pid=<?php echo $pid;?>&url=<?php echo $picur;?>" method = "post">
				<input type="submit" name="like" value="like"> 
				<span>
					<?php
						$search = "select count(uid) as likecount from likes where pid = '$pid'"; 
            			$cresult = $conn->query($search);  
            			$count = $cresult->fetch_array()['likecount'];
            			if ($count > 0) {
            				echo $count." likes!";
            			}	
            			$count = 0;
            			$cresult->close();
					?>
				</span>
				<span><input type="submit" name="repin" value="repin"></span>
				<span>to myboard</span>
				<span>
					<select name='bid'>
						<?php
							$query = "select bid ,board_name from pinboards where uid = '$myid'";
							$result = $conn->query($query);
							while ($run = $result->fetch_array()) {
								$bid = $run['bid'];
								$boardname = $run['board_name'];
								echo "<option value='$bid'>$boardname</option>";
							}
						?>
					</select>
				</span>
				<br />
				<input type="submit" name="remove" value="remove">
				<br />
				<div>
					<h3>All comments:</h3>
					<?php
						if ($conn->connect_error) die("Couldn't connect to database!".$conn->connect_error);
			            $query = "select user_name, comment from comments join users using(uid) where pid = '$pid'"; 
			            $result = $conn->query($query);  
			            if(!$result) die ($conn->error);
			            while ($run = $result->fetch_array()) {	
			            	$username = $run['user_name'];	    
			            	$comment = $run['comment'];
			            	echo $username.": ".$comment;
			            	echo '<br />';
						}
					?>
				</div>
				<h3>Add a comment</h3>
				<table>
					<tr>
						comment:
						<span><input type="text" name="comments"></span>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="comment" value="comment"></td>
					</tr>
				</table>
			</form>
	</div>
</body>
</html>