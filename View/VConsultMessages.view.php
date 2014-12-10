<?php
class VConsultMessages
{
  public function __construct(){}
  
  public function __destruct(){}
  
  public function showConsultMessages($path)
  {
  	
  	
    $vhtml = new VHtml();
    $vhtml->showHtml($path);
    
  } // showConsultMessages($_html)
  
} // VHtml
?>