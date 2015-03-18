<?php
class VUserInfo
{
  public function __construct(){}
  
  public function __destruct(){}
  
  public function showUserInfo()
  {
    $vhtml = new VHtml();
    $vhtml->showHtml('Html/userInfo.php');

  } // showUserInfo()

} // VUserInfo
?>