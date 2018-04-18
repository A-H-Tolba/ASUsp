<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ASUsp</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/main.css">
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span> 
		      </button>
		     
		    </div>
		    <div class="collapse navbar-collapse" id="myNavbar">
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="#home" id="home" class="text-center active">Home</a></li>
		        <li><a href="#about" id="about" class="text-center">About Us</a></li> 
		        <li><a href="#structure" id="structure" class="text-center">Structure</a></li>
		        <li><a href="#gallery" id="gallery" class="text-center">Gallery</a></li>
		        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Events<span class="caret"></span></a>
		          <ul id="ws" class="dropdown-menu"><li><a href="#" id="ebe">BE '18</a></li><li><a href="#" id="et">Technates '18</a></li></ul>
		        </li>
		      </ul>
		     
		    </div>
		  </div>
		</nav>
</body>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap.min.js"></script>
</html>