<div class="infosperso">
	<img src="<?= $GLOBALS['user']->getPhotopath(); ?>" class="photo">
	<div class="nom">
		<?PHP echo ($GLOBALS['user']->getSurname().' '.$GLOBALS['user']->getName()); ?>
	</div>
	<div class="asso"><?PHP
        echo ($GLOBALS['user']->getAssoName());
        ?></div>
    <a href='index.php?EX=profil' class="lienprofil">Mon profil</a>
</div>
