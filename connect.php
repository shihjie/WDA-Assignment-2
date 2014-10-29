<?php
if (!($connection = mysqli_connect('localhost','root','')))
		die("Could not connect");
		
if(!mysqli_select_db($connection, "bidme"))
 {
      die("Error " . mysqli_errno($connection) . " : " . mysqli_error($connection));
 }
?>
