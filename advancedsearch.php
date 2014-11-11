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
?>
 <form id="asform" name="asform" action="searchresult.php" method="get">
 <fieldset>
 <table>
 <tr>
 <td>Item Name</td>
 <td><input type="text" id="asname" name="asname" size="30" maxlength="30"></td>
 </tr>
 <tr>
 <td>Item Description</td>
 <td><input type="text" id="asdesc" name="asdec" size="50" maxlength="50"></td>
 </tr>
 <tr>
 <td>Category</td>
 <td><select name="ascategory">
<option value="collectible">Collectibles & Art</option>
<option value="electronic">Electronics</option>
<option value="entertainment">Entertainment</option>
<option value="fashion">Fashion</option>
<option value="garden">Home & Garden</option>
<option value="motor">Motors</option>
<option value="sport">Sporting Goods</option>
<option value="toy">Toys & Hobbies</option>
<option value="other">Others</option>
</select></td>
 </tr>
 <tr>
 <td>Current highest bid is less than</td>
 <td><input type="number" id="asprice" name="asprice" size="10" maxlength="10"></td>
 </tr>
 <tr>
 <td><input type="submit" value="Search" id="as_submit" name="as_submit"></td>
 </tr>
 </table>
 </fieldset>
 </form>
    <?php //include_once("footer_template.php"); commented this out because I don't have the design file for this part yet.
		mysqli_close($connection);
	?>
</body>
</html>
