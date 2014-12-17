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
    <link href="../Css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../Css/main.css" />
    <link rel="stylesheet" type="text/css" href="../Css/bootstrap.min.css" />

</head>
<body>
    <?php $vUserInfo->showUserInfo() ?>
    <nav>
        <?php $vnav->showNav() ?>
    </nav>
    <div class="page">
        <?php $vpage->$page['method']($page['arg']) ?>
    </div>
    <!-- jQuery <3 ! -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../Js/bootstrap.min.js"></script>
</body>