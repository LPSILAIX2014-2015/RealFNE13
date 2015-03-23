<?php
require_once("../Model/MDBase.mod.php");
try{
    $connexionAvecPDO = new MDBase();

    //Connection réussie
    //$article_id=substr(); Id de la div

$val='ARTICLE';
$sql1='SELECT NAME, SURNAME FROM USER WHERE ID='.$_SESSION['ID'];
$sql2='SELECT TITLE FROM POST WHERE ID='.$_POST["idd"];

    $sql="UPDATE POST SET STATUS = 1, PDATE = CURDATE() WHERE ID = " . $_POST["idd"];
    $connexionAvecPDO->exec($sql);

    $ST = $connexionAvecPDO->prepare($sql2);
    $ST->execute();
    $post= $ST->fetch(PDO::FETCH_ASSOC);

    $stmtt = $connexionAvecPDO->prepare($sql1);
    $stmtt->execute();
    $rezz = $stmtt->fetch();

    $content = $rezz["NAME"]." ".$rezz["SURNAME"]." a validé l'article ".$post["TITLE"];

    $stmt = $connexionAvecPDO->prepare("INSERT INTO REPORT VALUES (NULL, :date, :type, :content)");

    $stmt->bindParam(':date',date('Y-m-d') ,PDO::PARAM_STR);
    $stmt->bindParam(':type', $val, PDO::PARAM_STR);
    $stmt->bindParam(':content', $content, PDO::PARAM_STR);



}

catch (PDOException $e) {
    echo 'Échec lors de la connexion : ' . $e->getMessage();

}
?>