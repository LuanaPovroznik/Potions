<?php
	$con = mysqli_connect('localhost','root','');
	$db = mysqli_select_db($con, 'potions');

    $localUrl = "http://localhost/Trabalho2Bimestre";
	if( !$con || !$db )
	{
		echo "<pre>";
		echo mysqli_error($con);
		echo "</pre>";
	}
?>