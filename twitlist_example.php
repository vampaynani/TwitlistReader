<?php
include_once('TwitlistReader.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Twitlist Example</title>
<style>
*{
	padding:0;
	margin:0;
}
.twitlist{
	width:300px;
	margin:0 auto;
	font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
	font-size:10px;
}
.twit{
	display:block;
	background-color:#6CF;
	padding:10px 5px;
	margin:5px 0;
	border:#36C 1px solid;
	border-radius:10px;
	-moz-border-radius:10px;
	-webkit-border-radius:10px;
	overflow:hidden;
	position:relative;
}
.twit p{
	padding-left:65px;
}
.twit img{
	float:left;
	margin-left:5px;
	margin-right:10px;
}
.twit .name{
	font-size:12px;
	color:#FFF;
	text-shadow:#36C 1px 1px;
	margin-bottom:5px;
}
.twit .text{
	color:#36C;
}
.twit .date{
	text-align:right;
	padding-right: 5px;
	padding-top: 10px;
}
.twit .date a{
	text-decoration:none;
	color:#666;
}
</style>
</head>

<body>
<?php
$twitList = new TwitlistReader();
$twitList->getListsFrom("eixha");
echo $twitList->getHTMLStatuses("PATTS");
?>
</body>
</html>