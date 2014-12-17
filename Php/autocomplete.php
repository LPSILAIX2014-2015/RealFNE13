<?php
include '../Php/DBase.php';
$name = null;
if ( !empty($_POST)) {
    $pdo = DBase::connect();
    $sql = 'SELECT * FROM user ORDER BY NAME ASC';
    $d = $pdo->query($sql);
    $users = array();
    foreach ($d as $data){
        $users[] = $data;
    }
    print_r(json_encode($users));
}



?>