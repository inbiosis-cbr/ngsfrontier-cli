<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/bower_components/bootstrap/dist/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-spacelab.min.css" />	

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/bower_components/fontawesome/css/font-awesome.min.css" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ngsfrontier.css" />	

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<script src="<?php echo Yii::app()->request->baseUrl; ?>/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</head>

<body>

	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">NGSFrontier</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
			</div><!--/.navbar-collapse -->
		</div>
	</nav>

	<!-- Main jumbotron for a primary marketing message or call to action -->
	<div class="jumbotron">
		<div class="container">
			<h1>Welcome back!</h1>
			<p>This page serve as a friendly interface between you and your data analysis from NGSFrontier virtual-box.</p>
		</div>
	</div>

	<div class="container">
		<!-- Example row of columns -->
		<div class="row">
			<div class="col-md-4">
				<h2><i class="fa fa-cog"></i> Packages</h2>
				<p>Check what you have in your box now.</p>
				<p><a class="btn btn-primary" href="#" role="button">Check Installed Packages &raquo;</a></p>
			</div>
			<div class="col-md-4">
				<h2><i class="fa fa-cogs"></i> Workflow</h2>
				<p>Manage your workflow within the box.</p>
				<p><a class="btn btn-success" href="#" role="button">Start Workflow Manager &raquo;</a></p>
			</div>
			<div class="col-md-4">
				<h2><i class="fa fa-book"></i> Documentations</h2>
				<p>Knowledgebase to get you familiar with NGSFrontier.</p>
				<p><a class="btn btn-info" href="#" role="button">View details &raquo;</a></p>
			</div>
		</div>
		<hr>

		<footer>
			<p>&copy; INBIOSIS 2013-<?php echo date('Y', time()); ?></p>
		</footer>
	</div> <!-- /container -->

</body>
</html>
