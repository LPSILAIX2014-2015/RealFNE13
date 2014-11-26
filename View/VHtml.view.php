<?php
class VHtml
{
  public function __construct(){}
  
  public function __destruct(){}
  
  public function showHtml($_html)
  {
    (file_exists($_html)) ? include($_html) : include('../Html/unknown.html');
    
  } // showHtml($_html)
  
} // VHtml
?>