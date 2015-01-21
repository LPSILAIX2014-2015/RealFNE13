<?php
class VNav
{
  public function __construct(){}
  
  public function __destruct(){}
  
  public function showNav()
  {
    $vhtml = new VHtml();
    $vhtml->showHtml('./Html/menu.php');
    
  } // showNav($_html)
  
} // VHtml
?>