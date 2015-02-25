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

        $state = $this->sql->prepare("SELECT ID, TITLE, BEGIN, DURATION  FROM post WHERE BEGIN IS NOT null;");
        /*test
        $r = array ();
        while ($events = $state->fetch(FETCH_OBJ)){
            $r[strtotime($events->date)][$events->ID]=$events->TITLE;
        }
        return $r;

        fin test */

        $state->execute();
        $events = $state->fetchAll(PDO::FETCH_ASSOC);

        /*$this->ID = $events['ID'];
        $this->TITLE = $events['TITLE'];
        $this->BEGIN = $events['BEGIN'];
        $this->DURATION = $events['DURATION'];*/
        /*print_r($events);*/

        return $events;
    }

     public function getID() { return $this->ID; }
     public function getTITLE() { return $this->TITLE; }
     public function getBEGIN() { return $this->BEGIN; }
     public function getDURATION() { return $this->DURATION; }
    
}
?>