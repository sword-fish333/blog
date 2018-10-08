<?php
require_once("include/DB.php");

require_once("Include/Sessions.php");

function Redirect_to($New_location){
	  header("Location:".$New_location);
	  exit;

}

function Login_Attempt($UserName,$Password){
	GLOBAL $Connection;
	$query="SELECT * FROM registration WHERE username='$UserName' AND password='$Password'";
	$execute=mysqli_query($Connection,$query);
	if($data=mysqli_fetch_assoc($execute)){
		return $data;
	}else{
		return null;
	}
}

function Login(){
	if(isset($_SESSION['user_id'])) {
		return true;
	}
}

function Confirm_Login(){
	if(!Login()){
		$_SESSION['ErrorMessage']="Login required";
		Redirect_to('Login.php');
	}
}
?>