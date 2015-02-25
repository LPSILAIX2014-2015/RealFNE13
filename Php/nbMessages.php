<?php
session_start();

require_once('../Model/MDBase.mod.php');
require_once('../Model/MUser.mod.php');
require('../Inc/require.inc.php');

$pdo = new MDBase();

$senderId = $_SESSION['ID_USER'];

$requete7 = $pdo->prepare("SELECT ROLE as role from USER WHERE ID = ?");
$requete7 -> execute(array($senderId));
$reqt7 = $requete7->fetch();

$request7 = $pdo->prepare("SELECT ASSOCIATION_ID as assoc FROM USER where ID = ?");
$request7 -> execute(array($senderId));
$req7 = $request7->fetch();

$assocId = $req7['assoc'];

$request6 = $pdo->prepare("SELECT COUNT(MESSAGE.ID) as nb_messages from MESSAGE join USER where SENDER_ID = USER.ID and ASSOCIATION_ID = ? group by ASSOCIATION_ID");
$request6->execute(array($assocId));
$req6 = $request6->fetch();
if ($reqt7['role'] == 'SADMIN')
{
	echo "Nombre illimité de messages";
}
else
if ($req6['nb_messages'] == 0)
{
    echo "0";
}
else
{
    echo $req6['nb_messages'];
}
?>