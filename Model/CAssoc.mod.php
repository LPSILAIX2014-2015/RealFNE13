<?php

    class CAssoc {

        private $sql;

        private $id;
        private $name;
        private $territory;

        function __construct ($id) {
            $sql = new DBase();
            $state = $sql->prepare("SELECT * FROM ASSOCIATION WHERE ID = $id;");
            $state->execute();
            $assoc = $state->fetch(PDO::FETCH_ASSOC);

            $this->id = $id;
            $this->name = $assoc['NAME'];
            $this->territory= $assoc['TERRITORY'];
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

    }