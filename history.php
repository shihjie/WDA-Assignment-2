<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
  include_once("htmlhead_template.php");
  include_once("connect.php");
  include_once("expiry.php");
  session_start();
   if ((isset($_SESSION['loggedid']))){
   $checkhistory=false;
$loggedid=$_SESSION['loggedid'];
if(isset($_GET['clear']))
{
$itemid=$_GET['itemid'];
$clear = "DELETE FROM bid_record WHERE user_id='".$loggedid."' AND item_id='".$itemid."'";
if(!mysqli_query($connection, $clear))
{
die('Error: '.mysqli_error($connection));
}
else
{
	$checkhistory=true;
}
}
if(isset($_GET['up']))
{
$userid=$_GET['userid'];
$thumbsupquery="UPDATE user SET rating=rating+1 WHERE user_id='".$userid."'";
$uprating=(mysqli_query($connection, $thumbsupquery))
or die ("Error: ".mysqli_error($connection));
}
if(isset($_GET['down']))
{
$userid=$_GET['userid'];
$thumbsdownquery="UPDATE user SET rating=rating-1 WHERE user_id='".$userid."'";
$downrating=(mysqli_query($connection, $thumbsdownquery))
or die ("Error: ".mysqli_error($connection));
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
   
   </head>

<body>
<div class = "container" id="container"><!-- container makes everything stick to middle -->

<?php include_once("navbar2_template.php");?>
<div class= "middleSpace">

 <div class ="row">
  <div class="col-sm-1"></div>
  <div class="col-sm-10">
  <div class="panel panel-info">
  <div class="panel-heading">Favourite Item</div>
  <div class="panel-body">
  <?php
if(isset($_SESSION['loggedid']))
{
$loggedid=$_SESSION['loggedid'];


$query = "SELECT item.item_name, item.item_description, category.category_name, item.post_date,
		  item.status, user.username, item.starting_price, item.highest_bid, item.total_bid, item.end_time, item.item_id, user.user_id
		  FROM item
		  INNER JOIN category ON item.category_id=category.category_id
		  INNER JOIN user ON item.user_id=user.user_id
		  INNER JOIN bid_record ON item.item_id=bid_record.item_id
		  WHERE bid_record.user_id='".$loggedid."' AND bid_record.item_id=item.item_id AND item.status='Inactive' AND bid_record.bid_price=item.highest_bid";

$runquery = mysqli_query ($connection, $query)
or die("Error: ".mysqli_error($connection));
while($row=mysqli_fetch_row($runquery))
{
$checkhistory=true;
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
echo "<tr><td>Highest Bid: </td><td>".$row[7]."</td></tr>";
echo "<tr><td>Total Bids: </td><td>".$row[8]."</td></tr>";
echo "<tr><td>Ending Date: </td><td>".$row[9]."</td></tr>";
echo "<tr><td><input type='hidden' name='itemid' value='".$row[10]."'></td></tr>";
echo "<tr><td><input type='hidden' name='userid' value='".$row[11]."'></td></tr>";
echo "<tr><td>Rate the owner: </td><td><button type='submit' id='up' name='up' class='btn btn-warning'><span class='glyphicon glyphicon-thumbs-up'></span></button></td>";
echo "<td><button type='submit' id='down' name='down' class='btn btn-warning'><span class='glyphicon glyphicon-thumbs-down'></span></button></td></tr>";
echo "<tr><td><button type='submit' id='clear' name='clear' class='btn btn-warning'><span class='glyphicon glyphicon-trash'> remove from history</span></button></td></tr>";
echo "</table><br/>";
echo "</fieldset>";
echo "</form>";

}

if($checkhistory==false)
{
echo "<font color='red'><b>Your bid history is empty!</b><br/>";
}
}
else
{
header("Refresh:5;url=login.php");
}
?>
  
  
  
  </div><!-- end of panel-body -->
  </div><!-- end of panel-info -->
  </div><!-- end of colsm5 -->
  </div><!-- end of row -->
</div><!-- end of middle space -->
 </div><!-- end of container -->
 <?php include_once("footer_template.php"); 
 	mysqli_close($connection);
	?>
</body>
</html>
   
   
