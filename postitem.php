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
<option value=""></option>
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
