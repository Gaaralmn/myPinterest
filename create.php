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
		<?php include 'title_bar.php';?>
		<form method="POST">
			<?php
			if (isset($_POST['boardname'])) {
				$uid = $_GET['uid'];
				$boardname = $_POST['boardname'];
				$Category = $_POST['Category'];
				$status = $_POST['status'];
				$desc = $_POST['desc'];
				if (empty($boardname)) {
					echo "Please enter the pinborad name first!<br /><br />";
				} else {
					if ($conn->connect_error) die("Couldn't connect to database!".$conn->connect_error);
		            $query = "select board_name from pinboards where uid='$uid' and board_name='$boardname'"; 
		            $result = $conn->query($query);  
		            if(!$result) die ($conn->error);  
		            $rows = $result->num_rows;
		            if ($rows > 0) {
		            	echo "<script>alert('Board name already exists, please choose another one!'); history.go(-1);</script>";
		            } else {
						$insert = "insert into pinboards(uid, board_name, category, open_status, description, time) values ('$uid', '$boardname', '$Category', '$status', '$desc', now())";
		                $reg_result = $conn->query($insert);
		                if ($reg_result) {
		                	$search = "select bid from pinboards where uid='$uid' and board_name='$boardname'";
		                	$result = $conn->query($search);
		                	$_SESSION['bid'] = $result->fetch_assoc()['bid'];
		                    echo "<script>alert('Successfully created a new Board!');</script>";
		                } else {
		                    echo "<script>alert('System is busy now, Please try later!'); history.go(-1);</script>";
		            	}
		            }
		            $result->close();
		            $conn->close();
					echo "Pinboard $boardname is created successfully!<br /><br />";
				}						
			}
			?>
			Pinboard Name: <input type:"text" name="boardname" />
			<br />
			Category: <input type:"text" name="Category" />
			<br />
			Open status: <input type:"text" name="status" />
			<br />
			Description: <input type:"text" name="desc" />
			<br />
			<input type="submit" value="Create" />
		</form>
	</div>
</body>
</html>