<?PHP
global $user ;
?>
<ul>
    <li><a>Recherche</a>
        <div class="submenu">
            <a href="index.php?EX=searchMember">Recherche membres</a>
            <a href="index.php?EX=searchAsso">Recherche associations</a>
        </div>
    </li>
    <li><a>Agenda</a></li>
    <li><a>Articles</a>
        <div class="submenu">
            <a>Consulter</a>
            <?PHP
            if (isset($user)) {
            ?>
            <a href="index.php?EX=createArticle">Ecrire</a>
            <?PHP
            }
            ?>
        </div>
    </li>
    <?PHP
    if (isset($user)) {
    ?>
    <li><a>Messagerie</a>
        <div class="submenu">
            <a href="index.php?EX=consultMessages">Consulter</a>
            <a>Ecrire</a>
        </div>
    </li>
    <?PHP
    }
    if ((isset($user)) && ($user->getRole() != 'MEMBRE')) {
    ?>
    <li><a>Administration</a>
        <div class="submenu">
            <a href="index.php?EX=manageAsso">Gestion assos</a>
            <a href="index.php?EX=manageMembers">Gestion des membres</a>
            <a>Validations</a>
            <a href="index.php?EX=reportList">Journal</a>
        </div>
    </li>
    <?PHP
    }
    ?>
</ul>