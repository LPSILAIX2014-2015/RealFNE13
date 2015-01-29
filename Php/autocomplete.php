<?php
include ('../Model/MDBase.mod.php'); //TODO

if ( !empty($_POST)) {
    $pdo = new MDBase();
    $sql = 'SELECT e.NAME,e.SURNAME,e.CP, a.NAME AS ASSOCIATION FROM user e, association a ORDER BY NAME ASC';
    $d = $pdo->query($sql);
	
    $users = array();
    foreach ($d as $data){
        $users[] = $data;
    }
	print_r(json_encode($users));
}

?>