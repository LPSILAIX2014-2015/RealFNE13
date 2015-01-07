<ul>
    <li><a>Recherche</a>
        <div class="submenu">
            <a>Articles</a>
            <a>Personnes</a>
            <a>Associations</a>
        </div>
    </li>
    <li><a>Agenda</a></li>
    <li><a>Articles</a>
        <div class="submenu">
            <a>Consulter</a>
<<<<<<< HEAD
            <a href="index.php?EX=createArticle">Ecrire</a>
=======
            <a href="index.php?EX=writeArticle">Ecrire</a>
>>>>>>> 201f313004222dc82bd89c4d779aff593fc34130
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