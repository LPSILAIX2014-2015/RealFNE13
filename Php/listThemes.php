<?php
session_start();
require_once('../Model/MDBase.mod.php');
require_once('../Model/MUser.mod.php');
require('../Inc/require.inc.php');

$pdo = new MDBase();

$request11 = $pdo -> query("select NAME as themes from theme");
$row1 = $request11->fetchAll();
$var = 0;
$taille = count($row1);
echo "<select id='theme'>";
if (isset ($_SESSION["theme"]))
{
	echo "<option value='0'>Pas de thématique sélectionnée</option>";
	while ($var<$taille)
	{
		$a = $var+1;
		if ($var == $_SESSION["theme"]-1)
		{
			echo "<option value='".$a."' selected>".$row1[$var]['themes']."</option>";
		}
		else
		{
			echo "<option value='".$a."'>".$row1[$var]['themes']."</option>";	
		}
		$var = $var+1;
	}
}
else
{
	echo "<option value='0'>Pas de thématique sélectionnée</option>";
	while($var<$taille)
	{
		$a = $var+1;
		echo "<option value='".$a."'>".$row1[$var]['themes']."</option>";
		$var = $var+1;
	}
}
echo "</select>";

?>