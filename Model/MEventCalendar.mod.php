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

        $state = $this->sql->prepare("SELECT ID, TITLE, DATE_BEGIN, DURATION  FROM POST WHERE DATE_BEGIN IS NOT null;");

        $state->execute();
        $events = $state->fetchAll(PDO::FETCH_ASSOC);

        return $events;
    }
    
}
?>