<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
  include_once("htmlhead_template.php");
	include_once("connect.php");
?>

</head>

<body>
<?php session_start(); ?>
<?php if(isset($_POST['submit'])){
	 $username=$_POST['username'];
	$password=$_POST['pwconfirm'];
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$email=$_POST['email'];
	$address=$_POST['address'];
	$number=$_POST['number'];
	$securityquestion=$_POST['securityquestion'];
	$securityanswer=$_POST['securityanswer'];
	$rating=5;
	date_default_timezone_set("Asia/Kuala_Lumpur");
	$register_date=date("Y-m-d");
	$testRegister=true;
	$stringMsg;
	$usernameCheck = mysqli_query($connection,"SELECT username FROM user WHERE username='".$_POST['username']."'");
	$emailCheck = mysqli_query($connection,"SELECT email FROM user WHERE email='".$_POST['email']."'");	
	
	//username check
	if(mysqli_num_rows($usernameCheck) >0){
            $testRegister=false;
			$stringMsg = array("- Sorry the username has been used, please pick another.");
			if(mysqli_num_rows($emailCheck) >0){
             $testRegister=false;
			 array_push($stringMsg, "- Sorry the email has been used, please pick another.");
        }
        }
	
	//email check
	else if(mysqli_num_rows($emailCheck) >0){
             $testRegister=false;
			 $stringMsg=array("- Sorry the email has been used, please pick another.");
        }
	
	//if username and email ok
	else{
	$query = "INSERT INTO user (first_name, last_name, username, password, email, address, phone_number, rating, register_date) VALUES ('".$fname."', '".$lname."', '".$username."', '".$password."', '".$email."', '".$address."', '".$number."', '".	$rating."', '".$register_date."')";
		  
	


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
{	$getid = "SELECT user_id FROM user WHERE username = '" .$username."'";

	if(!($result= mysqli_query($connection, $getid)))
		die('Error: '.mysqli_error($connection));

	$row = mysqli_fetch_array($result);
	$query2 = "INSERT INTO recovery (user_id, secret_question, secret_answer) VALUES ('".$row['user_id']."','".$securityquestion."', '".$securityanswer."')";
	
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
header("Location: registered.php");
}
}

	}
}?>
    
<div class = "container" id="container"><!-- container makes everything stick to middle -->
<?php include_once("navbar2_template.php");?>

    
<?php if(isset($_SESSION['username'])){ ?>
		<div class = "page_error">
        <h2>Sorry, you had already logged in. Please log out to register. Redirecting back to home page...</h2> 
        </div><!-- end of page_error -->
        <?php header( "refresh:5; url=index.php" ); }?>

<?php  if(!(isset($_SESSION['username']))){?>   
		
        <div class="row" id="register">
		<div class="col-sm-1"></div>
        <div class="col-sm-7">
        <div class="panel success">
        <div class="panel-body">
        <form id="register" name="register" onsubmit="" action="" method="post" role="form">
           <fieldset>
<legend><h3><label>Register New Account</label></h3></legend>

<?php if ((isset($_POST['submit']))){
   			if ($testRegister == false){?>
		<div class="alert alert-warning" role="alert"><?php 
		$arrlength=count($stringMsg);
		for($x=0;$x<$arrlength;$x++) {
  			echo $stringMsg[$x];
  			echo "<br>";
}
		?></div>
        
       
		
		
		
<?php		}}?>  
<div class="form-group">
	<table>
    <tr><td width="320px"><label>First Name</label></td><td><label>Last Name</label></td></tr>
    <tr><td><input type="text" class="form-control" placeholder="first name" id="fname" name="fname" style="width:300px" value="<?php if (isset($fname)) echo $fname; ?>"></td>
    <td><input type="text" class="form-control" placeholder="last name" id="lname" name="lname" style="width:300px" value="<?php if (isset($lname)) echo $lname; ?>"></td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td><label>Email</label></td><td><label>Mobile No</label></tr>
    <tr><td><input type="text" class="form-control" placeholder="Email" id="email" name="email" style="width:300px"></td>
    <td><input type="text" class="form-control" placeholder="Mobile no" id="number" name="number" style="width:300px" value="<?php if (isset($number)) echo $number; ?>"></td></tr>
    
    <tr><td>&nbsp;</td></tr>
   	<tr><td><label>Username</label></td></tr>
    <tr><td><input type="text" class="form-control" placeholder="username" id="username"  name="username" style="width:300px"></td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td><label>Password</label></td><td><label>Confirm Password</label></td></tr>
    <tr><td><input type="password" class="form-control" placeholder="password" id="password" name="password" style="width:300px" ></td>
    <td><input type="password" class="form-control" placeholder="Confirm password" id="pwconfirm" name="pwconfirm" style="width:300px" ></td></tr>
    <tr><td>&nbsp;</td></tr>
    
    <tr>
    <td><label>House Address</label></td></tr>
    <tr>
    <td rowspan="2"><textarea class="form-control" rows="3"  placeholder="address" id="address" name="address" style="width:300px" value="<?php if (isset($address)) echo $address; ?>"></textarea></td></tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
        <tr>
      <td>&nbsp;</td>
    </tr>
      <tr>
      <td><u>Account recovery question</u></td>
    </tr>
    <tr><td><label>Secret Question</label></td><td><label>Secret Asnwer</label></td></tr>
    <tr><td><select class="selectpicker" style="height:38px" name="securityquestion" id="securityquestion" value="<?php if (isset($securityquestion)) $securityquestion; ?>"><option value="favcolor">What is your favourite colour?</option>
<option value="elementaryschool">What is the name of your first school?</option>
<option value="petname">What is your pet's name?</option>
<option value="nickname">What is your nickname?</option>
<option value="bestfren">What is the name of your bestfriend?</option>
</select></td><td><input type="text" class="form-control" placeholder="Secret answer" id="securityanswer" name="securityanswer" style="width:300px" ></td></tr>
  <tr>
      <td>&nbsp;</td>
    </tr>
    <tr><td><input type="submit" class="btn btn-primary" value="Submit" style="width:200px;height:50px;" name="submit" id="submit" /> </td></tr>
    
    </table>
    </div>
    </fieldset>
       </form> 
   </div>   <!-- end of panel body -->  
</div><!-- end of panel primary -->
</div><!-- end of col-sm-8 -->

<div class= "col-sm-3">
<div class="panel panel-primary">
<div class="panel-body">
<div class= "signin_box">
    <h4>Already have an account? </h4>
     <a href="login.php"><input type="submit" class="btn btn-warning btn-lg" value="Sign in" /> </a>
  </div>
  </div>
</div><!-- end of panel primary -->
</div><!-- end of col sm 2 -->
</div><!-- end of row class -->

</div><!-- end of container-->

 <div class = "footer_space">
    <?php include_once("footer_template.php"); 
	mysqli_close($connection);
	}?>
    </div>
</body>
</html>
