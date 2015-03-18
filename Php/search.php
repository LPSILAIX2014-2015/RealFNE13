<?php
global $user;

header('content-type: text/html; charset=utf-8');
require_once('../Model/MDBase.mod.php');
require_once('../Model/MUser.mod.php');
require('../Inc/require.inc.php');
include('paginationRechercheMembre.php');
/**
 * Created by PhpStorm.
 * User: Joaquin
 * Date: 11/02/2015
 * Time: 09:21 AM
 */


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $value = $_GET['nombre'];
    $type = $_GET['valor'];


    if ($value == "" || $value == null) {
        $userinfo = [];
        echo json_encode($userinfo);
    } else {
        $pdo = new MDBase();
        $pdo->exec("set names utf8");
        $params = array("%$value%");

        if ($type == "email") {

            $sql = 'SELECT * FROM USER u WHERE MAIL LIKE ? ORDER BY NAME ASC LIMIT 3';
            $prep = $pdo->prepare($sql);
            $prep->execute($params);

            $rows = $prep->fetchAll(PDO::FETCH_ASSOC);

            $userinfo = $rows;

            echo json_encode($userinfo);


        } elseif ($type == "name") {
            $sql = 'SELECT * FROM USER u WHERE NAME LIKE ? ORDER BY NAME ASC LIMIT 3';
            $prep = $pdo->prepare($sql);
            $prep->execute($params);

            $rows = $prep->fetchAll();

            $userinfo = $rows;
            //var_dump(json_decode($userinfo));
            //header('Content-Type: application/json');

            echo json_encode($userinfo);

        } elseif ($type == "surname") {
            $sql = 'SELECT * FROM USER u WHERE SURNAME LIKE ? ORDER BY NAME ASC LIMIT 3';
            $prep = $pdo->prepare($sql);
            $prep->execute($params);

            $rows = $prep->fetchAll();

            $userinfo = $rows;
            //var_dump(json_decode($userinfo));
            //header('Content-Type: application/json');

            echo json_encode($userinfo);

        } elseif ($type == "cp") {
            $sql = 'SELECT * FROM USER u WHERE CP LIKE ? ORDER BY NAME ASC LIMIT 3';
            $prep = $pdo->prepare($sql);
            $prep->execute($params);

            $rows = $prep->fetchAll();

            $userinfo = $rows;
            //var_dump(json_decode($userinfo));
            //header('Content-Type: application/json');

            echo json_encode($userinfo);

        } elseif ($type == "prof") {
            $sql = 'SELECT * FROM USER u WHERE PROFESSION LIKE ? ORDER BY NAME ASC LIMIT 3';
            $prep = $pdo->prepare($sql);
            $prep->execute($params);

            $rows = $prep->fetchAll();

            $userinfo = $rows;
            //var_dump(json_decode($userinfo));
            //header('Content-Type: application/json');

            echo json_encode($userinfo);

        } elseif ($type == "asso") {
            $sql = 'SELECT user.* FROM USER INNER JOIN ASSOCIATION ON USER.ASSOCIATION_ID = ASSOCIATION.ID WHERE (ASSOCIATION.NAME LIKE ? )  LIMIT 3';
            $prep = $pdo->prepare($sql);
            $prep->execute($params);

            $rows = $prep->fetchAll();

            $userinfo = $rows;
            //var_dump(json_decode($userinfo));
            //header('Content-Type: application/json');

            echo json_encode($userinfo);

        }


    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numberPages = '';
    $numberRegistries = '';
    $resultsParPage = 5; //# of results for page

    if (isset($_POST['asso'])) {
        //Pagination variables
        $pageActual = $_POST['page'];

        //End pagination variables
        $firstRegistry = ($pageActual - 1) * $resultsParPage;

        $id = $_POST['asso'];

        $pdo = new MDBase();
        $pdo->exec("set names utf8");
        $params = array($id);

        //For obtain number of members
        $sql0 ="SELECT count(*) FROM USER WHERE USER.ASSOCIATION_ID  = $id";
        $prep0 = $pdo->prepare($sql0);
        $prep0->execute();
        $rNMB = $prep0->fetchColumn();

        //For obtain data from page received
        $sql = "SELECT USER.ID as user_id, USER.LOGIN, USER.NAME as user_name, USER.SURNAME, TERRITORY.NAME as t_name, USER.MAIL, THEME.NAME as th_name, USER.ADRESS , USER.CP, USER.PROFESSION, ASSOCIATION.NAME as asso_name, USER.PHOTOPATH
                FROM USER
                INNER JOIN ASSOCIATION  ON USER.ASSOCIATION_ID = ASSOCIATION.ID
                INNER JOIN TERRITORY ON ASSOCIATION.TERRITORY_ID = TERRITORY.ID
                LEFT JOIN THEME on USER.THEME_ID = THEME.ID
                WHERE (USER.ASSOCIATION_ID  = ?) LIMIT $firstRegistry, $resultsParPage";
        $prep = $pdo->prepare($sql);
        $prep->execute($params);
        $rows = $prep->fetchAll(PDO::FETCH_ASSOC);

        $numberPages =ceil($rNMB / $resultsParPage);
        $data = '';

        if ($rows) {
            foreach ($rows as $row) {
                if(!$row['th_name']){
                    $row['th_name']="<b class='red'>Pas de theme d'interest</b>";
                }
                $data.=  '<tr>
                            <td>' . $row['user_name'] .' '. $row['SURNAME'] . '</td>
                            <td>' . $row['th_name'] . '</td>
                            <td>' . $row['asso_name'] . '</td>
                            <td>' . $row['t_name'] . '</td>
                            <td><a href="#" data="' . $row['user_id'] . '" class="afficher btn btn-sm btn-table" role="button">Voir</a></td>
                            <td><a href="./index.php?EX=writeMessages&dest='.$row['LOGIN'].'" data="' . $row['LOGIN']. '" class="btn btn-sm btn-table" role="button">Envoyer &raquo;</a></td>
                            </tr>';
            }
        }
        else {
            $data.= "<tr><td colspan='7' class='cent'><b class='red'>Pas de resultats</b></td></tr>";
        }
        $dataPagination = paginate($pageActual, $numberPages);
        $miarray = array('resultado' => $data, 'pag'=> $dataPagination );
        echo json_encode($miarray);

    }
    if (isset($_POST['all'])) {
        //Pagination variables
        $pageActual = $_POST['page'];
        //End pagination variables
        $firstRegistry = ($pageActual - 1) * $resultsParPage;

        $pdo = new MDBase();
        $pdo->exec("set names utf8");
        $sql = "SELECT USER.ID AS USER_ID, USER.LOGIN, USER.NAME AS USER_NAME, USER.SURNAME, THEME.NAME AS THEME_NAME,
                  TERRITORY.NAME AS T_NAME, USER.MAIL, THEME.NAME AS TH_NAME, USER.ADRESS , USER.CP,
                  USER.PROFESSION, ASSOCIATION.NAME AS ASSO_NAME, USER.PHOTOPATH
                FROM USER INNER JOIN ASSOCIATION  ON USER.ASSOCIATION_ID = ASSOCIATION.ID
                INNER JOIN TERRITORY ON ASSOCIATION.TERRITORY_ID = TERRITORY.ID
                LEFT JOIN THEME ON USER.THEME_ID = THEME.ID
                ORDER BY ASSO_NAME ASC LIMIT $firstRegistry, $resultsParPage";

        $sql0 ="SELECT count(*) FROM USER";
        $prep0 = $pdo->prepare($sql0);
        $prep0->execute();
        $rNMB = $prep0->fetchColumn();

        $prep = $pdo->prepare($sql);
        $prep->execute();
        $rows = $prep->fetchAll(PDO::FETCH_ASSOC);

        $numberRegistries = count($rows);
        $numberPages =ceil($rNMB / $resultsParPage);
        $data = '';
        if ($rows) {
            foreach ($rows as $row) {
                if(!$row['theme_name'])
                {
                    $row['theme_name']= "<b class='red'>Pas de theme d'interest</b>";
                }
                $data.= '<tr>
                            <td>' . $row['user_name'] . ' ' . $row['SURNAME'] . '</td>
                            <td>' . $row['theme_name'] . '</td>
                            <td>' . $row['asso_name'] . '</td>
                            <td>' . $row['t_name'] . '</td>
                            <td><a href="#" data="' . $row['user_id'] . '" class="afficher btn btn-sm btn-table" role="button">Voir</a></td>
                            <td><a href="./index.php?EX=writeMessages&dest=' . $row['LOGIN'] . '" data="' . $row['LOGIN'] . '" class="btn btn-sm btn-table" role="button">Envoyer &raquo;</a></td>
                            </tr>';
            }
            $dataPagination = paginate($pageActual, $numberPages);
        }
        else {
            $data.= "<tr><td colspan='7' class='cent'><b class='red'>Pas de resultats</b></td></tr>";
            $dataPagination = "";
        }


        $miarray = array('resultado' => str_replace(PHP_EOL, '', $data), 'pag'=> $dataPagination );
        echo json_encode($miarray);
    }
}

?>

