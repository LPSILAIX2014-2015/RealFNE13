<?php
<<<<<<< HEAD
/**
 * Created by PhpStorm.
 * User: d1103406
 * Date: 07/01/15
 * Time: 13:43
 */
=======

>>>>>>> dev_sc
    class MPost {

        private $sql;

        private $id;
        private $title;
        private $description;
        private $pdate;
<<<<<<< HEAD
        private $duration;
=======
        private $start;
        private $end;
>>>>>>> dev_sc
        private $content;
        private $status;
        private $imagepath;
        private $writer_id;

        function __construct ($id) {
<<<<<<< HEAD
            $sql = new MDBase();
            $state = $sql->prepare("SELECT * FROM POST WHERE ID = :id;");
=======
            $this->sql = new MDBase();
            $state = $this->sql->prepare("SELECT * FROM POST WHERE ID = :id;");
>>>>>>> dev_sc
            $state->bindValue('id', $id, PDO::PARAM_INT);
            $state->execute();
            $post = $state->fetch(PDO::FETCH_ASSOC);

            $this->id = $id;
            $this->title = $post['TITLE'];
            $this->description = $post['DESCRIPTION'];
            $this->pdate = $post['PDATE'];
<<<<<<< HEAD
            $this->duration = $post['DURATION'];
=======
>>>>>>> dev_sc
            $this->content = $post['CONTENT'];
            $this->status = $post['STATUS'];
            $this->imagepath = $post['IMAGEPATH'];
            $this->writer_id = $post['TITLE'];
        }

<<<<<<< HEAD
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
         * @param mixed $description
         */
        public function setDescription($description)
        {
            $this->description = $description;
        }

        /**
         * @return mixed
         */
        public function getDescription()
        {
            return $this->description;
        }

        /**
         * @param mixed $duration
         */
        public function setDuration($duration)
        {
            $this->duration = $duration;
        }

        /**
         * @return mixed
         */
        public function getDuration()
        {
            return $this->duration;
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
         * @param mixed $imagepath
         */
        public function setImagepath($imagepath)
        {
            $this->imagepath = $imagepath;
        }

        /**
         * @return mixed
         */
        public function getImagepath()
        {
            return $this->imagepath;
        }

        /**
         * @param mixed $pdate
         */
        public function setPdate($pdate)
        {
            $this->pdate = $pdate;
        }

        /**
         * @return mixed
         */
        public function getPdate()
        {
            return $this->pdate;
        }

        /**
         * @param mixed $status
         */
        public function setStatus($status)
        {
            $this->status = $status;
        }

        /**
         * @return mixed
         */
        public function getStatus()
        {
            return $this->status;
        }

        /**
         * @param mixed $title
         */
        public function setTitle($title)
        {
            $this->title = $title;
        }

        /**
         * @return mixed
         */
        public function getTitle()
        {
            return $this->title;
        }

        /**
         * @param mixed $writer_id
         */
        public function setWriterId($writer_id)
        {
            $this->writer_id = $writer_id;
        }

        /**
         * @return mixed
         */
        public function getWriterId()
        {
            return $this->writer_id;
        }
=======
        // Getters
        public function getId() { return $this->id; }
        public function getTitle() { return $this->title; }
        public function getDescription() { return $this->description; }
        public function getPdate() { return $this->pdate; }
        public function getStart() { return $this->start; }
        public function getEnd() { return $this->end; }
        public function getContent() { return $this->content; }
        public function getStatus() { return $this->status; }
        public function getImagepath() { return $this->imagepath; }
        public function getWriterId() { return $this->writer_id; }


        // Setters
        public function setContent($content)
        {
            $this->content = $content;
            $this->sql->exec('UPDATE POST SET CONTENT = \''.$content.'\' WHERE ID = '.$this->id.' ;');
        }

        public function setDescription($description)
        {
            $this->description = $description;
            $this->sql->exec('UPDATE POST SET DESCRIPTION = \''.$description.'\' WHERE ID = '.$this->id.' ;');
        }


        public function setStart($start)
        {
            $this->duration = $start;
            $this->sql->exec('UPDATE POST SET START = \''.$start.'\' WHERE ID = '.$this->id.' ;');
        }

        public function setEnd($end)
        {
            $this->duration = $end;
            $this->sql->exec('UPDATE POST SET END = \''.$end.'\' WHERE ID = '.$this->id.' ;');
        }

        public function setImagepath($imagepath)
        {
            $this->imagepath = $imagepath;
            $this->sql->exec('UPDATE POST SET IMAGEPATH = \''.$imagepath.'\' WHERE ID = '.$this->id.' ;');
        }


        public function setPdate($pdate)
        {
            $this->pdate = $pdate;
            $this->sql->exec('UPDATE POST SET PDATE = \''.$pdate.'\' WHERE ID = '.$this->id.' ;');
        }


        public function setStatus($status)
        {
            $this->status = $status;
            $this->sql->exec('UPDATE POST SET STATUS = \''.$status.'\' WHERE ID = '.$this->id.' ;');
        }


        public function setTitle($title)
        {
            $this->title = $title;
            $this->sql->exec('UPDATE POST SET TITLE = \''.$this.'\' WHERE ID = '.$this->id.' ;');
        }


        public function setWriterId($writer_id)
        {
            $this->writer_id = $writer_id;
            $this->sql->exec('UPDATE POST SET WRITER_ID = \''.$writer_id.'\' WHERE ID = '.$this->id.' ;');
        }

>>>>>>> dev_sc

    }