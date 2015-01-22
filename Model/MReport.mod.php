<?php
/**
 * Created by PhpStorm.
 * User: d1103406
 * Date: 07/01/15
 * Time: 13:43
 */
    class MReport {

        private $sql;

        private $id;
        private $rdate;
        private $type;
        private $content;

        function __construct ($id) {
            $sql = new MDBase();
            $state = $sql->prepare("SELECT * FROM REPORT WHERE ID = :id;");
            $state->bindValue('id', $id, PDO::PARAM_INT);
            $state->execute();
            $report = $state->fetch(PDO::FETCH_ASSOC);

            $this->id = $id;
            $this->rdate = $report['RDATE'];
            $this->type = $report['TYPE'];
            $this->content = $report['CONTENT'];
        }

        /**
         * @param mixed $content
         */
        public function setContent($content)
        {
            $this->content = $content;
        }

        /**
         * @return mixed
         */
        public function getContent()
        {
            return $this->content;
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
         * @param mixed $rdate
         */
        public function setRdate($rdate)
        {
            $this->rdate = $rdate;
        }

        /**
         * @return mixed
         */
        public function getRdate()
        {
            return $this->rdate;
        }

        /**
         * @param mixed $type
         */
        public function setType($type)
        {
            $this->type = $type;
        }

        /**
         * @return mixed
         */
        public function getType()
        {
            return $this->type;
        }




    }