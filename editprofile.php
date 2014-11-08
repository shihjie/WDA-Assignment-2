<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<?php
  include_once("htmlhead_template.php");
 include_once("connect.php")
?>

</head>

<body>
<div class = "container" id="container"><!-- container makes everything stick to middle -->
 <?php include_once("navbar_template.php");	  
	

if(isset($_SESSION['loggedid']))
{
$loggedid=$_SESSION['loggedid'];
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
$loggedid=$_SESSION['loggedid'];
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

?>
<!--change first name-->
<div class ="row" id="post">
    <div class="col-sm-10">
    <div class="panel panel-info">
   
    <div class= "panel-body">
    
    
<form id="fnameform" name="fnameform" action="" method="get" onclick="">
<fieldset>
<legend> <?php echo "<h2><span class='label label-info'>".$_SESSION['username']."'s Profile</span></h2>";
?></legend>


<table width="941" >
<tr>
<td width="200"><label>First Name</label></td>
<td >&nbsp;

</td>
<td width="77">&nbsp;</td><td width="404"><div align="right" style="margin-top:0px"><a href="change_password.php">Change password</a></div></td>
</tr>
<tr>
<td>
<?php
echo $tempfname;
?>
</td>
<?php if(isset($_GET['change'])){?>
<td >
<input type="text" id="fname" name="fname" style="width:250px" maxlength="30" class="form-control">
</td><td><input type="submit" value="Change" id="change_fname" name="change_fname"  class="btn btn-primary">
</td>
<?php }?>
</tr>
</table>
</fieldset>
</form>
<hr/>
<!--change last name-->
<form id="lnameform" name="lnameform" action="" method="get">
<fieldset>
<table border="0">
<tr>
<td width="200px"><label>Last Name</label></td><td width="200px">&nbsp;

</td>

</tr>
<tr>
<td>
<?php
echo $templname;
?>
</td>

<?php if(isset($_GET['change'])){?>
<td>
<input type="text" id="lname" name="lname" size="30" maxlength="30" class="form-control" style="width:250px">
</td>
<td>
<input type="submit" value="Change" id="change_lname" name="change_lname" class="btn btn-primary" style="margin-left:8px">
</td>
<?php }?>
</tr>
</table>
</fieldset>
</form>
<hr/>
<!--change address name-->
<form id="addressform" name="addressform" action="" method="get">
<fieldset>
<table border="0">
<tr>
<td width="200px"><label>Address</label></td>
<td>&nbsp;

</td>

</tr>
<tr>
<td>
<?php
echo $tempadd;
?>
</td>
<?php if(isset($_GET['change'])){?>
<td>
<textarea id="address" name="address" size="50" maxlength="50" class="form-control" style="width:250px"></textarea>
</td>
<td>
<input type="submit" value="Change" id="change_address" name="change_address" class="btn btn-primary" style="margin-left:8px">
</td>
<?php }?>
</tr>
</table>
</fieldset>
</form>
<hr/>
<!--change number-->
<form id="numberform" name="numberform" action="" method="get">
<fieldset>
<table border="0">
<tr>
<td width="200px"><label>Mobile Number</label></td>
<td>&nbsp;

</td>

</tr>
<tr>
<td>
<?php
echo $tempnum;
?>
</td>
<td><?php if(isset($_GET['change'])){?>
<input type="text" id="number" name="number" size="10" maxlength="10" class ="form-control" style="width:250px">
</td>
<td>
<input type="submit" value="Change" id="change_number" name="change_number" class="btn btn-primary" style="margin-left:8px"><?php }?>
</td>
</tr>
</table>
</fieldset>
</form>
<br/><form id="edit" name="edit" action="" method="get">
<?php if(!(isset($_GET['change']))){?>
<input type="submit" class="btn btn-primary" value="Edit Profile" id="change" name="change" /> 
</form><?php }?>



                   

<?php
}
else
{
header("Location:login.php");
}
?>
    <?php 
	mysqli_close($connection);
	?>
</div><!-- end of panel body -->
    </div><!-- end of panel warning-->
    </div><!-- end of sm-->
	</div><!-- end of row -->
    

</div><!-- end of container -->
  <?php include_once("footer_template.php");?>


</body>
</html>
