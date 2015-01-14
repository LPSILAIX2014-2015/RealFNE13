<?php

function __autoload($class)
{

    if($class[0] == "M")
    {
        require_once('Model/'.$class.'.mod.php');
    }
    elseif($class[0] == "V")
    {
        require_once('View/'.$class.'.view.php');
    }
    else {
        require_once('Control/' . $class . '.cont.php');
    }
  
  return;

} // __autoload($class)

?>