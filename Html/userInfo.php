<div class="infosperso">
    <div class="logo">Accueil</div>
	<img src="Img/photo.jpg" class="photo">
	<div class="nom"><?
        echo ($user->getSurname().' '.$user->getName());
        ?></div>
	<div class="asso"><?
        echo ($user->getAssoci.' '.$user->getName());
        ?></div>
	<div class="messages">2 messages</div>
	<div class="notification">1 notification</div>
	<a class="deconnexion">Deconnexion</a>
</div>