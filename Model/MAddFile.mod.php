<?php

class MAddFile {

    private $sql;

    function __construct () {
        $this->sql = new MDBase();
    }

    public function addFile($data) {

        echo "<pre>";
        var_dump($_FILES);
        echo "</pre>";

        $idUser = $_SESSION['ID_USER'];
        $idAsso = 

        $file = $_FILES['file'];
        $filename = $file['name'];

        $mCloud = new MCloud();

        $state = $this->sql->prepare("SELECT U.ASSOCIATION_ID id
                                    FROM USER U
                                    WHERE U.ID = :idUser");
        $state->bindValue('idUser', $_SESSION['ID_USER'], PDO::PARAM_INT);
        $state->execute();    
        $results = $state->fetch(PDO::FETCH_ASSOC);

        $idAsso = $results['id'];
        if($mCloud->checkSpaceAvailable($file['size'], $idAsso))
        {
            $date = new DateTime('now');
            $date = md5($date->format('Y-m-d h:i:s'));
            $rand = substr($date, 0, 4);

            $filename = preg_replace('#[^.a-z0-9_-]+#i', '', $filename);
            $filename = $rand.'-'.$filename;

            $mCloud->insertCloud($idUser, $filename, $file['size']);

           $rst = move_uploaded_file($file['tmp_name'], 'Cloud/'.$filename);

        }
}


}