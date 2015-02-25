<?php

session_start();

require_once('../Model/MDBase.mod.php');
require_once('../Model/MUser.mod.php');
require('../Inc/require.inc.php');

$pdo = new MDBase();

$senderId = $_SESSION['ID_USER'];

$nb_message = $_POST['nbmessages'];
$receiver1 = $_POST['receiver1'];
$theme = $_POST['theme'];
$cat = $_POST['category'];
$request1 = $pdo -> prepare("SELECT id as id FROM USER WHERE login = ?");
$request1 -> execute(array($receiver1));
$req = $request1->fetch();
if (($nb_message < 100)||($senderId == 1))
{
    if((!$senderId)||(!$req)||($theme == "0")||($cat == "0"))
    {
		if ($cat == "0")
		{
			echo "5";
		}
		else
        if (!$senderId){
            echo "1";
        }
		else
        if (!$req){
            echo "0";
        }
		else
		if ($theme == "0")
		{
			echo "4";
		}
    }
    else {
		
        $receiverId = $req['id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $theme = $_POST['theme'];
        $cat = $_POST['category'];
		
        $request2 = $pdo->prepare("INSERT INTO MESSAGE(ID,SENDER_ID,RECEIVER_ID,CAT_ID,THEME_ID,ISREAD,ISARCHIVE,SENDDATE,TITLE,CONTENT) VALUES ('',?,?,?,?,0,0,CURRENT_DATE,?,?)");

        $request2->execute(array($senderId,$receiverId,$cat,$theme,$title,$content));
			
		$_SESSION['category'] = $cat;
		$_SESSION['theme'] = $theme;
		$_SESSION['title'] = $title;
		$_SESSION['content'] = $content;

        $request4 = $pdo -> prepare("SELECT SURNAME as prenom, NAME as nom FROM USER WHERE ID = ?");
        $request4 -> execute(array($senderId));
        $req4 = $request4->fetch();

        $request5 = $pdo -> prepare("SELECT SURNAME as prenom1, NAME as nom1 FROM USER WHERE ID = ?");
        $request5 -> execute(array ($receiverId));
        $req5 = $request5->fetch();

        $rapport = $req4['prenom'].' '.$req4['nom'].' a contact&eacute; '.$req5['prenom1'].' '.$req5['nom1'].'. ';

        $request3 = $pdo->prepare("INSERT INTO REPORT(ID,RDATE,TYPE,CONTENT) VALUES('',CURRENT_DATE,?,?)");
        $request3->execute(array('MESSAGE',$rapport));
        echo "3";
    }
}
else
{
    echo "2";
}

?>