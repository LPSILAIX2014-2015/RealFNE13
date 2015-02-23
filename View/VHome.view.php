<?php
class VHome
{
    public function __construct(){}

    public function __destruct(){}

    public function showHome($path)
    {
    	$mDBase = new MDBase();
    	global $data_association;
    	$data_association = $mDBase->getAllAssocs();


        $vhtml = new VHtml();
        $vhtml->showHtml($path);

    } // showHome($_html)

} // VHtml
?>