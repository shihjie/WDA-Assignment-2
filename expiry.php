<?php
$checkexpiry = "SELECT end_time from item";

$expquery = mysqli_query ($connection, $checkexpiry)
or die("Error: ".mysqli_error($connection));
while($exprow=mysqli_fetch_row($expquery))
{
if((date("Y-m-d h:i:sa"))<$exprow[0])
{
$expstatus="UPDATE item SET status ='Inactive'";
$updatestatus=(mysqli_query($connection, $expstatus))
or die ("Error: ".mysqli_error($connection));
}

}
?>
