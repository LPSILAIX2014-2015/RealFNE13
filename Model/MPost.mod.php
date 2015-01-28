<?php
/**
 * Created by PhpStorm.
 * User: d1103406
 * Date: 07/01/15
 * Time: 13:43
 */
    class MPost {

        private $sql;

        private $id;
        private $title;
        private $description;
        private $pdate;
        private $duration;
        private $content;
        private $status;
        private $imagepath;
        private $writer_id;

        function __construct ($id) {
            $sql = new MDBase();
            $state = $sql->prepare("SELECT * FROM POST WHERE ID = :id;");
            $state->bindValue('id', $id, PDO::PARAM_INT);
            $state->execute();
            $post = $state->fetch(PDO::FETCH_ASSOC);

            $this->id = $id;
            $this->title = $post['TITLE'];
            $this->description = $post['DESCRIPTION'];
            $this->pdate = $post['PDATE'];
            $this->duration = $post['DURATION'];
            $this->content = $post['CONTENT'];
            $this->status = $post['STATUS'];
            $this->imagepath = $post['IMAGEPATH'];
            $this->writer_id = $post['TITLE'];
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

    }