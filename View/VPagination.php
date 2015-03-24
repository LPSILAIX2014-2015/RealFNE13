<?php
/**
 * Created by PhpStorm.
 * User: a11721385
 * Date: 18/03/15
 * Time: 11:06
 */

class VPagination {

    public function __construct(){}

    public function __destruct(){}

    public function VPagination ($condition)
    {
        $db = new MDBase();

    $ret_stat = $db->prepare("SELECT COUNT(*) TOT FROM POST WHERE ".$condition);
    $ret_stat->execute();
    $rez = $ret_stat->fetch(PDO::FETCH_ASSOC);

        $nombreDePages=ceil($rez["TOT"]/10);

        if(isset($_GET['page'])) // Si la variable $_GET['page'] existe...
        {
            $pageActuelle=intval($_GET['page']);

            if($pageActuelle > $nombreDePages) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
            {
                $pageActuelle = $nombreDePages;
            }
        }

        else // Sinon
        {
            $pageActuelle=1; // La page actuelle est la n°1
        }

        $premiereEntree=($pageActuelle-1)*10; // On calcul la première entrée à lire

// La requête sql pour récupérer les messages de la page actuelle.
        $sql = "SELECT *, P.IMAGEPATH PIMAGEPATH, P.ID PID FROM POST P, USER U WHERE ".$condition ." AND U.ID = P.WRITER_ID ORDER BY P.ID LIMIT ".$premiereEntree.", ".'1';
        $sttt = $db->prepare($sql);
        $sttt->execute();

    } // createArticle($_html)

}