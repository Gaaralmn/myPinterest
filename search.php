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
			<h3>Input to search : </h3>
			<br /> 
			<input type='text' name='input' /> 
			<span><input type='submit' name='search' value='search' /></span>
			<br></br>
			<?php
				if (isset($_POST['search']) && $_POST['search'] == 'search') {
					$input= '%'.$_POST['input'].'%';
					if (empty($input)) {
						echo "Please enter something to  search!<br /><br />";
					} else {
			            $search = "select uid, pid, url from pins, pinboards where (board_name like '$input') or (category like '$input') or (description like '$input') or (url like '$input')"; 
			            $result = $conn->query($search);  
			            while ($run = $result->fetch_array()) {
			            	$url = $run['url'];
			            	$pid = $run['pid'];
			            	$uid = $run['uid'];
			            	echo "<a href='viewphoto.php?pid=$pid&uid=$uid' class='box' style='display:block'>$url</a>";
			            }
				    }
				} 
			?>
			<br /><br />
		</form>
	</div>
</body>
</html>