<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Red Bird Reports - Application</title>
<meta name="author" content="" />
<meta name="keywords" content="" />
<meta name="description" content="" />
<!-- mobile device meta data -->
    <meta name="viewport" content="initial-scale=1,maximum-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
<!-- css -->
<link rel="stylesheet" href="<?php echo URL; ?>public/css/<?php echo $css; ?>">
<link rel="stylesheet" href="<?php echo URL; ?>public/css/datepicker.css">
<link rel="stylesheet" href="<?php echo URL; ?>public/css/jquery-ui.css">
<!-- jQuery -->
<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js"></script>
<!-- JavaScript -->
<script src="<?php echo URL; ?>public/js/global.js"></script>
<script src="<?php echo URL; ?>public/js/application.js"></script>
<?php if (isset($dateScript)) { ?>
<script src="<?php echo URL; ?>public/js/<?php echo $dateScript; ?>"></script>
<?php } ?>
<?php if (isset($uploadScript)) { ?>
<script src="<?php echo URL; ?>public/js/<?php echo $uploadScript; ?>"></script>
<?php } ?>
<!-- google analytics tracking -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-XXXXXXXX-0', 'redbirdreports.com');
  ga('send', 'pageview');
</script>
</head>
<body>
<noscript>
  <meta http-equiv='refresh' content='0;url=/upgrade.html'>
  This web application requires JavaScript. Please enable JavaScript or upgrade your browser.
</noscript>
<div id="viewport">
<!-- BEGIN CANVAS AREA -->