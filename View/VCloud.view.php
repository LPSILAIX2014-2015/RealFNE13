<?php
class VCloud
{
  public function __construct(){}
  
  public function __destruct(){}
  
  public function showCloud($path)
  {
  	$idUser = $_SESSION['ID_USER'];

    $mCloud = new MCloud();
    $files = $mCloud->getCloudByUser($idUser);

    global $content_Cloud;
    $content_Cloud = $mCloud->displayCloud($files);

    $vhtml = new VHtml();
    $vhtml->showHtml($path);

  } // showCloud($_html)
  
} // VHtml
?>