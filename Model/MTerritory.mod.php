<?php
/**
 * Created by PhpStorm.
 * User: d1103406
 * Date: 07/01/15
 * Time: 13:42
 */

class MTerritory {

    private $sql;

    private $id;
    private $name;

    function __construct ($id) {
        $this->sql = new MDBase();
        $state = $this->sql->prepare("SELECT * FROM TERRITORY WHERE ID = :id;");
        $state->bindValue('id', $id, PDO::PARAM_INT);
        $state->execute();
        $territory = $state->fetch(PDO::FETCH_ASSOC);

        $this->id = $id;
        $this->name = $territory['NAME'];
    }

    // Getter
    public function getId() { return $this->id; }
    public function getName() { return $this->name; }

    // Setter
    public function setName($name)
    {
        $this->name = $name;
        $this->sql->exec('UPDATE TERRITORY SET NAME = \''.$name.'\' WHERE ID = '.$this->id.' ;');
    }

}