<?php
class VCloud
{
    public function __construct(){}

    public function __destruct(){}

    public function showCloud($path)
    {
        $idUser = $_SESSION['ID_USER'];

        if(isset($_GET['state']))
        {
            global $customAlert;
            if(htmlspecialchars($_GET['state']) == "ERR_SIZE")
            {
                array_push($customAlert, "Transfert impossible. Vous avez atteint votre limite de stockage");
            }
            elseif(htmlspecialchars($_GET['state']) == "ERR_NC")
            {
                array_push($customAlert, "Transfert du fichier impossible");
            }
            elseif(htmlspecialchars($_GET['state']) == "OK")
            {
                array_push($customAlert, "Transfert du fichier réussi");
            }
            elseif(htmlspecialchars($_GET['state']) == "ERR_UNKNOWN")
            {
                array_push($customAlert, "Erreur inconnue");
            }
<<<<<<< HEAD
            elseif(htmlspecialchars($_GET['state']) == "ERR_UNKNOWN")
            {
                array_push($customAlert, "Erreur inconnue");
            }
=======
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b
        }


        $mCloud = new MCloud();
        $files = $mCloud->getCloudByUser($idUser);

        global $idAsso;
        $idAsso = $mCloud->getIdAssoByIdUser($idUser);

        global $content_Cloud;
        $content_Cloud = $mCloud->displayCloud($files);

        global $asso_size;
        $size = $mCloud->getAssoSizeUpload($idUser);
        $maxSize = 104857600;
        $asso_size = ceil($size / $maxSize * 100);



        $vhtml = new VHtml();
        $vhtml->showHtml($path);

} // showCloud($_html)

} // VHtml
?>