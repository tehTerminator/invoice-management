<?php require_once 'functions.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> <?php $the_title; ?></title>
	
	<!-- bower:css -->
	<link rel="stylesheet" href="bower_components/semantic-ui/dist/semantic.css" />
	<link rel="stylesheet" href="bower_components/datatables/media/css/jquery.dataTables.css" />
	<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css" />
	<!-- endbower -->

	<!-- bower:js -->
	<script src="bower_components/jquery/dist/jquery.js"></script>
	<script src="bower_components/semantic-ui/dist/semantic.js"></script>
	<script src="bower_components/datatables/media/js/jquery.dataTables.js"></script>
	<script src="bower_components/bootstrap/dist/js/bootstrap.js"></script>
	<!-- endbower -->

	<?php load('js') ?>
	<?php load('css') ?>

</head>