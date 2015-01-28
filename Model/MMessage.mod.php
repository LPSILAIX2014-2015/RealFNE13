<?php
/*
 * Created by PhpStorm.
 * User: d1103406
 * Date: 07/01/15
 * Time: 13:42
 */

     class MMessage {

        private $id;
        private $title;
        private $content;
        private $sender_id;
        private $receiver_id;

        function __construct ($id) {
            $sql = new MDBase();
            $state = $sql->prepare("SELECT * FROM MESSAGE WHERE ID = :id;");
            $state->bindValue('id', $id, PDO::PARAM_INT);
            $state->execute();
            $message = $state->fetch(PDO::FETCH_ASSOC);

            $this->id = $id;
            $this->title = $message['TITLE'];
            $this->content = $message['CONTENT'];
            $this->sender_id = $message['SENDER_ID'];
            $this->receiver_id = $message['RECEIVER_ID'];
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
          * @param mixed $receiver_id
          */
         public function setReceiverId($receiver_id)
         {
             $this->receiver_id = $receiver_id;
         }

         /**
          * @return mixed
          */
         public function getReceiverId()
         {
             return $this->receiver_id;
         }

         /**
          * @param mixed $sender_id
          */
         public function setSenderId($sender_id)
         {
             $this->sender_id = $sender_id;
         }

         /**
          * @return mixed
          */
         public function getSenderId()
         {
             return $this->sender_id;
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

     }