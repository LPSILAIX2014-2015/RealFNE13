<?php
global $user;

header('content-type: text/html; charset=utf-8');
require_once('../Model/MDBase.mod.php');
require_once('../Model/MUser.mod.php');
require('../Inc/require.inc.php');
include('paginationRechercheMembre.php');

$pdo = new MDBase();
$pdo->exec("set names utf8");


//To show the profil
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['searchInputs']))
    {
        $resultsParPage = 5; //# of results for page
        $pageActual = $_POST['page'];
        $firstRegistry = ($pageActual - 1) * $resultsParPage;


        $conditions = array();
        $params = array();

        $numberPages = '';
        $numberRegistries = '';


        if ($_POST['name']) {
            $conditions[] = "USER.NAME LIKE '%" . $_POST['name'] . "%'";
            $params[] = $_POST['name'];
        }
        if ($_POST['surname']) {
            $conditions[] = "SURNAME LIKE '%" . $_POST['surname'] . "%'";
            $params[] = $_POST['surname'];
        }
        if ($_POST['email']) {
            $conditions[] = "MAIL LIKE '%" . $_POST['email'] . "%'";
            $params[] = $_POST['email'];
        }
        if ($_POST['terr']) {
            $conditions[] = "territory.name LIKE '%" . $_POST['terr'] ."%'" ;
            $params[] = $_POST['terr'];
        }
        if ($_POST['prof']) {
            $conditions[] = "PROFESSION LIKE '%" . $_POST['prof'] . "%'";
            $params[] = $_POST['prof'];
        }
        if ($_POST['asso']) {
            $conditions[] = "ASSOCIATION_ID LIKE '%" . $_POST['asso'] . "%'";
            $params[] = $_POST['asso'];
        }
        $where = " WHERE " . implode($conditions, ' AND ');
        $sql0 = "SELECT count(*)
                  FROM USER
                  INNER JOIN ASSOCIATION  ON user.ASSOCIATION_ID = ASSOCIATION.ID
                  INNER JOIN TERRITORY ON ASSOCIATION.TERRITORY_ID = TERRITORY.ID
                  LEFT JOIN THEME ON USER.THEME_INTEREST_ID = THEME.ID  $where";
        //For obtain number of members
        $prep0 = $pdo->prepare($sql0);
        $prep0->execute();
        $rNMB = $prep0->fetchColumn();
        //results
        $sql = "SELECT USER.ID AS U_ID, USER.LOGIN, USER.NAME AS U_NAME, SURNAME, MAIL, ADRESS, TERRITORY.NAME as t_name, THEME.NAME as t_interest, PROFESSION, ASSOCIATION.NAME as asso_name
                  FROM USER
                  INNER JOIN ASSOCIATION  ON USER.ASSOCIATION_ID = ASSOCIATION.ID
                  INNER JOIN TERRITORY ON ASSOCIATION.TERRITORY_ID = TERRITORY.ID
                  LEFT JOIN THEME ON USER.THEME_INTEREST_ID = THEME.ID  $where  LIMIT $firstRegistry, $resultsParPage";
        $q = $pdo->prepare($sql);
        $q->execute();
        $rows = $q->fetchAll(PDO::FETCH_ASSOC);

        $numberPages =ceil($rNMB / $resultsParPage);
        $data = '';

        if ($rows) {
            foreach ($rows as $row) {
                if(!$row['t_interest']){
                    $row['t_interest']="<b class='red'>Pas de theme d'interest</b>";
                }
                $data.= '<tr>
                        <td>' . $row['U_NAME'] .' '. $row['SURNAME'] . '</td>
                        <td>' . $row['t_interest'] . '</td>
                        <td>' . $row['asso_name'] . '</td>
                       <td>' . $row['t_name'] . '</td>
                        <td><a href="#" data="' . $row['U_ID'] . '" class="afficher btn btn-sm" role="button">Voir</a></td>
                        <td><a href="./index.php?EX=writeMessages&dest='.$row['LOGIN'].'" data="' . $row['LOGIN']. '" class="btn btn-sm" role="button">Msg</a></td>
                      </tr>';
            }
            $dataPagination = paginate($pageActual, $numberPages);
        } else {
            $data.= "<tr><td colspan='7' class='cent'><b class='red'>Pas de resultats</b></td></tr>";
            $dataPagination = "";
        }

        $miarray = array('resultado' => $data, 'pag'=> $dataPagination);
        echo json_encode($miarray);

    }

    if(isset($_POST['idDetailUser'])) {
        $id = $_POST['idDetailUser'];


        $pdo = new MDBase();
        $pdo->exec("set names utf8");
        $params = array($id);

        $sql = 'SELECT USER.ID as user_id, USER.NAME as user_name, USER.SURNAME, USER.MAIL, th1.NAME as theme_name1, th2.NAME as theme_name2,
                  USER.ADRESS , USER.CP, USER.PROFESSION, ASSOCIATION.NAME as asso_name, USER.PHOTOPATH,
                  USER.ROLE, USER.PRESENTATION
                  FROM USER
                  INNER JOIN ASSOCIATION  ON USER.ASSOCIATION_ID = ASSOCIATION.ID
                  LEFT JOIN THEME th1 on  th1.ID = USER.THEME_ID
                  LEFT JOIN THEME th2 on  th2.ID = USER.THEME_INTEREST_ID
                  WHERE (USER.ID  = ?)';
        $prep = $pdo->prepare($sql);
        $prep->execute($params);

        $rows = $prep->fetchAll(PDO::FETCH_ASSOC);
        if ($rows) {
            foreach ($rows as $row) {
                if(!$row['theme_name1']){
                    $row['theme_name1']="<b class='red'>Pas de theme d'interest</b>";
                }
                if(!$row['theme_name2']){
                    $row['theme_name2']="<b class='red'>Pas de theme d'interest</b>";
                }

                echo ' <span class="button b-close"><span>X</span></span><p><h3>Profil de ' . $row['user_name'] . '</h3></p><table class="table table-striped t-profil">
                    <tr><th>Prenom:</th><td>' . $row['user_name'] . '</td><td rowspan="5" class="image-profil-background"><img src="' . $row['PHOTOPATH'] . '" width="150px"></td></tr>
                    <tr><th>Nom: </th><td>' . $row['SURNAME'] . '</td></tr>
                    <tr><th>CP</th><td>' . $row['CP'] . '</td></tr>
                    <tr><th>Profession:</th><td>' . $row['PROFESSION'] . '</td></tr>
                    <tr><th>Role:</th><td>' . $row['ROLE'] . '</td></tr>
                    <tr><th>Association:</th><td colspan="2">' . $row['asso_name'] . '</td></tr>
                    <tr><th>Theme interest principalle:</th><td colspan="2">' . $row['theme_name1'] . '</td></tr>
                    <tr><th>Theme interest secondaire:</th><td colspan="2">' . $row['theme_name2'] . '</td></tr>
                    <tr><th>Presentation:</th><td colspan="2">' . $row['PRESENTATION'] . '</td></tr>
                </table>';
            }
        } else {
            echo "<span class='button b-close'><span>X</span></span><p><h3>Une erreur s'est produite.</h3></p>";
        }
    }
}
?>