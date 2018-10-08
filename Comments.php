<?php  
require_once("Include/Sessions.php");
require_once("Include/Functions.php");
require_once("Include/DB.php");
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
					<li><a href="Dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;Dashboard</a></li>
					<li><a href="AddNewPost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add New Post</a></li>
					<li><a href="Categories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;Categories</a></li>
					
					<li ><a href="Admins.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
					<li class="active"><a href="Comments.php"><span class="glyphicon glyphicon-comment"></span>&nbsp;Comments</a></li><br>
					<li><a href="#" ><span class="glyphicon glyphicon-equalizer" ></span>&nbsp;Live Blog</a></li>
					<li><a href="#"><span class="glyphicon glyphicon-log-out" style="padding-left: 5px;"></span>&nbsp;Logout</a></li>
				</ul>
			</div>
			<div class="col-sm-10">
				<?php  
						echo Message();
						echo SuccessMessage();
					?>
				<h1>Un-Approved Comments</h1>
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<tr>
							<th>No.</th>
							<th>Name</th>
							<th>Date</th>
							<th>Comment</th>
							<th>Approve</th>
							<th>Delete Comment</th>
							<th>Details</th>
						</tr>
						<?php
							GLOBAL $Connection;
							$query="SELECT * FROM comments WHERE status='off' ORDER BY datetime desc";
							$execute=mysqli_query($Connection,$query);
							$SrNo=0;
							while($data=mysqli_fetch_array($execute)){
								$id=$data['id'];
								$date=$data['datetime'];
								$name=$data['name'];
								$comment=$data['comment'];
								$post_id=$data['admin_panel_id'];
								$SrNo++;
									if(strlen($name)>10){
									$name=substr($name,0,10).'...';
								}

								
								?>

								<tr>
									<td><?php echo htmlentities($SrNo); ?></td>
									<td style="color:#B22222;"><?php echo htmlentities($name); ?></td>
									<td><?php echo htmlentities($date); ?></td>
									<td><?php echo htmlentities($comment); ?></td>
									<td><a href="ApproveComments.php?id=<?php echo $id; ?>"><span class="btn btn-success">Approve</span></a></td>
									<td><a href="DeleteComments.php?id=<?php echo $id ?>"><span class="btn btn-danger">Delete</span></a></td>
									<td><a href="FullBlogPost.php?id=<?php echo $post_id ?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
								</tr>
							<?php }
						?>
					</table>
				</div><!--end of table-->
				<h1>Approved Comments</h1>
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<tr>
							<th>No.</th>
							<th>Name</th>
							<th>Date</th>
							<th>Comment</th>
							<th>Approved by</th>
							<th>Approve</th>
							<th>Delete Comment</th>
							<th>Details</th>
						</tr>
						<?php
							GLOBAL $Connection;
							$query="SELECT * FROM comments WHERE status='on'  ORDER BY datetime desc";
							$execute=mysqli_query($Connection,$query);
							$SrNo=0;
							while($data=mysqli_fetch_array($execute)){
								$id=$data['id'];
								$date=$data['datetime'];
								$name=$data['name'];
								$comment=$data['comment'];
								$post_id=$data['admin_panel_id'];
								$SrNo++;
								$Admin="Ghiurca Alin";
								if(strlen($name)>10){
									$name=substr($name,0,10).'...';
								}

								
								?>

								<tr>
									<td><?php echo htmlentities($SrNo); ?></td>
									<td style="color:#B22222;"><?php echo htmlentities($name); ?></td>
									<td><?php echo htmlentities($date); ?></td>
									<td><?php echo htmlentities($comment); ?></td>
									<td><?php  echo $Admin; ?></td>
									<td><a href="DisapproveComments.php?id=<?php echo $id ?>"><span class="btn btn-warning">Dis-Approve</span></a></td>
									<td><a href="DeleteComments.php?id=<?php echo $id ?>"><span class="btn btn-danger">Delete</span></a></td>
									<td><a href="FullBlogPost.php?id=<?php echo $post_id ?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
								</tr>
							<?php }
						?>
					</table>
				</div><!--end of table-->
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