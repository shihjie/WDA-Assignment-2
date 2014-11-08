<?php include 'connect.php';
session_start();
if(isset($_SESSION['loggedid']))
{
$itemid;
$iname=$_POST['iname'];
$idesc=$_POST['idesc'];
$category=$_POST['category'];
$categoryid=1;
if($category=="collectible")
{
$categoryid=1;
}
else
{
	if($category=="electronic")
	{
	$categoryid=2;
	}
	else
	{
		if($category=="entertainment")
		{
		$categoryid=3;
		}
		else
		{
			if($category=="fashion")
			{
			$categoryid=4;
			}
			else
			{
				if($category=="garden")
				{
				$categoryid=5;
				}
				else
				{
					if($category=="motor")
					{
					$categoryid=6;
					}
					else
					{
						if($category=="sport")
						{
						$categoryid=7;
						}
						else
						{
							if($category=="toy")
							{
							$categoryid=8;
							}
							else
							{
								if($category=="other")
								{
								$categoryid=9;
								}
							}
						}
					}
				}
			}
		}
	}
}
date_default_timezone_set("Asia/Kuala_Lumpur");
$post_date=date("Y-m-d");
$status="Available";
$userid=implode($_SESSION['loggedid']);
$sprice=$_POST['sprice'];
$hbid=$sprice;
$tbid=0;
$endtime=$_POST['endtime'];

$query = "INSERT INTO item (item_name, item_description, category_id, post_date, status, user_id, starting_price, highest_bid, total_bid, end_time) 
		  VALUES ('".$iname."', '".$idesc."', '".$categoryid."', '".$post_date."', '".$status."', '".$userid."', '".$sprice."', '".$hbid."', '".$tbid."', '".$endtime."')";
		  

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
else
{
header("Refresh:5;url=login.html");
echo "<font color='red'>Please log in before editing your profile!<br/>";
echo "You will be redirected to the login page in 5 seconds<br/>";
echo "If the browser does not automatically redirect,<br/>";
echo "Click here to <a href='login.html'/>Log in</a>.</font>";
}
mysqli_close($connection);
?>
