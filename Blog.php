<?php
require_once("Include/DB.php");
require_once("Include/Functions.php");
require_once("Include/Sessions.php");

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
    <li class="nav-item active" >
      <a class="nav-link " href="Blog.php" >Blog</a>
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

<div class="container">
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
					// query when the search button is active
						$viewQuery="SELECT * FROM admin_panel WHERE datetime LIKE '%$search%'OR title LIKE
						'%$search%' OR category LIKE '%$search%' OR post LIKE '%$search%'";
						$execute=mysqli_query($Connection,$viewQuery);
						if(mysqli_num_rows($execute)==0){
							echo "<div class=\"alert alert-danger\">No posts found</div>";	
						}
						//query when the category was selected
					}elseif(isset($_GET['Category'])){
						$category=$_GET['Category'];
						$viewQuery="SELECT * FROM admin_panel WHERE category='$category' ORDER BY id desc";
					}
					elseif(isset($_GET['Page'])){
							//query for pagination
						$Page=$_GET['Page'];
						if($Page==0 || $Page<1){
							$ShowPostFrom=0;
						}else{
						$ShowPostFrom=($Page*5)-5;
						//echo $ShowPostFrom;
					}
					$viewQuery="SELECT * FROM admin_panel ORDER BY id desc LIMIT $ShowPostFrom,5";
					}
					else{
						//default query for blog
					$viewQuery="SELECT * FROM admin_panel ORDER BY id desc";
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
							echo htmlentities($dateTime) ?></span>	<?php
								$Connection;
							//count the nr of coments for  a post
							$queryCom="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$postId' AND status='ON'";
							$executeCom=mysqli_query($Connection,$queryCom);
							$dataCom=mysqli_fetch_array($executeCom);
							$totalComments=array_shift($dataCom);
							if($totalComments>0){
							?>
							<span class="label label-success label-lg pull-right" style="margin-right: 20px; margin-top: 10px;">Comments:
							<?php
							echo $totalComments;
							
							?></span>
						<?php } ?>

						</p>
						<p class="post">
							<?php 
							//return a substring of the post
							if(strlen($post)>150){
								$post=substr($post,0,150);
							
							echo $post."...";
						}
							else{
								echo $post;
							} ?>
						</p>
					</div>	

					<a href="FullBlogPost.php?id=<?php echo $postId ?>"><span class="btn btn-info btn-lg">Read More &Rarrtl;</span></a>
					</div>
					<?php } ?>	
					<nav>
				<ul class="pagination pull-left pagination-lg">
						<?php 
						if(isset($Page)){
						if($Page>1){
							?>
						<li><a href="Blog.php?Page=<?php echo $Page-1 ?>"> &laquo;</a></li>
						<?php }} ?>
							<?php
							GLOBAL $Connection;
							$queryPag="SELECT COUNT(*) FROM admin_panel";
							$execute=mysqli_query($Connection,$queryPag);
							$rowPag=mysqli_fetch_array($execute);
							$totalPag=array_shift($rowPag); 
							//print $totalPag;
							$postPerPage=$totalPag/5;
							//echo "<br>";
							$postPerPage=ceil($postPerPage);
							//print($postPerPage);

							for($i=1;$i<=$postPerPage;$i++){
									if(isset($_GET['Page'])){
								if($i==$Page){
					?>
			
				<li class="active"><a href="Blog.php?Page=<?php echo $i ;?>" ><?php echo $i; ?></a></li>
			
		<?php }else{ ?>
				
				<li ><a href="Blog.php?Page=<?php echo $i ;?>" ><?php echo $i; ?></a></li>

			<?php	}
			}
		}
			?>
			<?php 
			if(isset($Page)){
						if($Page<$postPerPage){
							?>
						<li><a href="Blog.php?Page=<?php echo $Page+1 ?>">&raquo; </a></li>
						<?php } }?>
		</ul>
		</nav>
			</div>
		
			
			<div class="col-sm-offset-1 col-sm-3">
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
						$query="SELECT * FROM category ORDER BY id desc";
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
						$query="SELECT * FROM admin_panel ORDER BY id desc LIMIT 0,5";
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