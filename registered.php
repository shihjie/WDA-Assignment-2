<!--After register-->
<?php include 'connect.php';
$username=$_POST['username'];
$password=$_POST['pwconfirm'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$email=$_POST['email'];
$address=$_POST['address'];
$number=$_POST['number'];
$securityquestion=$_POST['securityquestion'];
$securityanswer=$_POST['securityanswer'];
$rating=0.3;
date_default_timezone_set("Asia/Kuala_Lumpur");
$register_date=date("Y-m-d");

$query = "INSERT INTO user (first_name, last_name, username, password, email, address, phone_number, rating, register_date)
		  VALUES ('".$fname."', '".$lname."', '".$username."', '".$password."', '".$email."', '".$address."', '".$number."', '".$rating."', '".$register_date."')";
		  
$query2 = "INSERT INTO recovery (secret_question, secret_answer) VALUES ('".$securityquestion."', '".$securityanswer."')";

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
if(!mysqli_query($connection, $query2))
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
}


mysqli_close($connection);
?>
