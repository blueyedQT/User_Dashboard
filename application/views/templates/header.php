<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<!-- add in custome title -->
	<title>Dashboard</title>
	<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="/assets/css/bootstrap-theme.min.css">
	<script src="/assets/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/assets/css/styles.css">
</head>
<body>
	<!-- Navigation Bar -->
	<nav class="navbar navbar-inverse" role="navigation">
		<div class="container">
				<div class="navbar-header">
	  			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	    			<span class="sr-only">Toggle navigation</span>
	   				<span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
	  			</button>
	 			<a class="navbar-brand" href="/">Test App</a>
			</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	  			<ul class="nav navbar-nav">
	  				<!-- If user is logged in show dashboard and profile instead of home -->
<?php 			if(!empty($loggedin)) { ?>
    				<li><a href="/dashboard">Dashboard<span class="sr-only">(current)</span></a></li>
    				<li><a href="#">Profile<span class="sr-only">(current)</span></a></li>
<?php 			} else { ?>
	    			<li><a href="/">Home<span class="sr-only">(current)</span></a></li>
<?php 			} ?>
	 			</ul>
	 			<!-- if user is logged in show log out option -->
	  			<ul class="nav navbar-nav navbar-right">
<?php 			if(!empty($loggedin)) { ?>
					<li><a href="/logout">Log Out</a></li>
<?php 			} else { ?>
	    			<li><a href="signin">Sign In</a></li>
<?php 			} ?>
	  			</ul>
			</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
	<!-- End of Naviagtion Bar -->