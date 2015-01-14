<?php
    function __autoload($class)
    {
      if ($class[0] == 'M')
      {
          require_once('Model/'.$class.'.mod.php');
      }

      // Inclusion Vue (affichages)
      elseif($class[0] == 'V')
      {
        require_once('View/'.$class.'.view.php');
      }

      // Inclusion Class (fonctions)
      elseif ($class[0] == 'C')
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