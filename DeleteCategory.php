<?php
require_once("Include/DB.php");
require_once("Include/Sessions.php");
require_once("Include/Functions.php");
?>

<?php
GLOBAL $Connection;
$urlId=$_GET['id'];
$query="DELETE  FROM category WHERE id='$urlId'";
$execute=mysqli_query($Connection,$query);
if($execute){
	$_SESSION['SuccessMessage']="Category deleted succesfully";
	Redirect_to('Categories.php');
}else{
	$_SESSION['ErrorMessage']="Somthing went wrong , try again!";
	Redirect_to('Categories.php');
}

?>