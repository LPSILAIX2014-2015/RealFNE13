<?php
$vnav = new VNav();
$vUserInfo = new VUserInfo();
$vpage = new $page['class']();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?= $page['title']; ?></title>
    <link href="./Css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./Css/main.css" />
    <link rel="stylesheet" type="text/css" href="./Css/bootstrap.min.css" />
	<link rel="stylesheet" href="./Css/jquery-ui.css">
	<link rel="stylesheet" href="./Css/reset.css">
    <link rel="stylesheet" href="./Css/style.css">
	<link rel="stylesheet" href="./Css/jquery.fancybox.css" media="screen">
    <script src="./Js/form.js"></script>
	<!-- jQuery <3 ! -->
	<script src="./Js/jquery-1.10.2.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    
    <script src="./Js/jquery-ui.js"></script>
    <script src="./Js/jquery.fancybox.pack.js"></script>
    <script src="./Js/jquery.fancybox.js"></script>
    <script src="./Js/bootstrap.min.js"></script>
    <script src="./Js/jquery.form.js"></script>
    <script src="./Js/jquery.validate.js"></script>
    <script src="./Js/recMP.js"></script>
</head>
<body>
    <?php $vUserInfo->showUserInfo() ?>
    <nav>
        <?php $vnav->showNav() ?>
    </nav>
    <div class="page">
        <?php $vpage->$page['method']($page['arg']) ?>
    </div>
    
</body>