<?php
require_once('../Model/MDBase.mod.php');
if ( !empty($_POST)) {
    $profession = $_POST['PROFESSION'];
    $profession2 = $_POST['PROFESSION2'];
    $theme = $_POST['THEME'];
    $presentation = $_POST['PRESENTATION'];
    $id = $_POST['ID'];

    // update data
    $pdo = new MDBase();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE USER  set PROFESSION =?, PROFESSION2 = ?, THEME_DETAILS = ?, PRESENTATION = ? WHERE ID = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($profession, $profession2, $theme, $presentation, $id));
}