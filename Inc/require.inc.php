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

      elseif ($class[0] == 'F')
      {
          require_once('FPDF/'.$class.'.php');
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

    /**
     * [resizeImage Function pour le redimensionnement des images]
     * @author [Cesar]
     * @param  [type] $file_image [image à redimensionner]
     * @return [type] $image_new [image redimensionné]
     */
    function resizeImage($file_image)
    {
    // Définition de la largeur et de la hauteur maximale
      $width_new = 300;
      $height_new = 300;

    // Calcul des nouvelles dimensions
      $tab = getimagesize($file_image);
      $width_old = $tab[0];
      $height_old = $tab[1];
      $mime_old = $tab['mime'];

    // Ratio pour la mise à l'échelle
      $ratio = $width_old/$height_old;

    // Redimensionnement suivant le ratio
      if ($width_new/$height_new > $ratio)
      {
        $width_new = $height_new*$ratio;
      }
      else
      {
        $height_new = $width_new/$ratio;
      }

    // Nouvelle image redimensionnée
      $image_new = imagecreatetruecolor($width_new, $height_new);

    // Création d'une image à partir du fichier d'origine et ssuivant le mime
      switch ($mime_old)
      {
        case 'image/png' :  $image_old = imagecreatefrompng($file_image); break;
        case 'image/jpeg' : $image_old = imagecreatefromjpeg($file_image); break;
        case 'image/gif' :  $image_old = imagecreatefromgif($file_image); break;
      }

    // Copie et redimensionne l'ancienne image dans la nouvelle
      imagecopyresampled($image_new, $image_old, 0, 0, 0, 0, $width_new, $height_new, $width_old, $height_old);

    // Retourne la nouvelle image redimensionnée (Attention ce n'est pas un fichier mais une image)
      return $image_new;

    } // redimensionne($file_image)

?>