<?php include 'connect.php';
session_start();
$itemid;
$iname=$_POST['iname'];
$idesc=$_POST['idesc'];
$category=$_POST['category'];
date_default_timezone_set("Asia/Kuala_Lumpur");
$post_date=date("Y-m-d");
$status="Available";
$userid=implode($_SESSION['loggedid']);
$sprice=$_POST['sprice'];
$hbid=$sprice;
$tbid=0;
$endtime=$_POST['endtime'];

$query = "INSERT INTO item (item_name, item_description, post_date, status, user_id, starting_price, highest_bid, total_bid, end_time) 
		  VALUES ('".$iname."', '".$idesc."', '".$post_date."', '".$status."', '".$userid."', '".$sprice."', '".$hbid."', '".$tbid."', '".$endtime."')";
		  
$query2 = "INSERT INTO category (category_name) VALUES ('".$category."')";

if(!mysqli_query($connection, $query))
{
die('Error: '.mysqli_error($connection));
header("Refresh:5;url=postitem.php");
echo "<font color='red'>Invalid Submission!<br/>";
echo "You will be redirected to the Item posting page in 5 seconds<br/>";
echo "If the browser does not automatically redirect,<br/>";
echo "Click here to <a href='postitem.php'/>Post</a> the item again!</font>";
}
else
{
if(!mysqli_query($connection, $query2))
{
die('Error: '.mysqli_error($connection));
header("Refresh:5;url=postitem.php");
echo "<font color='red'>Invalid Submission!<br/>";
echo "You will be redirected to the Item posting page in 5 seconds<br/>";
echo "If the browser does not automatically redirect,<br/>";
echo "Click here to <a href='postitem.php'/>Post</a> the item again!</font>";
}
else
{
$filequery="SELECT item_id from item";

$getfilename = mysqli_query($connection, $filequery)
or die ("Error: ".mysqli_error($connection));
while ($row=mysqli_fetch_array($getfilename))
{
$itemid=implode($row);
}


$target_path = "images/";
$fileextension = explode(".", $_FILES["uploadimage"]["name"]);
$target_path = $target_path.$itemid.".".$fileextension[1];

	if(move_uploaded_file($_FILES['uploadimage']['tmp_name'], $target_path))
	{
	header("Refresh:5;url=postitem.php");
	echo "<font color='red'>Item Posted!<br/>";
	echo "You will be redirected to the Item posting page in 5 seconds<br/>";
	echo "If the browser does not automatically redirect,<br/>";
	echo "Click here to <a href='postitem.php'/>Post</a> another item!</font>";
	}
}
}

mysqli_close($connection);
?>
