<!--register page-->
<form id="register" name="register" onsubmit="return validateForm()" action="registered.php" method="post">
<table align=center border=0 cellpadding=5px>
<tr>
<td>Username</td>
<td><input type="text" size="15" maxlength="15" name="username" onkeyup="checkAvail()"></td>
<!--I will add a availability checker later-->
</tr>
<tr>
<td>Password</td>
<td><input type="password" size="15" maxlength="15" name="password"></td>
</tr>
<tr>
<td>Password Confirmation</td>
<td><input type="password" size="15" maxlength="15" name="pwconfirm"></td>
<!--Also password confirmation-->
</tr>
<tr>
<td>First Name</td>
<td><input type="text" size="15" maxlength="15" name="fname"></td>
</tr>
<tr>
<td>Last Name</td>
<td><input type="text" size="15" maxlength="15" name="lname"></td>
</tr>
<tr>
<td>Email Address</td>
<td><input type="text" size="30" maxlength="30" name="email"></td>
</tr>
<tr>
<td>Address</td>
<td><input type="text" size="50" maxlength="50" name="address"></td>
</tr>
<tr>
<td>Contact Number</td>
<td><input type="text" size="15" maxlength="15" name="number"></td>
</tr>
<tr>
<td>Security Question</td>
<td>
<select name="securityquestion">
<option value="favcolor">What is your favourite colour?</option>
<option value="elementaryschool">What is the name of your elementary/primary school?</option>
<option value="petname">What is your pet's name?</option>
<option value="nickname">What is your nickname?</option>
<option value="bestfren">What is the name of your bestfriend?</option>
</select>
</td>
</tr>
<tr>
<td>Security Answer</td>
<td><input type="text" size="20" maxlength="20" name="securityanswer"></td>
</tr>
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
