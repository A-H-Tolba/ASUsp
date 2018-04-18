<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
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
		        <form name="myForm" id="login" autocomplete="off" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>Welcome/login">
					<input type="email" name="email" class="login form-control" placeholder="E-Mail">
					<input type="password" name="password" class="login form-control" placeholder="Password">
					<button id="btn-lgn" type="submit">Submit</button>
				</form>
		      </ul>
		     
		    </div>
		  </div>
		</nav>

		<div class="container-fluid">
		<form name="myForm" autocomplete="off" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>Welcome/signup">
			<input type="text" name="username" class="form-control" placeholder="Username">
			<input type="email" name="email" class="form-control" placeholder="E-Mail">
			<input type="password" name="password" class="form-control" placeholder="Password">
			<button type="submit">Submit</button>
		</form>
		</div>
		
</body>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap.min.js"></script>
</html>