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
            $this->sql = new MDBase();
            $state = $this->sql->prepare("SELECT * FROM NEWSLETTER WHERE ID = :id;");
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
            $this->sql->exec('UPDATE NEWSLETTER SET CONTENT = \''.$content.'\' WHERE ID = '.$this->id.' ;');
        }

        public function setRdate($rdate)
        {
            $this->rdate = $rdate;
            $this->sql->exec('UPDATE NEWSLETTER SET RDATE = \''.$rdate.'\' WHERE ID = '.$this->id.' ;');
        }

        public function setType($type)
        {
            $this->type = $type;
            $this->sql->exec('UPDATE NEWSLETTER SET TYPE = \''.$type.'\' WHERE ID = '.$this->id.' ;');
        }

    }