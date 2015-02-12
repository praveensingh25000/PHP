<?php
session_start();
$host = gethostname();
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon">
    <meta name="hostvar" content="<?php echo $host; ?>">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/clights-font/style.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div id="clights-viewport" class="container-fluid clights_viewport"></div>

<!-- off screen light elements -->
<div id="clights-light-elements" style="position: absolute; left: -10000px;">
    <img src="img/lights/clear-40x50.png" alt="" width="40" height="50" data-lightcolor="clear">
    <img src="img/lights/red-40x50.png" alt="" width="40" height="50" data-lightcolor="red">
    <img src="img/lights/green-40x50.png" alt="" width="40" height="50" data-lightcolor="green">
    <img src="img/lights/blue-40x50.png" alt="" width="40" height="50" data-lightcolor="blue">
    <img src="img/lights/amber-40x50.png" alt="" width="40" height="50" data-lightcolor="amber">
</div>

<script type="text/javascript" src="js/modernizr.min.js"></script>
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery.textfill.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/lodash.js"></script>
<script type="text/javascript" src="js/sugar-1.3.9-custom.min.js"></script>
<script type="text/javascript" src="js/handlebars.runtime.js"></script> 
<script type="text/javascript" src="js/hb_helpers.js"></script>
<script type="text/javascript" src="js/templates.js"></script>
<script type="text/javascript" src="js/fabric-1.1.21.js"></script>
<script type="text/javascript" src="js/fabric.image.filters.dayfornight.js"></script>
<script type="text/javascript" src="js/filer.js"></script>
<script type="text/javascript" src="js/filters.js"></script>
<script type="text/javascript" src="js/cfab.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>