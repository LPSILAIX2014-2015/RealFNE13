<div class="infosperso">
    <div class="logo">Accueil</div>
	<img src="Img/photo.jpg" class="photo">
	<div class="nom"><?
        echo ($GLOBALS['user']->getSurname().' '.$GLOBALS['user']->getName());
        ?></div>
	<div class="asso"></div>
	<div class="messages">2 messages</div>
	<div class="notification">1 notification</div>
	<a class="deconnexion" href="index.php?EX=deconnexion">Deconnexion</a>
</div>