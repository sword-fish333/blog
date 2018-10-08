<?php
require_once("Include/Sessions.php");
require_once("Include/Functions.php");

$_SESSION['user_id']=null;
session_destroy();
Redirect_to("Login.php");
?>