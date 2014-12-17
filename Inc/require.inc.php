<?php

function __autoload($class)
{
  // Inclusion des class de type Vue
<<<<<<< HEAD
  require_once('../View/'.$class.'.view.php');
=======
  require_once('View/'.$class.'.view.php');
>>>>>>> 0f1378ed7eb5467c6bbe53f03bf4798291703aa5
  
  return;

} // __autoload($class)

?>