<?php
class VArticle
{
    public function __construct(){}

    public function __destruct(){}

    public function showArticle()
    {
        $vhtml = new VHtml();
        $vhtml->showHtml('../Html/createArticle.php');

    } // showArticle($_html)

}
?>