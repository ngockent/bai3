<?php
	$ID=$_GET['Xoa'];
	require_once("connect.php");
	$query=mysqli_query($conn,"delete from ruttien where ID=$ID");
	header('location:hienthi.php');
	?>