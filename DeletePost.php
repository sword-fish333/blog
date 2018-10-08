<?php
require_once("Include/DB.php");
require_once("Include/Sessions.php");
require_once("Include/Functions.php"); 
?>

<?php 

GLOBAL $Connection;
$urlId=$_GET['delete'];
$query="DELETE FROM admin_panel WHERE id='$urlId'";
$execute=mysqli_query($Connection,$query);
if($execute){
	$_SESSION['SuccessMessage']="Post deleted succesfully";
	Redirect_to('dashboard.php');
}else{
	$_SESSION['ErrorMessage']="Somthing went wrong try again";
	Redirect_to('dashboard.php');
}
?>