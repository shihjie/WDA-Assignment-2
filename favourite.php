<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php //include_once("html_head_template.php");commented this out because I don't have the design file for this part yet.
?>
</head>
<body>

<?php include_once("connect.php");
include_once("expiry.php");
include_once("search.php");
session_start();
if(isset($_SESSION['loggedid']))
{
$checkfavrecord=false;
$loggedid=implode($_SESSION['loggedid']);
if(isset($_GET['remove']))
{
$itemid=$_GET['itemid'];

$remove = "DELETE FROM favourite_item WHERE user_id='".$loggedid."' AND item_id='".$itemid."'";
if(!mysqli_query($connection, $remove))
{
die('Error: '.mysqli_error($connection));
header("Refresh:5;url=favourite.php");
echo "<font color='red'>Unable to remove the item from favourite, please try again!<br/>";
echo "You will be redirected to the favourite item page in 5 seconds<br/>";
echo "If the browser does not automatically redirect,<br/>";
echo "Click here to <a href='favourite.php'/>View</a> your favourite item!</font>";
}
else
{
	$checkfavrecord=true;
	header("Refresh:5;url=favourite.php");
	echo "<font color='red'>Item Removed!<br/>";
	echo "You will be redirected to the favourite item page in 5 seconds<br/>";
	echo "If the browser does not automatically redirect,<br/>";
	echo "Click here to <a href='favourite.php'/>View</a> your favourite item!</font>";
}
}
if(isset($_GET['submit']))
{
$itemid=$_GET['itemid'];
$bidprice=$_GET['bidprice'];

$confirmationquery="SELECT user_id FROM item WHERE item_id='".$itemid."'";
$runconfirmation=mysqli_query($connection, $confirmationquery)
or die ("Error: ".mysqli_error($connection));
$validatename=mysqli_fetch_row($runconfirmation);

$bidamount="SELECT highest_bid, status FROM item WHERE item_id='".$itemid."'";
$runbidamount=mysqli_query($connection, $bidamount)
or die ("Error: ".mysqli_error($connection));
$validateamount=mysqli_fetch_row($runbidamount);

if($validatename[0]!=$loggedid)
{
if($validateamount[0]<$bidprice)
{
if($validateamount[1]!="Inactive")
{
$updatebidquery="UPDATE item SET highest_bid='".$bidprice."', total_bid=total_bid+1 WHERE item_id='".$itemid."'";
$updatebid=(mysqli_query($connection, $updatebidquery))
or die ("Error: ".mysqli_error($connection));

$writebidrecord = "INSERT INTO bid_record (user_id, item_id, bid_price)
				   VALUES ('".$loggedid."', '".$itemid."', '".$bidprice."')";

if(!mysqli_query($connection, $writebidrecord))
{
die('Error: '.mysqli_error($connection));
header("Refresh:5;url=favourite.php");
echo "<font color='red'>Invalid Bid!<br/>";
echo "You will be redirected to the favourite item page in 5 seconds<br/>";
echo "If the browser does not automatically redirect,<br/>";
echo "Click here to <a href='bid.php'/>View</a> your favourite item again!</font>";
}
else
{
	header("Refresh:5;url=favourite.php");
	echo "<font color='red'>Item Bid!<br/>";
	echo "You will be redirected to the favourite item page in 5 seconds<br/>";
	echo "If the browser does not automatically redirect,<br/>";
	echo "Click here to <a href='favourite.php'/>Bid</a> another favourite item!</font>";
}
}
else
{
header("Refresh:5;url=favourite.php");
echo "<font color='red'>You can't place a bid that is expired!<br/>";
echo "You will be redirected to the favourite item page in 5 seconds<br/>";
echo "If the browser does not automatically redirect,<br/>";
echo "Click here to <a href='favourite.php'/>redirect</a>.</font>";
}
}
else
{
header("Refresh:5;url=favourite.php");
echo "<font color='red'>You can't place a bid that is lower than highest bid!<br/>";
echo "You will be redirected to the favourite item page in 5 seconds<br/>";
echo "If the browser does not automatically redirect,<br/>";
echo "Click here to <a href='bid.php'/>redirect</a>.</font>";
}
}
else
{
header("Refresh:5;url=favourite.php");
echo "<font color='red'>You can't bid your own item!<br/>";
echo "You will be redirected to the favourite item page in 5 seconds<br/>";
echo "If the browser does not automatically redirect,<br/>";
echo "Click here to <a href='bid.php'/>redirect</a>.</font>";
}
}
}
else
{
header("Refresh:5;url=login.php");
echo "<font color='red'>Please log in before checking your favourite item!<br/>";
echo "You will be redirected to the login page in 5 seconds<br/>";
echo "If the browser does not automatically redirect,<br/>";
echo "Click here to <a href='login.php'/>Log in</a>.</font>";
}
?>

<?php
if(isset($_SESSION['loggedid']))
{
$loggedid=implode($_SESSION['loggedid']);


$query = "SELECT item.item_name, item.item_description, category.category_name, item.post_date,
		  item.status, user.username, item.starting_price, item.highest_bid, item.total_bid, item.end_time, item.item_id
		  FROM item
		  INNER JOIN category ON item.category_id=category.category_id
		  INNER JOIN user ON item.user_id=user.user_id
		  INNER JOIN favourite_item ON item.item_id=favourite_item.item_id
		  WHERE favourite_item.user_id='".$loggedid."' AND favourite_item.item_id=item.item_id";

$runquery = mysqli_query ($connection, $query)
or die("Error: ".mysqli_error($connection));
while($row=mysqli_fetch_row($runquery))
{

$checkfavrecord=true;
//check highest bidder & time stamp
$anybid = "SELECT user_id, date_time from bid_record WHERE item_id='".$row[10]."'";
$runanybid=mysqli_query($connection, $anybid)
or die ("Error: ".mysqli_error($connection));
$trackbid=mysqli_fetch_row($runanybid);
if($trackbid==0)
{
$highestbidder="N/A";
$bidtime="N/A";
}
else
{
$highestbidder=$trackbid[0];
$bidtime=$trackbid[1];
}

echo "<form id='form".$row[10]."' name='form".$row[10]."' action='' method='get'>";
echo "<fieldset>";
echo "<table>";
$imagepathing = glob("images/".$row[10].".*");
$imagepathing = implode($imagepathing);
echo "<tr><td><img src='".$imagepathing."' alt='property".$row[10]."'/></td></tr>";
echo "<tr><td>Name: </td><td>".$row[0]."</td></tr>";
echo "<tr><td>Description: </td><td>".$row[1]."</td></tr>";
echo "<tr><td>Category: </td><td>".$row[2]."</td></tr>";
echo "<tr><td>Starting Date: </td><td>".$row[3]."</td></tr>";
echo "<tr><td>Status: </td><td>".$row[4]."</td></tr>";
echo "<tr><td>Owner: </td><td>".$row[5]."</td></tr>";
echo "<tr><td>Starting Price: </td><td>".$row[6]."</td></tr>";
echo "<tr><td>Highest Bid: </td><td>".$row[7]."</td><td>By ".$highestbidder." on ".$bidtime."</td></tr>";
echo "<tr><td>Total Bids: </td><td>".$row[8]."</td></tr>";
echo "<tr><td>Ending Date: </td><td>".$row[9]."</td></tr>";
echo "<tr><td><input type='hidden' name='itemid' value='".$row[10]."'></td></tr>";
echo "<tr><td><input type='text' size='10' id='price".$row[10]."' name='bidprice'></td>";
echo "<tr><td><input type='submit' value='Bid' id='submit' name='submit'></td></tr>";
echo "<tr><td><input type='submit' value='Remove from favourite' id='remove' name='remove'></td></tr>";
echo "</table><br/>";
echo "</fieldset>";
echo "</form>";

}

if($checkfavrecord==false)
{
header("Refresh:5;url=bid.php");
echo "<font color='red'>You currently have no favourite item!<br/>";
echo "You will be redirected to the item page in 5 seconds<br/>";
echo "If the browser does not automatically redirect,<br/>";
echo "Click here to <a href='bid.php'/>View</a>the item list!.</font>";
}
}
else
{
header("Refresh:5;url=login.php");
}
?>

    <?php //include_once("footer_template.php"); commented this out because I don't have the design file for this part yet.
	mysqli_close($connection);
	?>
</body>
</html>
