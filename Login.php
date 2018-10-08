
<?php
require_once("include/DB.php");
?>
<?php
require_once("Include/Sessions.php");
require_once("Include/Functions.php");
?>

<?php
if(isset($_POST['Submit'])){
	$UserName= mysqli_real_escape_string($Connection,$_POST["UserName"]);
	$Password= mysqli_real_escape_string($Connection,$_POST["Password"]);
	

	

	  if(empty($UserName)||empty($Password)){
	  $_SESSION['ErrorMessage']= "All fields must be filled out";
			Redirect_to("Login.php");
				}else{
				$foundAccount=Login_Attempt($UserName,$Password);
				$_SESSION['user_id']=$foundAccount['id'];
				$_SESSION['user_name']=$foundAccount['username'];
				if($foundAccount){
					
			$_SESSION['SuccessMessage']="Welcome {$_SESSION['user_name']}";
			Redirect_to('dashboard.php');

				}
					
			$_SESSION['ErrorMessage']="UserName / Password invalid . Try again!";
			Redirect_to('Login.php');
				}
			
	
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/adminstyle.css">
	<link href='https://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Atomic Age' rel='stylesheet'>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href='https://fonts.googleapis.com/css?family=Allerta Stencil' rel='stylesheet'>
<style type="text/css">
	.field_info{
	
	font-style: italic;
	font-size:18px !important;
	font-family: 'Allerta Stencil';
	color: white;

}
#logo{
			transition: transform 1s;
		}

		#logo:hover{
			transform: scale(1.5);
		}
		#_logo{
	color: white;
	font-style: italic;
margin-left: 490px;
	font-family:  'Atomic Age';
	
	margin-top: 0px;
}


.navbar-nav li{
		font-style: italic;
	color: white;
	font-size: 18px;
	font-family:'Almendra'; 
}

.nav-item{
padding-right: 25px;
}

.line{
	margin-top: -20px;
}

.parallax_2 { 
    /* The image used */
    background-image: url("images/minimal_poster.jpg");

    /* Set a specific height */
    height: 500px; 

    /* Create the parallax scrolling effect */
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.title{
	font-style: italic;
	color: white;
	font-size: 34px;
	font-family:'Atomic Age'; 
	text-align: center;
	text-decoration: underline;
}
</style>	  
</head>

<body class="parallax_2">
	<div style="height: 15px; background: #008B8B; border:2px solid black;"></div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark ">

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
		<span class="sr-only">Toggle Navigation</span>
	 <span class="navbar-toggler-icon"></span>

	</button>
  <!-- Brand/logo -->
  <a class="navbar-brand" href="#"><img  id="logo" src="images/logo.png" style="height: 80px; margin-top: -25px;">	</a>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
  <!-- Links -->
  <h1 id="_logo">Arete</h1>

</nav>
<div class="line" style="height: 15px; background: #008B8B; border:2px solid black;"></div>
	<div style="margin-top:50px;" class="container-fluid content" >
		<div class="row" >
			
			<div class="col-sm-offset-4 col-sm-4">
				<h1 class="title">Login Page</h1>
				<div>
					<?php  
						echo Message();
						echo SuccessMessage();
					?>
				</div>
				<div style="margin-top:50px;">
					<form action="Login.php" method="Post">
						<fieldset>
							<div class="form-group">
								 
							<label for="UserName"><span class="field_info">User Name:</span></label>
							<div class="input-group input-group-lg">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user text-primary"></i></span>
							<input class="form-control" type="text" name="UserName" id="UserName" placeholder="User Name">
							</div>
							</div>    
								<label for="Password"><span class="field_info">Password:</span></label>
								<div class="form-group">
								 <div class="input-group  input-group-lg">
								  <span class="input-group-addon"><i class="glyphicon glyphicon-lock text-primary"></i></span>
								<input class="form-control" type="Password" name="Password" id="Password" placeholder="Password">
							</div>
							</div>
							
							<input style="margin-top: 50px;" class="btn btn-primary btn-lg btn-block" type="Submit" name="Submit" value="Login">
						</fieldset>
					</form>
				</div>

				
			</div>
		</div>
	</div>


	

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>