<html>
<head>
	<title>OpenGuestBook</title>

	<?
		$base_url = parse_url('http://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
	?>
	<link rel="stylesheet" type="text/css" href="http://<?=$base_url['host'].$base_url['path'];?>/assets/css/styles.css" media="print, screen"/>
</head>
<body>