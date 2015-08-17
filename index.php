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
		<div class='background'>
			<h1>Share your favorite pictures with us!</h1>
			<br/>
			<h2> Your followed boards!</h2>
			<br/>
			<?php // revise sql and while loop
				$myid = $_SESSION['myid'];
			    $query = "select uid,board_name,pins.bid, url  from pinboards join pins using(bid) ,(select max(pid)as B from pins group by bid)
			               as A
			               where pins.pid=A.B and bid in (select bid from follow where uid=$myid) " ; 
			    $result = $conn->query($query);
			   
			    if(!$result) die ($conn->error);
			    $row =mysqli_fetch_array($result);
			    while ($row) {
			    	$uid = $row['uid'];
			    	$boardname=$row['board_name'];
			        $bid1 = $row['bid'];
			    	$picurl =$row['url'];
			    	$row =mysqli_fetch_array($result);
			?>


			<div id="view_box">
				<a href='view.php?bid=<?php echo $bid1?>&uid=<?php echo $uid?>'>
				<img src='<?php echo $picurl; ?>' />
				</a>
				<br />
				<a href='view.php?bid=<?php echo $bid1?>' class='box' style='display:block'>
				<?php echo $boardname?>
				</a>
				<span><a href='unfollow.php?action=unfollow&bid=<?php echo $bid1;?>' class='box' style='display:block'>unfollow</a></span>
			</div>

			<?php 
				}
			?>

			<h2>Recommended Boards!</h2>
			<br />
			<?php
				$query = "select uid,board_name,pins.bid, url  
						  from pinboards join pins using(bid) ,(select max(pid)as B from pins group by bid) as A
			              where pins.pid=A.B and bid in (select bid from pins join likes using(pid) 
			              								 where uid = $myid and bid not in (select bid from follow where uid = $myid) 
			              								 and bid not in (select bid from pinboards where uid = $myid))";
				$result = $conn->query($query);
				if(!$result) die ($conn->error);
			    $row =mysqli_fetch_array($result);
			    while ($row) {
			    	$uid = $row['uid'];
			    	$boardname=$row['board_name'];
			        $bid1 = $row['bid'];
			    	$picurl =$row['url'];
			    	$row =mysqli_fetch_array($result);
			?>
				<div id="view_box">
					<a href='view.php?bid=<?php echo $bid1?>&uid=<?php echo $uid?>'>
					<img src='<?php echo $picurl; ?>' />
					</a>
					<br />
					<a href='view.php?bid=<?php echo $bid1?>' class='box' style='display:block'>
					<?php echo $boardname?>
					</a>
					<span><a href='actions.php?action=follow&bid=<?php echo $bid1;?>' class='box' style='display:block'>follow</a></span>
				</div>
			<?php
				}
			?>
		</div>
	</div>
</body>
</html>