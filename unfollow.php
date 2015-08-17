<?php 
	session_start();
	include 'connect.php'; 
?>
<?php

	$bid = $_GET['bid'];
	$myid = $_SESSION['myid'];
	$conn->query("delete from follow where uid='$myid' and bid='$bid'");
	header('location: index.php?uid='.$myid);
?>