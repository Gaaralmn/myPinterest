<html>
	<head>
		<link rel="stylesheet" href="photostyle.css"></link>
	</head>
	<body>
		<div id="operation_bar">
			<table align="center">
				<tr>
					<td align="center"><a href="create.php?uid=<?php echo $uid;?>">Create Pinboards</a></td>
					<td align="center"><a href="pinphoto.php?uid=<?php echo $_SESSION['myid'];?>">Pin Photos</a></td>
				</tr>
			</table>
		</div>
	</body>
</html>