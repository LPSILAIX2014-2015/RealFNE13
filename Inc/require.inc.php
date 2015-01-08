<?php

    //Controller MVC
    function __autoload($class)
    {

      // Inclusion Model (PDO)

      if (file_exists('Model/'.$class.'.mod.php'))
      {
          require_once('Model/'.$class.'.mod.php');
      }

      // Inclusion Vue (affichages)
      elseif(file_exists('View/'.$class.'.view.php'))
      {
        require_once('View/'.$class.'.view.php');
      }

      // Inclusion Class (fonctions)
      elseif (file_exists('Class/'.$class.'.class.php'))
      {
          require_once('Class/'.$class.'.class.php');
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
?>