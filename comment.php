 <?php
	session_start();
	$uid = $_SESSION['myid'];
	if (!$uid) {
		header("location:login.php");
	}
?>
 <?php 
 	$conn = new mysqli("127.0.0.1","root","root", "myPinterest"); 
 	$picurl = $_REQUEST['url']; 
 	$pid = $_REQUEST['pid'];
 	$fetch = $conn->query("select bid from pins where pid = '$pid'");
 	$fbid = $fetch->fetch_array()['bid'];
 	if (isset($_POST['comment']) && $_POST['comment'] == 'comment') {
 		$comments = $_POST['comments'];
 		if ($comments == "") {
 			echo "<script>alert('Please enter complete information!'); history.go(-1);</script>";
 		} else {  
            $insert = "insert into comments(uid, pid, comment, time) values('$uid', '$pid', '$comments', now())";
            $result = $conn->query($insert);

            if ($result) {
                  echo "<script>alert('Successfully comment!'); history.go(-1);</script>";
            } else {
                  echo "<script>alert('System error, try again!'); history.go(-1);</script>";
            }
 		}
 	}

 	if (isset($_POST['like']) && $_POST['like'] == 'like') {
 		if ($conn->connect_error) die("Couldn't connect to database!".$conn->connect_error);
 		$query1 = "select uid from likes where uid = '$uid' and pid = '$pid'";
 		$qresult = $conn->query($query1);
 		$rows = $qresult->num_rows;
 		if ($rows > 0) {
 			echo "<script>alert('You already liked this pin!'); history.go(-1);</script>";
 		} else {
 			$insert2 = "insert into likes(uid, pid, time) values('$uid', '$pid', now())";
	        $result2 = $conn->query($insert2);
	        if ($result2) {
	    		echo "<script>alert('Successfully liked!'); history.go(-1);</script>";
	    	} else {
	    		echo "<script>alert('System error, try again!'); history.go(-1);</script>";
	    	}
 		}
 	}

 	if (isset($_POST['repin']) && $_POST['repin'] == 'repin') {
		$bid= $_POST['bid'];
		$result = $conn->query("insert into pins(bid, url, time) values('$bid', '$picurl', now())");
		if ($result) {
			echo "<script>alert('Successfully repin to your board!'); history.go(-1);</script>";
		} else {
			echo "<script>alert('Fail to repin!'); history.go(-1);</script>";
		}
	} 

	if (isset($_POST['remove']) && $_POST['remove'] == 'remove') {
		$delete = $conn->query("delete from pins where pid='$pid'");
		if ($delete) {
			header('location: view.php?uid='.$uid.'&bid='.$fbid);
		} else {
			echo "<script>alert('Fail to delete!'); history.go(-1);</script>";
		}
	}
 ?>
	