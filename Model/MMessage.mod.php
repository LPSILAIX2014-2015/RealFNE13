<?php

class MMessage {

    private $sql;

    private $id;
    private $title;
    private $content;
    private $sender_id;
    private $receiver_id;
    private $theme_id;
    private $cat_id;

    function __construct ($id) {
        $this->sql = new MDBase();
        $state = $this->sql->prepare("SELECT * FROM MESSAGE WHERE ID = :id;");
        $state->bindValue('id', $id, PDO::PARAM_INT);
        $state->execute();
        $message = $state->fetch(PDO::FETCH_ASSOC);

        $this->id = $id;
        $this->title = $message['TITLE'];
        $this->content = $message['CONTENT'];
        $this->sender_id = $message['SENDER_ID'];
        $this->receiver_id = $message['RECEIVER_ID'];
        $this->theme_id = $message['THEME_ID'];
        $this->cat_id = $message['CAT_ID'];
    }

    // Getters
    public function getId() { return $this->id; }
    public function getTitle() { return $this->title; }
    public function getSenderId() { return $this->sender_id; }
    public function getContent() { return $this->content; }
    public function getThemeId() { return $this->theme_id; }
    public function getCatId() { return $this->cat_id; }


    // Setters
    public function setContent($content)

    {
        $this->content = $content;
        $this->sql->exec('UPDATE MESSAGE SET CONTENT = \''.$content.'\' WHERE ID = '.$this->id.' ;');
    }

    public function setReceiverId($receiver_id)
    {
        $this->receiver_id = $receiver_id;
        $this->sql->exec('UPDATE MESSAGE SET RECEIVER_ID = \''.$receiver_id.'\' WHERE ID = '.$this->id.' ;');
    }

    public function setSenderId($sender_id)
    {
        $this->sender_id = $sender_id;
        $this->sql->exec('UPDATE MESSAGE SET SENDER_ID = \''.$sender_id.'\' WHERE ID = '.$this->id.' ;');
    }

    public function setTitle($title)
    {
        $this->title = $title;
        $this->sql->exec('UPDATE MESSAGE SET TITLE = \''.$title.'\' WHERE ID = '.$this->id.' ;');
    }

    public function setThemeId($theme_id)
    {
        $this->theme_id = $theme_id;
        $this->sql->exec('UPDATE MESSAGE SET SENDER_ID = \''.$theme_id.'\' WHERE ID = '.$this->id.' ;');
    }

    public function setCatId($cat_id)
    {
        $this->title = $cat_id;
        $this->sql->exec('UPDATE MESSAGE SET TITLE = \''.$cat_id.'\' WHERE ID = '.$this->id.' ;');
    }

}