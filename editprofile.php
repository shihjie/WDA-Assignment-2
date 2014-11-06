<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php //include_once("html_head_template.php");commented this out because I don't have the design file for this part yet.
?>
</head>
<body>
<?php include_once("connect.php");
session_start();
if(isset($_SESSION['loggedid']))
{
$loggedid=implode($_SESSION['loggedid']);
if(isset($_GET['change_fname']))
{
$fname=$_GET['fname'];

$fnamequery="UPDATE user SET first_name='".$fname."' WHERE user_id='".$loggedid."'";
$updatefname=(mysqli_query($connection, $fnamequery))
or die ("Error: ".mysqli_error($connection));

}
else
{
if(isset($_GET['change_lname']))
{
$lname=$_GET['lname'];

$lnamequery="UPDATE user SET last_name='".$lname."' WHERE user_id='".$loggedid."'";
$updatelname=(mysqli_query($connection, $lnamequery))
or die ("Error: ".mysqli_error($connection));

}
else
{
if(isset($_GET['change_address']))
{
$address=$_GET['address'];

$addressquery="UPDATE user SET address='".$address."' WHERE user_id='".$loggedid."'";
$updatelname=(mysqli_query($connection, $addressquery))
or die ("Error: ".mysqli_error($connection));

}
else
{
if(isset($_GET['change_number']))
{
$number=$_GET['number'];

$numberquery="UPDATE user SET phone_number='".$number."' WHERE user_id='".$loggedid."'";
$updatelname=(mysqli_query($connection, $numberquery))
or die ("Error: ".mysqli_error($connection));

}
}
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

?>

<?php 
if(isset($_SESSION['loggedid']))
{
$loggedid=implode($_SESSION['loggedid']);
$tempfname;
$templname;
$tempadd;
$tempnum;
$query = "SELECT first_name, last_name, address, phone_number FROM user 
		  WHERE user_id='".$loggedid."'";
$display=mysqli_query($connection, $query)
or die ("Error: ".mysqli_error($connection));
while($row=mysqli_fetch_array($display))
{
$tempfname=$row[0];
$templname=$row[1];
$tempadd=$row[2];
$tempnum=$row[3];
}
echo "<h1>".$_SESSION['loggedname']."'s Profile</h1>";
?>
<!--change first name-->
<form id="fnameform" name="fnameform" action="" method="get">
<fieldset>
<table border="0">
<tr>
<td>First Name</td>
<td>
<?php
echo $tempfname;
?>
</td>
</tr>
<tr>
<td>
<input type="text" id="fname" name="fname" size="30" maxlength="30">
</td>
<td>
<input type="submit" value="Change" id="change_fname" name="change_fname">
</td>
</tr>
</table>
</fieldset>
</form>
<br/>
<!--change last name-->
<form id="lnameform" name="lnameform" action="" method="get">
<fieldset>
<table border="0">
<tr>
<td>Last Name</td>
<td>
<?php
echo $templname;
?>
</td>
</tr>
<tr>
<td>
<input type="text" id="lname" name="lname" size="30" maxlength="30">
</td>
<td>
<input type="submit" value="Change" id="change_lname" name="change_lname">
</td>
</tr>
</table>
</fieldset>
</form>
<br/>
<!--change address name-->
<form id="addressform" name="addressform" action="" method="get">
<fieldset>
<table border="0">
<tr>
<td>Address</td>
<td>
<?php
echo $tempadd;
?>
</td>
</tr>
<tr>
<td>
<input type="text" id="address" name="address" size="50" maxlength="50">
</td>
<td>
<input type="submit" value="Change" id="change_address" name="change_address">
</td>
</tr>
</table>
</fieldset>
</form>
<br/>
<!--change number-->
<form id="numberform" name="numberform" action="" method="get">
<fieldset>
<table border="0">
<tr>
<td>Number</td>
<td>
<?php
echo $tempnum;
?>
</td>
</tr>
<tr>
<td>
<input type="text" id="number" name="number" size="10" maxlength="10">
</td>
<td>
<input type="submit" value="Change" id="change_number" name="change_number">
</td>
</tr>
</table>
</fieldset>
</form>
<br/>
<?php
}
else
{
header("Refresh:5;url=login.html");
}
?>
    <?php //include_once("footer_template.php"); commented this out because I don't have the design file for this part yet.
	mysqli_close($connection);
	?>
</body>
</html>
