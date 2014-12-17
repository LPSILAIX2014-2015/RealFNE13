<?php
class VHtml
{
  public function __construct(){}
  
  public function __destruct(){}
  
  public function showHtml($_html)
  {
<<<<<<< HEAD
    (file_exists($_html)) ? include($_html) : include('../Html/unknown.html');
=======
    (file_exists($_html)) ? include($_html) : include('Html/unknown.php');
>>>>>>> 0f1378ed7eb5467c6bbe53f03bf4798291703aa5
    
  } // showHtml($_html)
  
} // VHtml
?>