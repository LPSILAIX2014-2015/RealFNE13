<?php
require_once("../Model/MDBase.mod.php");
try{
    $connexionAvecPDO = new MDBase();

    //Connection réussie
    //$article_id=substr(); Id de la div


<<<<<<< HEAD
    $sql="UPDATE POST SET STATUS = 1, PDATE = CURDATE() WHERE ID = " . $_POST["idd"];
    $connexionAvecPDO->exec($sql);

    var_dump($connexionAvecPDO);
=======
    $sql="UPDATE POST SET STATUS = 1 WHERE ID = " . $_POST["idd"];
    $connexionAvecPDO->exec($sql);

>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b

}

catch (PDOException $e) {
    echo 'Échec lors de la connexion : ' . $e->getMessage();

}
?>