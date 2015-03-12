<?php
require_once("../Model/MDBase.mod.php");
try{
    $connexionAvecPDO = new MDBase();

    //Connection réussie
    //$article_id=substr(); Id de la div


    $sql="DELETE FROM POST WHERE ID = " . $_POST["idd"];
    $connexionAvecPDO->exec($sql);


}

catch (PDOException $e) {
    echo 'Échec lors de la connexion : ' . $e->getMessage();

}
?>