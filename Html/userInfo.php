<div class="infosperso">
	<img src="Img/photo.jpg" class="photo">
	<div class="nom">
		<?PHP echo ($GLOBALS['user']->getSurname().' '.$GLOBALS['user']->getName()); ?>
	</div>
	<div class="asso"><?PHP
        echo ($GLOBALS['user']->getAssoName());
        ?></div>
    <a href='index.php?EX=profil' class="lienprofil">Mon profil</a>
</div>
<div class="messages">
    <a href="index.php?EX=consultMessages">
        <?PHP
        $sql = new MDBase();
        $query = 'SELECT COUNT(*) FROM MESSAGE WHERE RECEIVER_ID=\''.$_SESSION['ID_USER'].'\' AND ISREAD=0 ;';
        $nbm = $sql->query($query)->fetch(PDO::FETCH_NUM);
        $nbm = $nbm[0];echo $nbm;
        unset($sql);
        unset($nbm);
        ?>
        <img src="Img/message.png" alt="Messages">
    </a>
</div>
<div class="notification">1 <img src="Img/notif.png" alt="Notifications"></div>
<a class="deconnexion" href="index.php?EX=deconnexion">Deconnexion</a>
