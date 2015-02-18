<?php

class MCloud {

    private $sql;

    function __construct () {
        $this->sql = new MDBase();
    }

    public function insertCloud($idUser, $filename, $size) {

        $state = $this->sql->prepare("INSERT INTO CLOUD (
            USER_ID,
            PATH_FILE,
            SIZE,
            CDATE
            ) VALUES (
            :USER_ID,
            :PATH_FILE,
            :SIZE,
            NOW()                            
            )");
        $state->bindValue('USER_ID', $idUser, PDO::PARAM_INT);
        $state->bindValue('PATH_FILE', $filename, PDO::PARAM_STR);
        $state->bindValue('SIZE', $size, PDO::PARAM_INT);
        $state->execute();    
        
        return true;
    }

    public function getIdAssoByIdUser($idUser) {

        $state = $this->sql->prepare("SELECT ASSOCIATION_ID FROM USER WHERE ID = :idUser");
        $state->bindValue('idUser', $idUser, PDO::PARAM_INT);
        $state->execute();
        $results = $state->fetch(PDO::FETCH_ASSOC);
        
        return $results['ASSOCIATION_ID'];
    }

    public function getCloudByUser($idUser) {

        $state = $this->sql->prepare("SELECT C.*, U2.NAME NAME_USER, U2.SURNAME SURNAME_USER
             FROM USER U, CLOUD C, USER U2
            WHERE U.ID = :idUser
        AND U.ASSOCIATION_ID = U2.ASSOCIATION_ID
        AND U2.ID = C.USER_ID");

        $state->bindValue('idUser', $idUser, PDO::PARAM_INT);
        $state->execute();
        $results = $state->fetchAll(PDO::FETCH_ASSOC);
        for($i = 0 ; $i < count($results) ; ++$i)
        {
            $date = $results[$i]["CDATE"];
            $date = explode('-', $date);
            

            $currentDate = $date[2].'/'.$date[1].'/'.$date[0];
            $results[$i]["CDATE"] = $currentDate; 
        }
        return $results;
    }

    public function getCloudById($id) {

        $state = $this->sql->prepare("SELECT * FROM CLOUD WHERE ID = :id");
        $state->bindValue('id', $id, PDO::PARAM_INT);
        $state->execute();
        $results = $state->fetch(PDO::FETCH_ASSOC);
        $date = $results["CDATE"];
        $date = explode('-', $date);
        $currentDate = $date[2].'/'.$date[1].'/'.$date[0];
        $results["CDATE"] = $currentDate;
        
        return $results;
    }

    public function getAssoSize($idAsso, $newSize) {

        //Taille maximale alloué à une association
        $maxSize = 104857600;

        $state = $this->sql->prepare("SELECT SUM(C.SIZE) nbr
            FROM USER U, CLOUD C
            WHERE U.ASSOCIATION_ID = :idAsso
            AND C.USER_ID = U.ID");
        $state->bindValue('idAsso', $idAsso, PDO::PARAM_INT);
        $state->execute();    
        $results = $state->fetch(PDO::FETCH_ASSOC);
        $size = $results['nbr'];


        return $size + $newSize < $maxSize;

    }

    public function getPercent($nbr) {
        
        //Taille maximale alloué à une association
        $maxSize = 104857600;

        return ceil($nbr / $maxSize * 100);
    }

    public function getAssoSizeUpload($idUser) {

        $state = $this->sql->prepare("SELECT SUM(C.SIZE) nbr
            FROM USER U, CLOUD C, USER U2
            WHERE U.ID = :idUser
            AND U.ASSOCIATION_ID = U2.ASSOCIATION_ID
            AND U2.ID = C.USER_ID");
        $state->bindValue('idUser', $idUser, PDO::PARAM_INT);
        $state->execute();    
        $results = $state->fetch(PDO::FETCH_ASSOC);
        $size = $results['nbr'];

        return $size;

    }

    public function checkSpaceAvailable($newSize, $idAsso) {

        return $this->getAssoSize($idAsso, $newSize);

    }

    public function displayCloud($data_cloud) {

        $content_Cloud = "";
        for($i = 0 ; $i < count($data_cloud) ; ++$i)
        {
            $content_Cloud .= '<tr  class="lineCloud" id="cloud'.$data_cloud[$i]['ID'].'" '; 
            $content_Cloud .= '>';
            
            $content_Cloud .= '<td class="currentTdMessage">'.$this->getPercent($data_cloud[$i]['SIZE']).'%</td>';
            $content_Cloud .= '<td class="trCenter currentTdMessage">'.$data_cloud[$i]['SURNAME_USER']." ".$data_cloud[$i]['NAME_USER'].'</td>';
            $content_Cloud .= '<td class="currentTdMessage">'.$data_cloud[$i]['PATH_FILE'].'</td>';
            $content_Cloud .= '<td class="currentTdMessage">'.$data_cloud[$i]['CDATE'].'</td>';

            $content_Cloud .= '
            <td>
                <a target="_blank" href="index.php?EX=downloadCloud&id='.$data_cloud[$i]['ID'].'"><button title="Télécharger" class="buttonDownloadCloud">Télécharger</button></a>
                <button title="Supprimer" class="buttonDeleteCloud">Supprimer</button>
            </div>';
            $content_Cloud .= '</td>';       


            $content_Cloud .= '<tr />';
        }
        return $content_Cloud;
    }


}