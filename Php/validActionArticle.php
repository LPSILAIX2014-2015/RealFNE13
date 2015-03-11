<?php
require_once("../Model/MDBase.mod.php");
try{
    $connexionAvecPDO = new MDBase();

    //Connection réussie
    //$article_id=substr(); Id de la div


    $sql="UPDATE POST SET STATUS = 1, PDATE = CURDATE() WHERE ID = " . $_POST["idd"];
    $connexionAvecPDO->exec($sql);

    var_dump($connexionAvecPDO);

}

catch (PDOException $e) {
    echo 'Échec lors de la connexion : ' . $e->getMessage();

}
?>