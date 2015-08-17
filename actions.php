<?php 
	include 'connect.php';
	include 'function.php';

	$action = $_GET['action'];
	$uid = $_GET['uid'];

	$myid = $_SESSION['myid'];
	$bid = $_GET['bid'];

	if ($action == 'send') {
		$conn->query("insert into request(from_id, to_id, time) values('$myid', '$uid', now())");
	}

	if ($action == 'cancel') {
		$conn->query("delete from request where from_id='$myid' and to_id='$uid'");
	}

	if ($action == 'accept') {
		$conn->query("delete from request where from_id='$uid' and to_id='$myid'");
		$conn->query("insert into friends(uid1, uid2, time) values('$myid', '$uid', now())");
	}
	
	if ($action == 'ignore') {
		$conn->query("delete from request where from_id='$uid' and to_id='$myid'");
	}

	if ($action == 'unfriend') {
		$conn->query("delete from friends where (uid1='$uid' and uid2='$myid') or (uid2='$uid' and uid1='$myid')");
	}

	if ($action == 'follow') {
		$conn->query("insert into follow(uid, bid, time) values('$myid', '$bid', now())");
	} 
	if ($action == 'unfollow') {
		$conn->query("delete from follow where uid='$myid' and bid='$bid'");
	}
	
	header('location: profile.php?uid='.$uid);
?>