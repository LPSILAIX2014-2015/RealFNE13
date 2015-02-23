<?php
class VHome
{
    public function __construct(){}

    public function __destruct(){}

    public function showHome($path)
    {
        $vhtml = new VHtml();
        $vhtml->showHtml($path);

    } // showHome($_html)

} // VHtml
?>