<?php
session_start();
require_once('../Model/MDBase.mod.php');
require_once('../Model/MUser.mod.php');
require('../Inc/require.inc.php');

$pdo = new MDBase();

$request10 = $pdo -> query("select NAME as categories from mescat");
$row = $request10->fetchAll();
$var = 1;
$taille = count($row);
echo "<select id='category'>";
if (isset ($_SESSION["category"]))
{
	echo "<option value='0'>Pas de catégorie sélectionnée</option>";
	while ($var<$taille)
	{
		if ($var == $_SESSION["category"])
		{
			echo "<option value='".$var."' selected>".$row[$var]['categories']."</option>";
		}
		else
		{
			echo "<option value='".$var."'>".$row[$var]['categories']."</option>";	
		}
		$var = $var+1;
	}
}
else
{
	echo "<option value='0'>Pas de catégorie sélectionnée</option>";
	while($var<$taille)
	{
		echo "<option value='".$var."'>".$row[$var]['categories']."</option>";
		$var = $var+1;
	}
}
echo "</select>";
echo "<a href='./index.php?EX=updateCategory'>Ajouter/Modifier</a>";
?>