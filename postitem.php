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
?>

<form id="postitem" enctype="multipart/form-data" name="postitem" action="storeitem.php" method="post">
<table align=center border=0 cellpadding=5px>
<tr>
<td>Item name:</td>
<td><input type="text" size="20" maxlength="20" name="iname"></td>
</tr>
<tr>
<td>Item description:</td>
<td><input type="text" size="60" maxlength="60" name="idesc"></td>
</tr>
<tr>
<td>Category:</td>
<td>
<select name="category">
<option value="collectible">Collectibles & Art</option>
<option value="electronic">Electronics</option>
<option value="entertainment">Entertainment</option>
<option value="fashion">Fashion</option>
<option value="garden">Home & Garden</option>
<option value="motor">Motors</option>
<option value="sport">Sporting Goods</option>
<option value="toy">Toys & Hobbies</option>
<option value="other">Others</option>
</select>
</td>
</tr>
<tr>
<td>Starting price:</td>
<td><input type="number" size="10" maxlength="10" name="sprice"></td>
</tr>
<tr>
<td>End time:</td>
<td><input type="date" name="endtime"></td>
</tr>
<tr>
<td>Image for item:</td>
<td> <input type="file" id="uploadimage" name="uploadimage" accept="image/*" ></td>
</tr>
<tr>
<td colspan="2">
<input type="submit" value="Post">
</td>
</tr>
</table>
</form>
<?php
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

    <?php //include_once("footer_template.php"); commented this out because I don't have the design file for this part yet.
	mysqli_close($connection);
	?>
</body>
</html>
