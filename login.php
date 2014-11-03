<!--after login-->
<?php include 'connect.php'; 
session_start();
//logged = boolean variable to track user's status
$_SESSION['logged']=false;
if(isset($_POST['li_submitted']))
{
$li_username=$_POST['li_username'];
$li_pwd=$POST['li_pwd'];
$li_username=trim($li_username);
$li_username=strtolower($li_username);
$li_pwd=trim($li_pwd);
$li_pwd=strtolower($li_pwd);
$query = "SELECT username, password FROM user
		  WHERE username = '".$li_username."' AND password = '".$li_pwd."'";

$login_match = mysqli_query ($connection, $query)
or die ("Error: ".mysqli_error($connection));
//check if user input matches with database data
$testlogin=false;
while($row=mysqli_fetch_array($login_match))
{
//if user enters correct username and password
$testlogin=true;
//storing the username in session
$_SESSION['loggedid']=$li_username;
//I use header to redirect user to homepage in 5 second
header("Refresh:5;url=home.php");
echo "<font color='red'>Log in successfully!<br/>";
echo "Welcome! ".$li_username."<br/>";
echo "You will be redirected to the home page in 5 seconds<br/>";
echo "If the browser does not automatically redirect,<br/>";
echo "Click here to redirect to <a href='home.php'/>home</a></font>";

}
//if user enters invalid data, redirect user to register.php
if($testlogin==false)
{
header("Refresh:5;url=register.php");
echo "<font color='red'>Invalid username or password!<br/>";
echo "You will be redirected to the register page in 5 seconds<br/>";
echo "If the browser does not automatically redirect,<br/>";
echo "Click here to <a href='register.php'/>register</a> as our member!</font>";
}
}
else
{
header("Refresh:5;url=register.php");
echo "<font color='red'>Invalid login!<br/>";
echo "You will be redirected to the register page in 5 seconds<br/>";
echo "If the browser does not automatically redirect,<br/>";
echo "Click here to <a href='register.php'/>register</a> as our member!</font>";
}

mysqli_close($connection);
?>
