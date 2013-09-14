<!DOCTYPE html>
<html>
<head>
<title>Shaarli Flux River</title>
<link href="./favicon.ico" rel="shortcut icon" type="image/x-icon" />
<meta charset="utf-8" />
<?php if(isset($header_rss)): ?>
<link rel="alternate" type="application/rss+xml" href="<?php echo $header_rss; ?>" title="RSS Feed" />
<?php endif; ?>
<link href="./assets/bootstrap.min.css" rel="stylesheet">
<link href="./assets/style.css" rel="stylesheet">
<script type="text/javascript" src="./assets/jquery-1.8.3.min.js"></script>
</head>
<body>
<div id="page">
<div id="timer"></div>
<h1><a href="./">Shaarli Flux River</a></h1>