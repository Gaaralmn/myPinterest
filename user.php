<?php // revise sql and while loop
	if ($conn->connect_error) die("Couldn't connect to database!".$conn->connect_error);
    $query = "select board_name ,pins.bid as bid, url  
              from pinboards, pins, (select max(pid)as B from pins group by bid) as A
              where uid = $uid and pins.pid=A.B and pinboards.bid=pins.bid"; 
    $result = $conn->query($query);
    if(!$result) die ($conn->error);
    $row =mysqli_fetch_array($result);
    while ($row) {
    	$boardname= $row['board_name'];
        $bid1 = $row['bid'];
    	$picurl =$row['url'];
    	$row =mysqli_fetch_array($result);
?>
<div id="view_box">
	<a href='view.php?bid=<?php echo $bid1?>&uid=<?php echo $uid?>'>
	<img src='<?php echo $picurl; ?>' />
	</a>
	<br />
	<a href='view.php?bid=<?php echo $bid1?>' class='box' style='display:block'>
	<b><?php echo $boardname?></b>
	</a>
    <span>
    <?php 
        if ($show) {
            $myid = $_SESSION['myid'];
            $result = $conn->query("select foid from follow where uid='$myid'and bid='$bid1'");
            $num = $result->num_rows;
            if ($num > 0) {
                echo "<a href='actions.php?action=unfollow&bid=$bid1&uid=$uid' class='box' style='display:block'>unfollow</a>";
            } else {
                echo "<a href='actions.php?action=follow&bid=$bid1&uid=$uid' class='box' style='display:block'>follow</a>";
            }
        }
    ?>
    </span>
</div>

<?php 
	}
?>