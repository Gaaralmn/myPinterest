<html>
<head>
	<title>Personal Profile</title>
	<link rel='stylesheet' href='style.css' />
</head>
<body>
	<?php include 'connect.php'; ?>
	<?php include 'function.php'; ?>
	<?php include 'header.php';?>

	<div class='container'>
		<h3>Personal Profile</h3>
				<?php include 'connect.php';?>  
				<?php
					$uid = $_SESSION['myid'];
					if ($conn->connect_error) die($conn->connect_error);
					$query = "select * from users where uid = '$uid'";
					$result = $conn->query($query);
					echo 'Username: '.$result->fetch_assoc()['user_name']. '<br />';
					$result = $conn->query($query);
					echo 'Email: '.$result->fetch_assoc()['email']. '<br />';
					$result = $conn->query($query);
					echo 'Description: '.$result->fetch_assoc()['description']. '<br />';
					$result = $conn->query($query);
					echo 'Location: '.$result->fetch_assoc()['location']. '<br />';

					$result->close();
					$conn->close();
				?>
				<h3>Edit Profile</h3>
				<form action="editfile.php" method="post">
					Username：<input type="text" name="username" />  
		        	<br />  
					Email: <input type="text" name="email" />
		        	<br />
		        	Location: <input type="text" name="location" />
		        	<br />
		        	Password：<input type="password" name="password" />  
		        	<br />  
		        	New Password：<input type="password" name="newpass" />  
		        	<br />
					<input type="submit" name="Edit" value="Edit" /> 
				</form>
	</div>
</body>
</html>