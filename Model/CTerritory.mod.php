<?php
    /**
     * Created by PhpStorm.
     * User: d1103406
     * Date: 07/01/15
     * Time: 13:42
     */

    class CTerritory {

        private $sql;

        private $id;
        private $name;

        function __construct ($id) {
            $sql = new DBase();
            $state = $sql->prepare("SELECT * FROM TERRITORY WHERE ID = $id;");
            $state->execute();
            $territory = $state->fetch(PDO::FETCH_ASSOC);

            $this->id = $id;
            $this->name = $territory['NAME'];
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

    }