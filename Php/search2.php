<?php
    header('Content-Type: text/html; charset=utf-8');
    require_once('../Model/MDBase.mod.php');
    require_once('../Model/MUser.mod.php');
    require('../Inc/require.inc.php');

    $pdo = new MDBase();
    $pdo->exec("set names utf8");
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $sql = "SELECT DISTINCT ASSOCIATION.ID, ASSOCIATION.NAME as asso_name
                FROM ASSOCIATION
                INNER JOIN USER
                ON ASSOCIATION.ID = USER.ASSOCIATION_ID
                WHERE (USER.LOGIN IS NULL OR USER.LOGIN !='')";
        $q = $pdo->prepare($sql);
        $q->execute();

        $rows = $q->fetchAll(PDO::FETCH_ASSOC);
        if($rows)
        {
            echo json_encode($rows);
        }
        else
        {
            echo json_encode("Pas d'associations");
        }

    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_POST['name_mod'])) {
            $name = $_POST['name_mod'];
            $surname = $_POST['surname_mod'];
            $mail = $_POST['email_mod'];
            $adress = $_POST['adress_mod'];
            $cp = $_POST['cp_mod'];
            $profession = $_POST['profession_mod'];
            $association = $_POST['association_mod'];
            $id = $_POST['id'];

            $params = array("$name", "$surname", $cp, "$mail", "$adress", "$association", "$profession", $id);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE USER set NAME = ?, SURNAME = ?,CP = ?, MAIL = ?, ADRESS = ?, ASSOCIATION_ID = ?, PROFESSION =? WHERE ID = ?";
            $prep = $pdo->prepare($sql);
            $prep->execute($params);

            if ($prep) {
                echo "Super! Record update";
            } else {
                echo "Error";
            }
        } elseif (isset($_POST['name'])) {

            $name = $_POST['name'];
            $params = array("%$name%");
            $sql = "SELECT DISTINCT u.NAME, u.ID
                    FROM USER u
                    WHERE u.NAME
                    LIKE ?
                    AND (u.LOGIN IS NULL OR u.LOGIN!='') ORDER BY u.NAME ASC LIMIT 3";
            $prep = $pdo->prepare($sql);
            $prep->execute($params);

            $rows = $prep->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
                echo '<a class="list-group-item" data="' . $row['NAME'] . '" id="' . $row['ID'] . '">' . $row['NAME'] . '</a>';
            }

        } elseif (isset($_POST['surname'])) {
            $surname = $_POST['surname'];
            $params = array("%$surname%");
            $sql = "SELECT DISTINCT u.ID,u.SURNAME
                    FROM USER u
                    WHERE u.SURNAME
                    LIKE ?
                    AND (u.LOGIN IS NULL OR  u.LOGIN!='')
                     ORDER BY u.SURNAME ASC LIMIT 3";
            $prep = $pdo->prepare($sql);
            $prep->execute($params);

            $rows = $prep->fetchAll(PDO::FETCH_ASSOC);

            foreach ($rows as $row) {
                echo '<a class="list-group-item" data="' . $row['SURNAME'] . '" id="' . $row['ID'] . '">' . $row['SURNAME'] . '</a>';
            }
        } elseif (isset($_POST['email'])) {
            $email = $_POST['email'];
            $params = array("%$email%");
            $sql = "SELECT DISTINCT u.ID, u.MAIL
                    FROM user u
                    WHERE u.MAIL
                    LIKE ?
                    AND (u.LOGIN IS NULL OR  u.LOGIN!='')
                     ORDER BY NAME ASC LIMIT 3";
            $prep = $pdo->prepare($sql);
            $prep->execute($params);

            $rows = $prep->fetchAll(PDO::FETCH_ASSOC);

            foreach ($rows as $row) {
                echo '<a class="list-group-item" data="' . $row['MAIL'] . '" id="' . $row['ID'] . '">' . $row['MAIL'] . '</a>';
            }
        } elseif (isset($_POST['terr'])) {
            $terr = $_POST['terr'];
            $params = array("%$terr%");
            $sql = "SELECT DISTINCT T.ID , T.NAME AS territory_name
                  FROM TERRITORY T
                  INNER JOIN ASSOCIATION ON T.ID = ASSOCIATION.TERRITORY_ID
                  INNER JOIN USER ON ASSOCIATION.TERRITORY_ID = USER.ASSOCIATION_ID
                  WHERE T.NAME LIKE ?
                  AND (USER.LOGIN IS NULL OR USER.LOGIN!='') ORDER BY T.NAME ASC LIMIT 3";
            $prep = $pdo->prepare($sql);
            $prep->execute($params);

            $rows = $prep->fetchAll(PDO::FETCH_ASSOC);

            foreach ($rows as $row) {
                echo '<a class="list-group-item" data="' . $row['territory_name'] . '" id="' . $row['ID'] . '">' . $row['territory_name'] . '</a>';
            }
        } elseif (isset($_POST['profession'])) {
            $profession = $_POST['profession'];
            $params = array("%$profession%");
            $sql = "SELECT DISTINCT u.ID, u.PROFESSION
                    FROM USER u
                    WHERE PROFESSION
                    LIKE ?
                    AND (u.LOGIN IS NULL OR  u.LOGIN!='')
                     ORDER BY NAME ASC LIMIT 3";
            $prep = $pdo->prepare($sql);
            $prep->execute($params);

            $rows = $prep->fetchAll(PDO::FETCH_ASSOC);

            foreach ($rows as $row) {
                echo '<a class="list-group-item" data="' . $row['PROFESSION'] . '" id="' . $row['ID'] . '">' . $row['PROFESSION'] . '</a>';
            }
        } elseif (isset($_POST['association'])) {
            $association = $_POST['association'];
            $params = array("%$association%");
            $sql = "SELECT DISTINCT u.ID, u.ASSOCIATION
                    FROM USER u
                    WHERE ASSOCIATION
                    LIKE '%n'
                    AND (u.LOGIN IS NULL OR  u.LOGIN!='')
                    ORDER BY u.NAME ASC LIMIT 3";
            $prep = $pdo->prepare($sql);
            $prep->execute($params);

            $rows = $prep->fetchAll(PDO::FETCH_ASSOC);

            foreach ($rows as $row) {
                echo 'ctm';
            }
        }
    }

?>