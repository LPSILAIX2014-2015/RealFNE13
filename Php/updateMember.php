<?php
require_once('../Model/MDBase.mod.php');
$id = null;
if ( !empty($_POST['ID'])) {
    $id = $_POST['ID'];
}
if ( !empty($_POST)) {
    $profession = $_POST['PROFESSION'];
    $profession2 = $_POST['PROFESSION2'];
    $theme = $_POST['THEME'];
    $themedetails = $_POST['THEMEDETAILS'];
    $theme2 = $_POST['THEME2'];
    $presentation = $_POST['PRESENTATION'];

    // update data
    $pdo = new MDBase();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE USER  set PROFESSION = ?, PROFESSION2 = ?, THEME_ID = ?, THEME_INTEREST_ID = ?, THEME_DETAILS = ?, PRESENTATION = ? WHERE ID = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($profession, $profession2, $theme, $theme2, $themedetails, $presentation, $id));
    header("Location: ../index.php?EX=profil");
}
