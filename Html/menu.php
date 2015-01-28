<?PHP
global $user ;
?>
<ul>
    <li><a href="index.php?EX=searchMember">Recherche</a></li>
    <li><a href ="index.php?EX=calendar">Agenda</a></li>
    <li><a>Articles</a>
        <div class="submenu">

            <a href="index.php?EX=showArticle">Consulter</a>
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
            <a>Gestion assos</a>
            <a href="index.php?EX=manageMembers">Gestion des membres</a>
            <a>Validations</a>
            <a href="index.php?EX=reportList">Journal</a>
        </div>
    </li>
    <?PHP
    }
    ?>
</ul>