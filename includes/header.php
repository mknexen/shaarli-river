<!DOCTYPE html>
<html>
<head>
<title>Shaarli Flux River</title>
<link href="./favicon.ico" rel="shortcut icon" type="image/x-icon" />
<meta charset="utf-8" />
<link href="./assets/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
* {
	margin: 0;
	padding: 0;
}
body {
	font-size: 14px;
    width:100%;
    height:100%;
    /* Source: http://wallbase.cc/wallpaper/711901 */
    background: url("wallpaper.jpg") no-repeat fixed 0 0 transparent;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
a {
	color: #0084b4;
}
h1 {
	margin: 0 0 15px 0;
}
#page {
	margin: auto;
	width: 90%;
	background-color: #fff;
	padding: 15px 20px;
}
#timer {
	float: right;
}
.entry {
	padding: 10px;
	border-right: 1px solid #e8e8e8;
	border-left: 1px solid #999;
	border-top: 1px solid #e8e8e8;	
}
.entry:hover {
	background-color: #F5F5F5;
}
.entry-shaarli {
	font-weight: bold;
}
.entry-title {
	font-weight: bold;
}
.entry-timestamp {
	font-size: 12px;
	color: #999;
	float: right;
}
.entry-counter {
	padding: 3px 10px;
	margin: 0 5px 0 0;
	float: left;
	background-color: #0084b4;
	color: #fff;
	border-radius: 10px;
}
.unread {
	border-left: 3px solid #0084b4;
}
</style>
<script type="text/javascript" src="assets/jquery-1.8.3.min.js"></script>
</head>
<body>
<div id="page">
	<div id="timer"></div>
	<h1><a href="./">Shaarli Flux River</a></h1>
	<div class="menu">
		<a class="btn btn-default" href="index.php"><span class="glyphicon glyphicon-signal"></span> The River</a>
		<a class="btn btn-default" href="top.php?today"><span class="glyphicon glyphicon-star"></span> Top Shared Today</a>
		<a class="btn btn-default" href="top.php?month"><span class="glyphicon glyphicon-star"></span> Top Shared this Month</a>
		<a class="btn btn-default" target="_blank" href="https://nexen.mkdir.fr/shaarli-tv/"><span class="glyphicon glyphicon-film"></span> TV</a>
		<a class="btn btn-default" target="_blank" href="https://shaarli.fr"><span class="glyphicon glyphicon-retweet"></span> Discutions</a>
		<a class="btn btn-default" target="_blank" href="https://shaarli.fr/jappix/?r=shaarli@conference.dukgo.com"><span class="glyphicon glyphicon-comment"></span> Chat</a>		
	</div>
	<br />