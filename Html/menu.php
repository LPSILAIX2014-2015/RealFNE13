
<ul>
<<<<<<< HEAD
    <li><a>Recherche</a></li>
=======
    <li><a>Recherche</a>
        <div class="submenu">
            <a>Articles</a>
            <a>Personnes</a>
            <a>Associations</a>
        </div>
    </li>
>>>>>>> 0f1378ed7eb5467c6bbe53f03bf4798291703aa5
    <li><a>Agenda</a></li>
    <li><a>Articles</a>
        <div class="submenu">
            <a>Consulter</a>
            <a href="index.php?EX=writeArticle">Ecrire</a>
        </div>
    </li>
    <li><a>Messagerie</a>
        <div class="submenu">
            <a href="index.php?EX=consultMessages">Consulter</a>
            <a>Ecrire</a>
        </div>
    </li>
    <?PHP
    if (isset($GLOBALS['user'])) { ?>
    <li><a>Administration</a>
        <div class="submenu">
            <a>Gestion assos</a>
            <a>Validations</a>
            <a>Journal</a>
        </div>
    </li>
    <? } ?>
</ul>