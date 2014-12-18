<?php

function __autoload($class)
{
  switch ($class[0])
  {
    case 'V' : require_once('./View/'.$class.'.view.php');
               break;
    case 'C' : require_once('./Class/'.$class.'.class.php');
               break;
  }
  return;

} // __autoload($class)

?>