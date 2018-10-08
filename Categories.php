
<?php
require_once("include/DB.php");
?>
<?php
require_once("Include/Sessions.php");
require_once("Include/Functions.php");
?>

<?php
if(isset($_POST['Submit'])){
	$Category= mysqli_real_escape_string($Connection,$_POST["Category"]);

	date_default_timezone_set("Europe/Bucharest");
 	$curentTime=time();
	 $time=strftime("%B-%d-%Y--/--%H:%M:%S",$curentTime);
	  $time;
	  $Admin="Alin Ghiurca";

	  if(empty($Category)){
	  $_SESSION['ErrorMessage']= "All fields must be filled out";
			Redirect_to("Categories.php");
	}elseif(strlen($Category)>99){
	 $_SESSION['ErrorMessage']= "The name is to long";
			Redirect_to("Categories.php");

		}else{
		global $Connection;
		$query="INSERT INTO category(datetime,name,creatorname) VALUES('$time','$Category','$Admin')";
		$execute=mysqli_query($Connection,$query);

		if($execute){
		$_SESSION['SuccessMessage']="Category added succesfully";
		Redirect_to("Categories.php");
	}else{
	$_SESSION['ErrorMessage']="Category failed to add";
	Redirect_to("Categories.php");
			}
	}
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Manage Categories</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/adminstyle.css">
	<link href='https://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href='https://fonts.googleapis.com/css?family=Allerta Stencil' rel='stylesheet'>
<style type="text/css">
	.field_info{
	
	font-style: italic;
	font-size:18px !important;
	font-family: 'Allerta Stencil';
	color: 	#A52A2A;

}
#logo{
			transition: transform 1s;
		}

		#logo:hover{
			transform: scale(1.5);
		}
		#side_logo{
	color: white;
	font-style: italic;
	font-family:  'Atomic Age';
	 transition: transform 1s;
	margin-top: 0px;
}

#side_logo:hover{
	 transform: scale(1.3);
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
</style>	  
</head>

<body class="parallax">
	<div style="height: 15px; background: #008B8B; border:2px solid black;"></div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark ">

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
		<span class="sr-only">Toggle Navigation</span>
	 <span class="navbar-toggler-icon"></span>

	</button>
  <!-- Brand/logo -->
  <a class="navbar-brand" href="#"><img  id="logo" src="images/logo.png" style="height: 80px; margin-top: -25px;">	</a><h2 id="side_logo">Arete</h2>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="#">Home</a>
    </li>
    <li class="nav-item " >
      <a class="nav-link " href="Blog.php?Page=1" target="_blank">Blog</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">About Us</a>
    </li>
      <li class="nav-item">
      <a class="nav-link" href="#">Services</a>
    </li>
      <li class="nav-item">
      <a class="nav-link" href="#">Contact Us</a>
    </li>
      <li class="nav-item">
      <a class="nav-link" href="#">Features</a>
    </li>
  </ul>
</div>
  <form action="Blog.php" class="navbar-form" style="margin-left: 250px;">
  	<div class="form-group">
  		<input type="text" class="form-control" name="Search" placeholder="Search">
  		<<button class="btn btn-default" name="SearchButton">Go</button>
  	</div>
  </form>
  
</nav>
<div class="line" style="height: 15px; background: #008B8B; border:2px solid black;"></div>
	<div class="container-fluid content" >
		<div class="row" >
			<div class="col-sm-2" style="margin-top: 30px;">
				
				<ul id="Side_menu" class="nav nav-pills nav-stacked">
					<li ><a href="Dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;Dashboard</a></li>
					<li><a href="AddNewPost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add New Post</a></li>
					<li class="active"><a href="Categories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;Categories</a></li>
					
					<li><a href="Admins.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
					<li><a href="Comments.php"><span class="glyphicon glyphicon-comment"></span>&nbsp;Comments</a></li><br>
					<li><a href="#" ><span class="glyphicon glyphicon-equalizer" ></span>&nbsp;Live Blog</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-log-out" style="padding-left: 5px;"></span>&nbsp;Logout</a></li>
				</ul>
			</div>
			<div class="col-sm-10">
				<h1>Manage Categories</h1>
				<div>
					<?php  
						echo Message();
						echo SuccessMessage();
					?>
				</div>
				<div>
					<form action="Categories.php" method="Post">
						<fieldset>
							<div class="form-group">
							<label for="categoryname"><span class="field_info">Name of category to be added:</span></label>
							<input class="form-control" type="text" name="Category" id="categoryname" placeholder="Name">
							</div>
							<input  class="btn btn-success btn-lg" type="Submit" name="Submit" value="Add new Category">
						</fieldset>
					</form>
				</div>

				<div style="margin-top: 30px;" class="table-responsive">
					<table class="table table-hover table-dark">
						<tr>
							<th>Sr No.</th>
							<th>Date & Time</th>
							<th>Category Name</th>
							<th>Creator Name</th>
							<th>Action</th>
						</tr>
						<?php
							GLOBAL $Connection;
							$viewQuery="SELECT * FROM category ORDER BY id desc";
							$execute=mysqli_query($Connection,$viewQuery);
							$SrNo=0;
							while($dataRows=mysqli_fetch_array($execute)){
							$id=$dataRows["id"];
							$dateTime=$dataRows["datetime"];
							$name=$dataRows["name"];
							$creatorName=$dataRows["creatorname"];
								$SrNo++;

						?>
						<tr>
							<td><?php echo $SrNo ?></td>
							<td><?php echo $dateTime ?></td>
							<td><?php echo $name ?></td>
							<td><?php echo $creatorName ?></td>
							<td><a href="DeleteCategory.php?id=<?php echo $id; ?>"><span class="btn btn-danger">Delete</span></a></td>
						</tr>
						<?php } ?>
					</table>

				</div>
			</div>
		</div>
	</div>


	<div id="footer">
		<hr>
		Made by <span style="color: white;"><u>The Craftsman</u></span>
		<hr>
	</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>