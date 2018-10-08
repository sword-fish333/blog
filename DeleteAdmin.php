<?php
require_once("Include/DB.php");
require_once("Include/Sessions.php");
require_once("Include/Functions.php");
?>

<?php
GLOBAL $Connection;
$urlId=$_GET['id'];
$query="DELETE  FROM registration WHERE id='$urlId'";
$execute=mysqli_query($Connection,$query);
if($execute){
	$_SESSION['SuccessMessage']="Admin deleted succesfully";
	Redirect_to('Admins.php');
}else{
	$_SESSION['ErrorMessage']="Somthing went wrong , try again!";
	Redirect_to('Admins.php');
}

?>