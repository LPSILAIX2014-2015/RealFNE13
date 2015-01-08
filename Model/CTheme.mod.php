<?php
/**
 * Created by PhpStorm.
 * User: d1103406
 * Date: 07/01/15
 * Time: 13:42
 */

    class CTheme {

        private $sql;

        private $id;
        private $name;

        function __construct ($id) {
            $sql = new DBase();
            $state = $sql->prepare("SELECT * FROM THEME WHERE ID = $id;");
            $state->execute();
            $theme = $state->fetch(PDO::FETCH_ASSOC);

            $this->id = $id;
            $this->name = $theme['NAME'];
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