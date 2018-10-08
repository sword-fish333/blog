
<?php
require_once("include/DB.php");
?>
<?php
require_once("Include/Sessions.php");
require_once("Include/Functions.php");
?>

<?php
if(isset($_POST['Submit'])){
	$title= mysqli_real_escape_string($Connection,$_POST["Title"]);
	$category=mysqli_real_escape_string($Connection,$_POST["Category"]);
	$post=mysqli_real_escape_string($Connection,$_POST["Post"]);

	//seting time 
	date_default_timezone_set("Europe/Bucharest");
 	$curentTime=time();
	 $time=strftime("%B-%d-%Y--/--%H:%M:%S",$curentTime);
	  $time;
	  $Admin="Alin Ghiurca";
		$image=$_FILES['Image']['name']; //image name
		$target="ImageUpload/".basename($_FILES['Image']['name']); //path to upload images

		//condition to inserting a post
	  if(empty($title) || empty($post)){
	  $_SESSION['ErrorMessage']= "The title and the post can't be empty";
			Redirect_to("AddNewPost.php");
	}elseif(strlen($title)<3 || empty($post) ){
	 $_SESSION['ErrorMessage']= "The title has to be more than 3 characters ";
			Redirect_to("AddNewPost.php");

		}else{

			//query for inserting data(date,title,category,author, image,post)
		global $Connection;
		$editFromUrl=$_GET['Edit'];
		
		$query="UPDATE admin_panel SET datetime='$time', title='$title',category='$category',author='$Admin',post='$post' WHERE id='$editFromUrl'";
		if(!empty($image)){
			$query="UPDATE admin_panel SET image='$image' WHERE id='$editFromUrl'";
		}
		$execute=mysqli_query($Connection,$query);

		//uploading files to target folder
			move_uploaded_file($_FILES['Image']["tmp_name"],$target);
			//messages if it was uploaded
		if($execute){
		$_SESSION['SuccessMessage']="Post updated succesfully !";
		Redirect_to("dashboard.php");
	}else{
	$_SESSION['ErrorMessage']="Post didn't update !!!";
	Redirect_to("dashboard.php");
			}
	}
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Update Post</title>
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
	<div class="container-fluid content">
		<div class="row">
			<div class="col-sm-2"  style="margin-top: 30px;">
				
				<ul id="Side_menu" class="nav nav-pills nav-stacked">
					<li ><a href="Dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;Dashboard</a></li>
					<li  class="active"><a href="#"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add New Post</a></li>
					<li><a href="Categories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;Categories</a></li>
					
					<li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-comment"></span>&nbsp;Comments</a></li><br>
					<li><a href="#" ><span class="glyphicon glyphicon-equalizer" ></span>&nbsp;Live Blog</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-log-out" style="padding-left: 5px;"></span>&nbsp;Logout</a></li>
				</ul>
			</div>
			<div class="col-sm-10">
				<h1>Update Post</h1>
				<div>
					<?php  
						echo Message();
						echo SuccessMessage();
					?>
				</div>
				<?php
					GLOBAL	$Connection;
						$searchId=$_GET['Edit'];
					$viewQuery="SELECT * FROM admin_panel WHERE id='$searchId'";
				    $execute=mysqli_query($Connection,$viewQuery);
				    whiLe($data=mysqli_fetch_array($execute))
				    {
				    	$titleToUpdate=$data['title'];
				    	$categoryToUpdate=$data['category'];
				    	
				    	$imageToUpdate=$data['image'];
			
				    	$postToUpdate=$data['post'];



				    }
				?>
				<div>
					<form action="EditPost.php?Edit=<?php echo $searchId; ?>" method="Post" enctype="multipart/form-data">
						<fieldset>
							<div class="form-group">
							<label for="title"><span class="field_info">Title:</span></label>
							<input value="<?php
								echo $titleToUpdate ?>"
								 class="form-control" type="text" name="Title" id="title" placeholder="Title">
							</div>
							<div class="form-group">
								<label><span class="field_info">Existing Category:
								</span></label>&nbsp;&nbsp;<?php
									echo $categoryToUpdate?><br>
							<label for="categoryselect"><span class="field_info">Select new Category:</span></label>
							<select class="form-control"  id="categoryselect" name="Category" style="width:140px;">
								<?php

								//extracting category and ordering desc
							GLOBAL $Connection;
							$viewQuery="SELECT * FROM category ORDER BY datetime desc";
							$execute=mysqli_query($Connection,$viewQuery);
							
							while($dataRows=mysqli_fetch_array($execute)){							
							$name=$dataRows["name"];			
						?>
						
								<option>	<?php echo $name; } ?> </option>
							</select>
							</div>
							<div class="form-group" style="margin-top: 20px;">
									<label><span class="field_info">Existing Image:
								</span></label>&nbsp;&nbsp;
								<img src="ImageUpload/<?php

									echo $imageToUpdate?>" height=150px; width=120px; ><br>
							
								<label for="imageselect" style="margin-top: 30px;"><span class="field_info">Select new Image :</span></label>
								<input type="File" class="form-control"  name="Image" id="imageselect" style="width: 300px;color: white; background-color: #008B8B; height: 40px;">
							</div>
							<div class="form-group">
								<label for="postarea"><span class="field_info">Post:</span></label>
							<textarea class="form-control" name="Post" id="postarea"><?php echo $postToUpdate ?></textarea>
							</div>

							<input  class="btn btn-success btn-lg" type="Submit" name="Submit"
							 value="Update Post" style="margin-bottom: 40px;">
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>


	<div id="footer" >
		<hr>
		Made by <span style="color: white;"><u>The Craftsman</u></span>
		<hr>
	</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>