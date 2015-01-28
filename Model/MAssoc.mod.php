<?php

    class MAssoc {

        private $sql;

        private $id;
        private $name;
        private $territory;

        function __construct ($id) {
            $sql = new MDBase();
            $state = $sql->prepare("SELECT * FROM ASSOCIATION WHERE ID = :id");
            $state->bindValue('id', $id, PDO::PARAM_INT);
            $state->execute();
            $assoc = $state->fetch(PDO::FETCH_ASSOC);

            $this->id = $id;
            $this->name = $assoc['NAME'];
            $this->territory= $assoc['TERRITORY_ID'];
        }

        /**
         * @param mixed $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @param mixed $name
         */
        public function setName($name)
        {
            $this->name = $name;
        }

        /**
         * @return mixed
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * @param mixed $territory
         */
        public function setTerritory($territory)
        {
            $this->territory = $territory;
        }

        /**
         * @return mixed
         */
        public function getTerritory()
        {
            return $this->territory;
        }

        public function getMembers(){
            $sql = new MDBase();
            $state = $sql->prepare("SELECT ID, NAME, SURNAME FROM USER WHERE ASSOCIATION_ID = :id ORDER By ROLE ASC");
            $state->bindValue('id', $this->id, PDO::PARAM_INT);
            $state->execute();
            $assoc = $state->fetchall();
            return $assoc;
        }

    }