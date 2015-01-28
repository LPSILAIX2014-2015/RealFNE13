<div class="infosperso">
    <a href="index.php?EX=home"><div class="logo">Accueil</div></a>
	<img src="Img/photo.jpg" class="photo">
	<div class="nom">
		<?PHP echo ($GLOBALS['user']->getSurname().' '.$GLOBALS['user']->getName()); ?>
	</div>
	<div class="asso"><?PHP
        echo ($GLOBALS['user']->getAssoName());
        ?></div>
    <a href='index.php?EX=profil'>Mon profil</a>
	<div class="messages">
        <a href="index.php?EX=consultMessages">
            <?PHP
            $sql = new MDBase();
            $query = 'SELECT COUNT(*) FROM MESSAGE WHERE RECEIVER_ID=\''.$_SESSION['ID_USER'].'\' AND ISREAD=0 ;';
            $nbm = $sql->query($query)->fetch(PDO::FETCH_NUM);
            $nbm = $nbm[0];
            switch($nbm) {
                case '0': echo 'Aucun message' ; break ;
                case '1': echo '1 message' ; break ;
                default : echo $nbm.' messages' ;
            }
            unset($sql);
            unset($nbm);
            ?>
        </a>
    </div>
	<div class="notification">1 notification</div>
	<a class="deconnexion" href="index.php?EX=deconnexion">Deconnexion</a>
</div>