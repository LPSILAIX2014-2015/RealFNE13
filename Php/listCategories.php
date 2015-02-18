<?php
require_once('../Model/MDBase.mod.php');
require_once('../Model/MUser.mod.php');
require('../Inc/require.inc.php');

$pdo = new MDBase();
$connect = mysql_connect();

$request10 = $pdo -> query("select NAME as categories from mescat");
$row = $request10->fetchAll();
$var = 0;
$taille = count($row);
echo "<select id='category'>";
while ($var < $taille)
{
    echo "<option value='".$var."'>".$row[$var]['categories']."</option>";
    $var = $var+1;
}
echo "</select>";

?>