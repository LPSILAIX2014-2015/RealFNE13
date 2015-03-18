<?php
class MEventCalendar
{
    private $sql;
    private $ID;
    private $TITLE;
    private $BEGIN;
    private $DURATION;

    function __construct () {
        $this->sql = new MDBase();
       
    }

    public function __destruct(){}

    public function getEventCalendar(){

<<<<<<< HEAD
        $state = $this->sql->prepare("SELECT ID, TITLE, DATE_BEGIN, DURATION  FROM POST WHERE DATE_BEGIN IS NOT null;");
=======
        $state = $this->sql->prepare("SELECT ID, TITLE, DATE_BEGIN, DURATION  FROM post WHERE DATE_BEGIN IS NOT null;");
      
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b

        $state->execute();
        $events = $state->fetchAll(PDO::FETCH_ASSOC);

        return $events;
    }
    
}
?>