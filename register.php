<!--register page-->
<form id="register" name="register" onsubmit="return validateForm()" action="registered.php" method="post">
<table align=center border=0 cellpadding=5px>
<tr>
<td>Username</td>
<td><input type="text" size="15" maxlength="15" name="username"></td>
<!--I will add a availability checker later-->
</tr>
<tr>
<td>Password</td>
<td><input type="password" size="15" maxlength="15" name="password"></td>
</tr>
<tr>
<td>Password Confirmation</td>
<td><input type="text" size="15" maxlength="15" name="pwconfirm"></td>
<!--Also password confirmation-->
</tr>
<tr>
<td>Email Address</td>
<td><input type="text" size="30" maxlength="30" name="email"></td>
</tr>
<tr>
<td>Contact Number</td>
<td><input type="text" size="15" maxlength="15" name="number"></td>
</tr>
<tr>
<td>Payment Method</td>
<td>
<select name="paymentmethod">
<option value="visa">Visa</option>
<option value="master">Master Card</option>
<option value="a_ex">American Express</option>
</select>
</td>
</tr>
<tr>
<td>Account Number</td>
<td><input type="text" size="15" maxlength="15" name="accno"></td>
</tr>
<tr>
<td colspan="2">
<input type="checkbox" name="t_s"> I Agree to the <a href="terms.php">Terms and conditions</a>
</td>
</tr>
<tr>
<td>
<input type="submit" value="Register"><a href="home.php"><input type="button" value="Cancel"></a>
</td>
</tr>
</table>
</form>
