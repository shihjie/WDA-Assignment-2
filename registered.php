<!--After register-->
<?php include 'connect.php';
$username=$_POST['username'];
$password=$_POST['pwconfirm'];
$email=$_POST['email'];
$number=$_POST['number'];
$paymentmethod=$_POST['paymentmethod'];
$accno=$_POST['accno'];

$query = "INSERT INTO user (username, password, email, number, paymentmethod, accno)
		  VALUES ('".$username."', '".$password."', '".$email."', '".$number."', '".$paymentmethod."', '".$accno."')";

if(!mysqli_query($connection, $query))
{
die('Error: '.mysqli_error($connection));
header("Refresh:5;url=register.php");
echo "<font color='red'>Invalid Submission!<br/>";
echo "You will be redirected to the register page in 5 seconds<br/>";
echo "If the browser does not automatically redirect,<br/>";
echo "Click here to <a href='register.php'/>register</a> as our member!</font>";
}
else
{
header("Refresh:5;url=home.php");
echo "	Thank you for registering!<br/>";
echo "If the browser doesn't redirect you to home after 5 seconds,<br/>";
echo "Click here to return to the <a href='home.php'/>Home Page</a>";
}


mysqli_close($connection);
?>
