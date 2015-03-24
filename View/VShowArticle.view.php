<?php
class VShowArticle
{

	public function __construct(){}
	
	public function __destruct(){}
	
	public function showArticle($_html)
	{

	// REMPLISSAGE DU CONTENU

	$vhtml = new VHtml();
	$vhtml->showHtml($_html);

	} // showShowArticle($_html)
  
} // VHtml
?>
