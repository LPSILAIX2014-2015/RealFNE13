<?php
/**
 * Created by PhpStorm.
 * User: d1103406
 * Date: 07/01/15
 * Time: 13:42
 */

    class MTheme {

        private $sql;

        private $id;
        private $name;

        function __construct ($id) {
            $this->sql = new MDBase();
            $state = $this->sql->prepare("SELECT * FROM THEME WHERE ID = :id;");
            $state->bindValue('id', $id, PDO::PARAM_INT);
            $state->execute();
            $theme = $state->fetch(PDO::FETCH_ASSOC);

            $this->id = $id;
            $this->name = $theme['NAME'];
        }


        // Getters
        public function getId() { return $this->id; }
        public function getName() { return $this->name; }

        // Setters
        public function setName($name)
        {
            $this->name = $name;
            $this->sql->exec('UPDATE THEME SET NAME = \''.$name.'\' WHERE ID = '.$this->id.' ;');

        }


    }