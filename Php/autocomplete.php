<?php
include '../Php/DBase.php';
header('Content-type: application/json');
//if ( !empty($_POST)) {
$pdo = DBase::connect();
mysql_query('SET CHARACTER SET utf8') ;
$sql = 'SELECT LOGIN, SURNAME, CP FROM user';
$d = $pdo->query($sql);
$users = array();
foreach($d as $data)  {
    $users[] = $data;
}
// var_dump($users);

$json = json_encode($users);
//$encodedArray = array_map(utf8_encode(), $d->fetchAll());
echo json_encode($json);
//}



?>