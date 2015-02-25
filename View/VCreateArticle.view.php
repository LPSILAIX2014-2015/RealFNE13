<?php
class VCreateArticle
{
  public function __construct(){}
  
  public function __destruct(){}
  
  public function showCreateArticle($path)
  {

    if(isset($_GET['state']))
    {
      switch(htmlspecialchars($_GET['state']))
      {
          case 'Err_NoTittle':
            global $customAlert;
            array_push($customAlert, "Erreur : Vous devez mettre un titre à votre article.");
            break;
          case 'Err_NotAnImage':
            global $customAlert;
            array_push($customAlert, "Erreur : Le fichier que vous avez sélectionné n'est pas une image.");
            break;
          case 'Err_UserNotLogged':
            global $customAlert;
            array_push($customAlert, "Erreur : Vous n'êtes pas connecté.");
            break;
          case 'Err_FileTooFat':
            global $customAlert;
            array_push($customAlert, "Erreur : Le fichier que vous avez seléctionné est trop volumineux.");
            break;
          case 'Err_UploadFail':
            global $customAlert;
            array_push($customAlert, "Erreur : Un problème est survenu lors du chargement de votre image.");
            break;
          case 'Err_QueryFail':
            global $customAlert;
            array_push($customAlert, "Erreur : Votre article n'a pas pu être enregistré (Avez-vous les droits?).");
            break;
          case 'Err_NoText':
            global $customAlert;
            array_push($customAlert, "Erreur : Veuillez entrer du texte dans votre article.");
            break;
      }
      if(htmlspecialchars($_GET['state']) == 'Err_NoTittle')
      {
        
      }
    }  	

    $vhtml = new VHtml();
    $vhtml->showHtml($path);

  } // showCreateArticle($_html)
  
} // VHtml
?>