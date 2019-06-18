<?php if(!defined('INDEX')) die('Direct access is prohibited!');?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="">

		<title><?php if(isset($page_title)) echo $page_title; else echo 'Binary';?></title>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="assets/css/bootstrap-theme.min.css">
		
		<!-- Custom Styles -->
		<link rel="stylesheet" href="assets/css/main.css">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>

		<nav id="main-menu" class="navbar navbar-inverse">
			<div class="container">
				<noscript>
					<p class="javascript-warning"><b class="text-danger"><i class="glyphicon glyphicon-exclamation-sign"></i> Please turn on Javascript to take full advantage of this site.</b></p>
				</noscript>
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php">CSCI 215 : <small class="text-info">Binary</small></a>
				</div>
				<ul class="nav navbar-nav">
					<li><a href="index.php?page=entryForm">Entry Form</a></li>
					<!--
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Students <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="index.php?page=students">List</a></li>
							<li><a href="index.php?page=entryForm">Entry Form</a></li>
						</ul>
					</li>
					-->
				</ul>
				<div id="navbar" class="collapse navbar-collapse navbar-right">
					<?php if(array_key_exists('logged_in', $_SESSION) && $_SESSION['logged_in'] === TRUE) :?>
					<ul class="nav navbar-nav">
						<li><a href="index.php?page=login&logout=1"><b>Logout</b></a></li>
					</ul>
					<?php endif;?>
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Useful Links <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li class="dropdown-header">User Directories</li>
								<li><a href="http://ned.highline.edu/~vvsidorov/" target="_blank">Vladimir Sidorov <small><i class="glyphicon glyphicon-new-window"></i></small></a></li>
								<li><a href="http://ned.highline.edu/~alexcmoore/215/" target="_blank">Alex Moore <small><i class="glyphicon glyphicon-new-window"></i></small></a></li>
								<li><a href="http://ned.highline.edu/~mominur/215/" target="_blank">Mominur Islam <small><i class="glyphicon glyphicon-new-window"></i></small></a></li>
								<li class="divider"></li>
								<li class="dropdown-header">Project Links</li>
								<li><a href="http://voljin.highline.edu/redmine/" target="_blank">Redmine <small><i class="glyphicon glyphicon-new-window"></i></small></a></li>
								<li><a href="http://ned.highline.edu/phpMyAdmin/" target="_blank">phpMyAdmin <small><i class="glyphicon glyphicon-new-window"></i></small></a></li>
								<li class="divider"></li>
								<li><a href="index.php?page=landing">Landing Page</a></li>
							</ul>
						</li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</nav>
		<?php if(array_key_exists('logged_in', $_SESSION) && $_SESSION['logged_in']) : ?>
		<div class="container">
			<p><b><?php echo ucwords($_SESSION['user_role']);?>: </b><?php echo $_SESSION['username'];?></p>
		</div>
		<?php endif;?>
