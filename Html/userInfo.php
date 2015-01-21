<div class="infosperso">
    <a href="index.php?EX=home"><div class="logo">Accueil</div></a>
	<img src="Img/photo.jpg" class="photo">
	<div class="nom"><?PHP
        echo ($GLOBALS['user']->getSurname().' '.$GLOBALS['user']->getName());
        ?></div>
	<div class="asso"><?PHP
        echo ($GLOBALS['user']->getAssoName());
        ?></div>
	<div class="messages">2 messages</div>
	<div class="notification">1 notification</div>
	<a class="deconnexion" href="index.php?EX=deconnexion">Deconnexion</a>
</div>