<?php
$name = null;
if ( !empty($_POST)) {
    $pdo = new MDBase();
    $sql = 'SELECT * FROM USER ORDER BY NAME ASC';
    $d = $pdo->query($sql);
    $users = array();
    foreach ($d as $data){
        $users[] = $data;
    }
    print_r(json_encode($users));
}

?>