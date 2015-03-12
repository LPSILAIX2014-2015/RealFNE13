<?php

class MGetLogo {

    private $sql;

    function __construct () {
        $this->sql = new MDBase();
    }
    
    public function getInfoLogo($idAsso) {

        $state = $this->sql->prepare("SELECT A.NAME NAME_ASSO, TH.NAME NAME_THEME, TE.NAME NAME_TERRITORY
        FROM ASSOCIATION A, TERRITORY TE, THEME TH
        WHERE A.ID = :idAsso
        AND A.TERRITORY_ID = TE.ID
        AND A.THEME_ID = TH.ID");

        $state->bindValue('idAsso', $idAsso, PDO::PARAM_INT);
        $state->execute();    
        $results = $state->fetch(PDO::FETCH_ASSOC);

        return $results;

    }

}