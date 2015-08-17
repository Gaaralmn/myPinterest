<html>
<head>
	<title>Search</title>
	<link rel='stylesheet' href='style.css' />
</head>
<body>
	<?php include 'connect.php'; ?>
	<?php include 'function.php'; ?>
	<?php include 'header.php';?>
	<div class='container'>
		<form method='post'>
			<br /><br />
			<h3>Send message to friend : </h3>
			<span>
				<select name='users'>
					<?php
						$myid = $_SESSION['myid'];	
						$query = "select uid, user_name from users";
						$result = $conn->query($query);
						while ($run = $result->fetch_array()) {
							$uid = $run['uid'];
							$username = $run['user_name'];
							if ($uid != $myid) {
								echo "<option value='$uid'>$username</option>";
							}
						}
					?>
				</select>
			</span>
			<br /> 
			<input type='text' name='input' /> 
			<span><input type='submit' name='send' value='send' /></span>
			<br></br>
			<?php
				if (isset($_POST['send']) && $_POST['send'] == 'send') {
					$user = $_POST['users'];
					$input= $_POST['input'];
					if (empty($input)) {
						echo "Please enter something to send!<br /><br />";
					} else {
			            $search = "insert into message(uid1, uid2, message, time) values ('$myid', '$user', '$input', now())"; 
			            $result = $conn->query($search);  
			            if ($result) {
			         		header("location:message.php");
			            }
				    }
				} 
			?>
			<br /><br />
		</form>
		<h3>Message sent to me:</h3>
		<?php
			$query = "select user_name, message from message, users where message.uid1 = users.uid and uid2='$myid'";
			$result = $conn->query($query);
			while ($run = $result->fetch_array()) {
				$username = $run['user_name'];
				$message = $run['message'];
				echo "From ".$username.": ".$message.'<br /><br />';
			}
		?>
	</div>
</body>
</html>