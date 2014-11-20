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
    <link rel="stylesheet" type="text/css" href="../Css/main.css" />
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