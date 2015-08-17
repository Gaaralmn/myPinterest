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
		<h3>Select photo to pin!</h3>
			<form enctype='multipart/form-data' method='post'>
				<?php
					if (isset($_POST['pin']) && $_POST['pin'] == 'upload') {
						$location = $_POST['location'];
						$bid= $_POST['bid'];
						$desc = $_POST['desc'];
						$file = $_FILES['filename']['name'];
						$file_type = $_FILES['filename']['type'];
						$file_size = $_FILES['filename']['size'];
						$file_tmp = $_FILES['filename']['tmp_name'];

						if (empty($desc) or empty($file)) {
							echo "Please fill all the fields! <br /><br />";
						} else {
							switch ($file_type) {
								case 'image/jpeg': $ext = '.jpg'; break;
								case 'image/gif': $ext = '.gif'; break;
								case 'image/png': $ext = '.png'; break;
								case 'image/tiff': $ext = '.tif'; break;
								default: 		   $ext = ''; 	 break;
							}
							if ($ext) {
								$url = 'img/'.$desc.$ext;
								move_uploaded_file($file_tmp, 'img/'.$desc.$ext);
								if ($conn->connect_error) die("Couldn't connect to database!".$conn->connect_error);
					            $insert = "insert into pins(bid, url, time) values('$bid', '$url', '$location', now())"; 
					            $result = $conn->query($insert);  
					            if(!$result) {
					            	die ($conn->error);
					            } else {
					            	echo "Photo Uploaded!";
					            }
							}
						}
					} elseif (isset($_POST['pin']) && $_POST['pin'] == 'download') {
						$location = $_POST['location'];
						$bid= $_POST['bid'];
						$url = $_POST['url'];
						$name = basename($url);
						$locurl = "img/$name";
						$result = file_put_contents($locurl, file_get_contents($url));
						if ($result) {
							$insert = "insert into pins(bid, url, location, time) values('$bid', '$locurl', '$location', now())"; 
				            $result = $conn->query($insert);  
				            if(!$result) {
				            	die ($conn->error);
				            } else {
				            	echo "Successfully pin from Internet!";
				            }
						}
					}

				?>
				<br />
				Currently Location: <span><input type='text' name='location' /></span>
			    <br />
				Description: <br />
				<input type='text' name='desc' />	
				<br /><br /> 
				Select board: <br />
				<select name='bid'>
					<?php
						$uid = $_GET['uid'];
						$query = "select bid ,board_name from pinboards where uid = '$uid'";
						$result = $conn->query($query);
						while ($run = $result->fetch_array()) {
							$bid = $run['bid'];
							$boardname = $run['board_name'];
							echo "<option value='$bid'>$boardname</option>";
						}
					?>
				</select>
				<br /><br />
				Select Photo: <br />
				<input type='file' name='filename' />
				<br /><br />
				<input type='submit' name='pin' value='upload' />
				<br /><br />
				Pin through url: 
				<br /><br />
				Input the url to pin: <br /><br />
				<input type='url' name='url' /> <br /><br />
				<input type='submit' name='pin' value='download' />
			</form>
	</div>
</body>
</html>