<?php
	session_start();
	function loggedin() {
		if (isset($_SESSION['myid']) && !empty($_SESSION['myid'])) {
			return true;
		} else {
			return false;
		}
	}

	function getuser($uid, $field) {
		$conn = new mysqli("127.0.0.1","root","root", "myPinterest");
		$query = "select $field from users where uid='$uid'";
		$result = $conn->query($query);
		return $result->fetch_array()[$field];
	}

	function removePin($pid) {
		
	}
?>