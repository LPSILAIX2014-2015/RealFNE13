<?php
session_start();

require_once('../Model/MDBase.mod.php');
require_once('../Model/MUser.mod.php');
require('../Inc/require.inc.php');

$pdo = new MDBase();
$connect = mysql_connect();
$senderId = $_SESSION['ID_USER'];

$request7 = $pdo->prepare("SELECT association_id as assoc FROM user where id = ?");
$request7 -> execute(array($senderId));
$req7 = $request7->fetch();

$assocId = $req7['assoc'];

$request6 = $pdo->prepare("SELECT count(message.id) as nb_messages from message join user where sender_id = user.id and association_id = ? group by association_id");
$request6->execute(array($assocId));
$req6 = $request6->fetch();
if ($req6['nb_messages'] == 0)
{
    echo "0";
}
else
{
    echo $req6['nb_messages'];
}
?>