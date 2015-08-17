<html>
<head>
	<title>Register</title>
	<link rel='stylesheet' href='style.css' />
</head>
<body>
	<?php include 'connect.php'; ?>
	<?php include 'function.php'; ?>
	<?php include 'header.php';?>

	<div class='container'>
		<h3>Reigister a new Account</h3>
		<form method='post'>
			<?php  
			    if(isset($_POST["submit"]) && $_POST["submit"] == "Login")  
			    {  
			        $username = $_POST["username"];  
			        $password = $_POST["password"];  
			        if($username == "" || $password == "") {  
			            echo "<script>alert('Please enter username and password to Login!'); history.go(-1);</script>";  
			        }  
			        else {  
			            //$conn = new mysqli("127.0.0.1","root","root", "myPinterest");  
			            if ($conn->connect_error) die("Couldn't connect to database!".$conn->connect_error);
			            $query = "select uid, user_name,password from users where user_name = '$_POST[username]' and password = '$_POST[password]'"; 
			            $result = $conn->query($query);  
			            if(!$result) die ($conn->error);  
			            $rows = $result->num_rows;
			            if ($rows > 0) {
			                $_SESSION["myid"] = $result->fetch_assoc()['uid'];
			                $_SESSION["myname"] = $username;
			            	echo "Successfully Login!";
			                header("location:index.php");
			            } else {
			            	echo "<script>alert('Username or Password is incerrect!'); history.go(-1);</script>";
			            } 
			            $result->close();
			            $conn->close();
			        }  
			    }   
			  
			?>  
		<form method="post">  
    	Username：<input type="text" name="username" />  
    	<br />  
    	Password：<input type="password" name="password" />  
    	<br />  
    	<input type="submit" name="submit" value="Login" />  
    	<a href="register.php">New here? please register for free!</a>  
		</form> 
	</div>
</body>
</html>