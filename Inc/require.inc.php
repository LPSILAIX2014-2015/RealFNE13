<?php

function __autoload($class)
{
  // Inclusion des class de type Vue

    require_once('../View/'.$class.'.view.php');
    require_once('../Php/DBase.php');
  
  return;

} // __autoload($class)

?>