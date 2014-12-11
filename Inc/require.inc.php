<?php

function __autoload($class)
{
    if ($class != "DBase") {
        require_once('../View/'.$class.'.view.php');
    } else {
        require_once('../Php/DBase.php');
    }
  // Inclusion des class de type Vue

  return;

} // __autoload($class)

?>