<?php
class VConsultMessages
{
  public function __construct(){}
  
  public function __destruct(){}
  
  public function showConsultMessages($path)
  {
  	$idUser = $_SESSION['ID_USER'];

  	$mConsultMessage = new MConsultMessage();
    $data_messages = $mConsultMessage->getAllMessagesByIdUser($idUser);


    global $content_messages;
    $content_messages = $mConsultMessage->displayMessages($data_messages);

    global $content_messages_archive;
    $content_messages_archive = $mConsultMessage->displayMessagesArchive($data_messages);

    global $data_theme;
    global $data_category;
    $mMod = new MDBase();
    $data_theme = $mMod->getAllThemes();
    $data_category = $mMod->getAllCategories();



$vhtml = new VHtml();
$vhtml->showHtml($path);

  } // showConsultMessages($_html)
  
} // VHtml
?>