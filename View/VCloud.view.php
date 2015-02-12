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

    global $idAsso;
    $idAsso = $mCloud->getIdAssoByIdUser($idUser);
    
    global $content_Cloud;
    $content_Cloud = $mCloud->displayCloud($files);

    global $asso_size;
    $size = $mCloud->getAssoSizeUpload($idUser);
    $maxSize = 104857600;
    $asso_size = ceil($size / $maxSize * 100);



    $vhtml = new VHtml();
    $vhtml->showHtml($path);

  } // showCloud($_html)
  
} // VHtml
?>