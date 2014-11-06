<!--after recovery-->
<?php include 'connect.php';
$recovery_email=$_POST['recovery_email'];

$query = "SELECT email, username FROM user WHERE email = '".$recovery_email."'";
$recovery_match=mysqli_query($connection, $query)
or die ("Error: ".mysqli_error($connection));
$testrecovery=false;
while($row=mysqli_fetch_array($recovery_match))
{
$testrecovery=true;
$newpwd=rand(100000, 999999);
$query2 = "UPDATE user SET password='".$newpwd."' WHERE username='".$row[1]."'";
$reset_pwd=(mysqli_query($connection, $query2))
or die ("Error: ".mysqli_error($connection));
mail($row[0], "BidMe Recovery", "Your Account ".$row[1]." has reset its password to ".$newpwd.". Please change your password as soon as possible.");
echo "An email has been set to ".$row[0].". Please retrieve your latest password. ";
}
if($testrecovery==false)
{
header("Refresh:5;url=login.html");
echo "<font color='red'>Invalid Email Address!<br/>";
echo "You will be redirected to the login page in 5 seconds<br/>";
echo "If the browser does not automatically redirect,<br/>";
echo "Click here to <a href='login.html'/>Login</a> !</font>";
}
mysqli_close($connection);
?>
