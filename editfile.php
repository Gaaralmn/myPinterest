<?php include 'function.php'; ?>
<?php include 'connect.php';?>  
<?php
	$uid = $_SESSION['myid'];
	if (!$uid) {
		header("location:login.php");
	}
?>
<?php
	if(isset($_POST["Edit"]) && $_POST["Edit"] == "Edit") {
        $password = $_POST["password"];
		if ($conn->connect_error) die($conn->connect_error);
		$query = "select password from users where uid = '$uid' and password = '$password'";
		$result = $conn->query($query);
		$row = $result->num_rows;
		if ($row == 0) {
			echo "<script>alert('Password is wrong please reenter!'); history.go(-1);</script>";
		} else {
			if (isset($_POST["username"]) && $_POST["username"] != "") {
				$newuname = $_POST["username"];
				$update1 = "update users set user_name = '$newuname' where uid = '$uid'";
				$conn->query($update1);
			}
			if (isset($_POST["email"]) && $_POST["email"] != "") {
				$newemail = $_POST["email"];
				$update2 = "update users set email = '$newemail' where uid = '$uid'";
				$conn->query($update2);
			}
			if (isset($_POST["location"]) && $_POST["location"] != "") {
				$newloc = $_POST['location'];
				$update3 = "update users set location = '$newloc' where uid = '$uid'";
				$conn->query($update3);
			}
			if (isset($_POST["newpass"]) && $_POST["newpass"] != "") {
				$newpass = $_POST['newpass'];
				$update4 = "update users set password = '$newpass' where uid = '$uid'";
				$conn->query($update4);
			}
			echo "<script>alert('Profile updated successfully!'); history.go(-1);</script>";
		}
	$result->close();
	$conn->close();
	}
	
	
?>
