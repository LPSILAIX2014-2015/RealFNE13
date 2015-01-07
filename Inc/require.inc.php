<?php

    function __autoload($class)
    {

      // Inclusion des class de type Vue
      if(file_exists('View/'.$class.'.view.php'))
      {
        require_once('View/'.$class.'.view.php');
      }
      elseif (file_exists('Model/'.$class.'.mod.php'))
      {
        require_once('Model/'.$class.'.mod.php');
      }

      return;

    } // __autoload($class)


    function debugAlert ($var) {
        if (modeDebug) {
            echo "<script>alert('";
            print_r(addslashes($var));
            echo "');</script>";
        }
    }

    function testVar (&$val)
    {
        return (!empty($val) && isset($val));
    }

    require_once('Php/connexion.php');

?>