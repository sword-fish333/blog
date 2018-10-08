<?php
require_once("Include/DB.php");
require_once("Include/Functions.php");
require_once("Include/Sessions.php");

?>

<?php
if(isset($_POST['comment'])){
	$name= mysqli_real_escape_string($Connection,$_POST["Name"]);
	$email=mysqli_real_escape_string($Connection,$_POST["Email"]);
	$comment=mysqli_real_escape_string($Connection,$_POST["Comment"]);

	//seting time 
	date_default_timezone_set("Europe/Bucharest");
 	$curentTime=time();
	 $time=strftime("%B-%d-%Y--/--%H:%M:%S",$curentTime);
	  $time;
	
		$postId=$_GET["id"];

		//condition to inserting a post
	  if(empty($name) || empty($email) ||empty($comment)){
	  $_SESSION['ErrorMessage']= "All fields required";
			
	}elseif(strlen($comment)>500 ){
	 $_SESSION['ErrorMessage']= "Only 500 characters allowed in the comment area ";


		}else{

			//query for inserting data(date,title,category,author, image,post)
		global $Connection;
		$query="INSERT INTO comments(datetime,name,email,comment,status,admin_panel_id) 
		VALUES('$time','$name','$email','$comment','OFF','$postId')";
		$execute=mysqli_query($Connection,$query);

	
			//messages if it was uploaded
		if($execute){
		$_SESSION['SuccessMessage']="Comment Submited succesfully !";
		Redirect_to("FullBlogPost.php?id={$postId}");
	}else{
	$_SESSION['ErrorMessage']="Somthing went wrong !!!";
	Redirect_to("FullBlogPost.php?id={$postId} ");
			}
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Blog Page</title>
	<script type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/publicstyle.css">
	<link href='https://fonts.googleapis.com/css?family=Almendra' rel='stylesheet'>
		<link href='https://fonts.googleapis.com/css?family=Atomic Age' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Armata' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Baumans' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Allerta Stencil' rel='stylesheet'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/publicstyle.css">

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


#footer{
 padding-top:10px;
 background-color:	#008080;
 font-style:italic;
padding-bottom: 10px;
 font-family: 'Audiowide';
 font-size: 32px;
 text-align:center;
margin-top: 20px;
}

.blogpost{
	background: 	#008080;
	padding:10px;
	border-radius: 40px;
	overflow: hidden;
	box-shadow: 10px 10px grey;
}

#heading{
text-align: center;
font-family: 'Audiowide';
color: 	#A52A2A;
font-style: italic;
 transition-delay: 0.8s;
 transition-timing-function: ease-in-out;
}

#heading:hover{
	color: black;

}

.description{
	font-size: 18px;
	font-family: 'Baumans';
	font-style: italic;
	font-weight: bold;
	  letter-spacing: 2px;
}

.post{
	padding: 15px;
	
	font-family: 'Armata';
	font-size: 16px;
	color: white;
	font-style: italic;
}

.btn-info{
float: right;
margin-right: 35px;
}
.parallax { 
    /* The image used */
    background-image: url("images/poster.jpg");

    /* Set a specific height */
    height: 500px; 

    /* Create the parallax scrolling effect */
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.blog-header{
	color: white;
}

	.field_info{
	
	font-style: italic;
	font-size:18px !important;
	font-family: 'Allerta Stencil';
	color: 	white;

}



.comment_text{
	color: white;
font-weight: bold;
font-style: italic;
font-family:  'Armata';
	margin-left: 100px;
	margin-bottom: 40px;
	}

	#main_title{
		font-family: 'Atomic Age';
		font-style: italic;
		color: white;
			color: white;

	}
#quote{
	font-family: 'Audiowide';
		font-style: italic;
		color: white;
		width: 400px;
		color: white;
}
.arete_text{
color:white;
font-family: 'Armata';
margin-top: 20px;
font-size: 16px;
	}

	.arete_title{
		font-family: 'Atomic Age';
		font-style: italic;
		color: white;
		text-align: center;
	}

	.arete_image{
		border-radius: 40px;
		border:2px solid black;
	}

	#category_style{
		font-family: 'Armata';
		font-weight: bold;
		font-style: italic;
		color: #008080;
	}

	.panel_title{
		font-family: 'Armata';
		font-weight: bold;
		font-style: italic;
		color: #8B0000;
		text-align: center;
	}
	.panel_date{
		font-family: 'Armata';
		font-weight: bold;
		font-style: italic;
	margin-top: -5px;	
		text-align: center;
		font-size: 12px;
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
      <a class="nav-link " href="Blog.php?Page=1">Blog</a>
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

<div class="container" >
		<div class="blog-header">
		<h1 id="main_title"> Excel</h1>
		<p class="lead" id="quote">We are what we repeatedly do. Excellence, then, is not an act but a habit.
</p>
		</div>

		<div class="row">
			<div class="col-sm-8">

				<!-- Extract info from a database -->
				<?php

					GLOBAL $Connection;

					//test to see if somthin was enter in the search input
					if(isset($_GET['SearchButton'])){
						$search=$_GET["Search"];
						$viewQuery="SELECT * FROM admin_panel WHERE datetime LIKE '%$search%'OR title LIKE
						'%$search%' OR category LIKE '%$search%' OR post LIKE '%$search%'";
					}else{
							$idFromUrl=$_GET['id'];
					$viewQuery="SELECT * FROM admin_panel WHERE id='$idFromUrl'
					 ORDER BY datetime desc";
				}
					$execute=mysqli_query($Connection,$viewQuery);

					while($dataRows=mysqli_fetch_array($execute)){

								$postId=$dataRows['id'];
								$dateTime=$dataRows['datetime'];
								$title=$dataRows['title'];
								$category=$dataRows['category'];
								$author=$dataRows['author'];
								$image=$dataRows['image'];
								$post=$dataRows['post'];
					
				?>

				<div class="blogpost thumbnail">
				<img  class="img-responsive img-rounded" src="ImageUpload/<?php echo $image ?>" style="padding: 15px;">
				
					<div id="caption">
						<h1 id="heading"><?php echo htmlentities($title); ?></h1>
						<p class="description">
							Category:&nbsp;<span style="color: white; font-weight: bold;"><?php echo htmlentities($category) ?></span>  &nbsp;&nbsp;published on:&nbsp;<span style="color: white; font-weight: bold;"> <?php
							echo htmlentities($dateTime) ?></span>
						</p>
						<p class="post">
							<?php 
							
								echo nl2br($post);
							 ?>
						</p>
					</div>	
					
					</div>
					<?php } ?>	
					<br>
					<hr>
					<div>
					<?php  
						echo Message();
						echo SuccessMessage();
					?>
				</div>
					<span class="field_info"><u>Share your thoughts</u></span>
					<br>
					<br>
					<span class="field_info">Comments</span>
					<?php
						$Connection;
						$commentsQuery="SELECT * FROM comments WHERE admin_panel_id='$idFromUrl' AND status='on'";
						$execute=mysqli_query($Connection,$commentsQuery);
						while($query_data=mysqli_fetch_array($execute)){
							$date=$query_data['datetime'];
							$name=$query_data['name'];
							$comment=$query_data['comment'];

							?>
							<div class="comment">
							<img class="pull-left" src="images/annonimus.jpg" height="120" width="80" >
								<div class="comment_text">
							<h4><?php echo $name; ?></h4>
							<h5><?php echo $date ;?></h5>
							<p><?php echo nl2br($comment); ?></p>
							</div>
							</div>
							<br>
							<hr>
							<br>
							
						<?php }	?>
					<div>
						<form action="FullBlogPost.php?id=<?php echo $postId ?>" class="form-group" method="post">
							<fieldset>
								<div class="form-group">
								<label for="Name"><span class="field_info">Name:</span></label>
								<input class="form-control" type="text" name="Name" id="Name" placeholder="Name">
								</div>
								<div class="form-group">
								<label for="Email"><span class="field_info">Email:</span></label>
								<input class="form-control" type="email" name="Email" id="Email" placeholder="Email">
								</div>
								<div class="form-group">
								<label for="postarea"><span class="field_info">Comment:</span></label>
								<textarea class="form-control" name="Comment" id="postarea" name="Post" >
								</textarea>
								</div>
								<input type="Submit" class="btn btn-primary" name="comment" value="Submit comment">
							</fieldset>
							
						</form>
					</div>
			</div>

			
			<div class="col-sm-offset-1 col-sm-3" style="margin-top: -50px;">
				<h2 class="arete_title">Arete</h2>
				<img src="images/whiplash.jpg" class="img-responsive arete_image">
				<p class="arete_text">Arete (Greek: ἀρετή), in its basic sense, means "excellence of any kind".[1] The term may also mean "moral virtue".[1] In its earliest appearance in Greek, this notion of excellence was ultimately bound up with the notion of the fulfillment of purpose or function: the act of living up to one's full potential.<br>The term from Homeric times onwards is not gender specific. Homer applies the term of both the Greek and Trojan heroes as well as major female figures, such as Penelope, the wife of the Greek hero Odysseus. </p>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h2 class="panel-title">   <span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;Categories</h2>
					</div>
					<div class="panel-body">
						<?php
						GLOBAL $Connection;
						$query="SELECT * FROM category ORDER BY datetime desc";
						$execute=mysqli_query($Connection,$query);
						while($data=mysqli_fetch_array($execute)){
							$id=$data['id'];
							$category=$data['name'];
							?>
							<a href="Blog.php?Category=<?php echo $category; ?>">
								<span id="category_style"><?php echo $category."<br>"; ?></span>
							</a>
						<?php } ?>
					</div>
					<div class="panel-footer"></div>
				</div>

				<div class="panel panel-primary">
					<div class="panel-heading">
						<h2 class="panel-title">   <span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;Recent Post</h2>
					</div>
					<div class="panel-body">
						<?php
						GLOBAL $Connection;
						$query="SELECT * FROM admin_panel ORDER BY datetime desc LIMIT 0,3";
						$execute=mysqli_query($Connection,$query);
						while ($data=mysqli_fetch_array($execute)) {
							$id=$data['id'];
							$title=$data['title'];
							$image=$data['image'];
							$date=$data['datetime'];
							if(strlen($date)>15){
								$date=substr($date,0,15);
							}
							?>
							<div>
								<img style="margin-left: 10px; margin-top: 10px; float: left;" src="ImageUpload/<?php echo htmlentities($image) ?>" height=70; width=60;/>
								<a href="FullBlogPost.php?id=<?php echo $id; ?>">
									<p style="margin-left: 100px;" class="panel_title"><?php echo htmlentities($title); ?></p>
								</a>
								<p class="panel_date" style="margin-left: 100px;"><?php echo htmlentities($date); ?></p>
								<hr>
							</div>

						<?php }
						?>
					</div>
					<div class="panel-footer"></div>
				</div>

			</div>
		</div> <!-- Row ending -->
</div><!-- Container ending -->
	<div id="footer">
		<hr>
		Made by <span style="color: white;"><u>The Craftsman</u></span>
		<hr>
	</div>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>