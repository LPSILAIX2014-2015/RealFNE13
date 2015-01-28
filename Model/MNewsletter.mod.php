<?php
/**
 * Created by PhpStorm.
 * User: d1103406
 * Date: 07/01/15
 * Time: 13:43
 */
    class MNewsletter {

        private $sql;

        private $id;
        private $rdate;
        private $type;
        private $content;

        function __construct ($id) {
            $sql = new MDBase();
            $state = $sql->prepare("SELECT * FROM NEWSLETTER WHERE ID = :id;");
            $state->bindValue('id', $id, PDO::PARAM_INT);
            $state->execute();
            $newsl = $state->fetch(PDO::FETCH_ASSOC);

            $this->id = $id;
            $this->rdate = $newsl['RDATE'];
            $this->type = $newsl['TYPE'];
            $this->content = $newsl['CONTENT'];
        }


        // Getters
        public function getId() { return $this->id; }
        public function getRdate() { return $this->rdate; }
        public function getType() { return $this->type; }
        public function getContent() { return $this->content; }

        // Setters
        public function setContent($content)
        {
            $this->content = $content;
            $this->sql->exec('UPDATE NEWS SET CONTENT = \''.$content.'\' WHERE ID = '.$this->id.' ;');
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