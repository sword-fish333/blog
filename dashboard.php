<?php  
require_once("Include/Sessions.php");
require_once("Include/Functions.php");
require_once("Include/DB.php");
?>
<?php
Confirm_Login();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/adminstyle.css">
	<link href='https://fonts.googleapis.com/css?family=Atomic Age' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Armata' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Baumans' rel='stylesheet'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style type="text/css">
	
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
			<div class="col-sm-2" style="margin-top: 30px;">
				
				<ul id="Side_menu" class="nav nav-pills nav-stacked">
					<li class="active"><a href="Dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;Dashboard</a></li>
					<li><a href="AddNewPost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add New Post</a></li>
					<li><a href="Categories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;Categories</a></li>
					
					<li><a href="Admins.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
					<li><a href="Comments.php"><span class="glyphicon glyphicon-comment"></span>&nbsp;Comments<?php
								$Connection;
							//count the nr of coments for  a post
							$q="SELECT COUNT(*) FROM comments WHERE  status='OFF'";
							$exec=mysqli_query($Connection,$q);
							$data_exec=mysqli_fetch_array($exec);
							$total_unapproved=array_shift($data_exec);
							if($total_unapproved>0){
							?>
							<span class="label label-warning" style="margin-left: 50px;">
							<?php
							echo $total_unapproved;
							}
							?></a>

							

					</li><br>
					<li><a href="Blog.php" target="_blank"><span class="glyphicon glyphicon-equalizer" ></span>&nbsp;Live Blog</a></li>
					<li><a href="Logout.php"><span class="glyphicon glyphicon-log-out" style="padding-left: 5px;"></span>&nbsp;Logout</a></li>
				</ul>
			</div>
			<div class="col-sm-10">
				<h1>Admin Dashboard</h1>
				<div>
					<?php  
						echo Message();
						echo SuccessMessage();
					?>
				</div>
				<div class="table-responsive">
					<table class="table table-striped table-dark  table-hover">
						<tr>
							<th>No</th>
							<th>Post Title</th>
							<th>Date & Time</th>
							<th>Author</th>
							<th>Category</th>
							<th>Banner</th>
							<th>Comments</th>
							<th>Action</th>
							<th>Details</th>
						</tr>
						<!--extracting data from database-->
						<?php
						GLOBAL $Connection;

						$viewQuery="SELECT * FROM admin_panel ORDER BY id desc";
						$execute=mysqli_query($Connection,$viewQuery);
						$SrNo=0;
						while($queryData=mysqli_fetch_array($execute)){
						$id=$queryData['id'];
						$date=$queryData['datetime'];
						$title=$queryData['title'];
						$category=$queryData['category'];
						$author=$queryData['author'];
						$image=$queryData['image'];
						$post=$queryData['post'];
						$SrNo++;
						?>
					<tr>
						<td><?php echo $SrNo; ?></td>
						<td style=" font-weight: bold; font-size: 18px;"><?php 
							if(strlen($title)>20){

							$title=substr($title,0,20);
							$title.="...";
						}
							echo $title; ?></td>
						<td><?php 
								$date=substr($date,0,15)."..";
							echo $date; ?></td>
						<td><?php 
							if(strlen($author)>5){
							$author=substr($author,0,5)."..";
						}
							echo $author; ?></td>
						<td><?php
								if(strlen($category)>8){
								$category=substr($category,0,8)."..";
							}
						 echo $category; ?></td>
						<td><img src="ImageUpload/<?php echo $image; ?>" height="90px" width="80px"></td>
							<td>
								<?php
								$Connection;
							//count the nr of coments for  a post
							$queryCom="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$id' AND status='ON'";
							$executeCom=mysqli_query($Connection,$queryCom);
							$dataCom=mysqli_fetch_array($executeCom);
							$totalComments=array_shift($dataCom);
							if($totalComments>0){
							?>
							<span class="label label-success pull-right">
							<?php
							echo $totalComments;
							
							?></span>
						<?php } ?>

						<?php
								$Connection;
							//count the nr of coments  unapproved  a post
							$queryUnCom="SELECT COUNT(*) FROM comments 
							WHERE admin_panel_id='$id' AND status='OFF'";
							$executeUnCom=mysqli_query($Connection,$queryUnCom);
							$dataUnCom=mysqli_fetch_array($executeUnCom);
							$totalUnComments=array_shift($dataUnCom);
							if($totalUnComments>0){
							?>
							<span class="label label-danger ">
							<?php
							echo $totalUnComments;
							
							?></span>
						<?php } ?>
							</td>

						<td>
							<a href="EditPost.php?Edit=<?php echo $id ?>">
						<span class="btn btn-warning">Edit</span></a>
						 &nbsp; 
							<a href="DeletePost.php?delete=<?php echo $id ?>">
						<span class="btn btn-danger"> Delete</span>
					</a>
					</td>
						<td><a href="FullBlogPost.php?id=<?php echo $id ?>" target="_blank"><span class="btn btn-success"> Live Preview</span></a></td>
					</tr>

					<?php }	?>
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