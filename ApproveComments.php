<?php 
require_once("Include/DB.php");
require_once("Include/Functions.php");
require_once("Include/Sessions.php");
?>

<?php
$Connection;

$urlId=$_GET['id'];
$query="UPDATE comments SET status='ON' WHERE id='$urlId'";
$execute=mysqli_query($Connection,$query);

if($execute){
	$_SESSION['SuccessMessage']="Comment updated succesfully";
	Redirect_to('Comments.php');
}else{
	$_SESSION['ErrorMessage']="Somthing went wrong.Please try again!";
	Redirect_to('Comments.php');
}

?>