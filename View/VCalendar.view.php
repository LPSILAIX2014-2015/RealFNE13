<?php
class VCalendar
{
    public function __construct(){}

    public function __destruct(){}

    public function showCalendar()
    {
        $vhtml = new VHtml();
        $vhtml->showHtml('Html/calendar.php');

    } // showCalendar($_html)

}
?>