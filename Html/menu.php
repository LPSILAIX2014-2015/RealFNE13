
<?PHP
global $user ;
?>
<ul>
    <li><a href="index.php">Accueil</a></li>
    <li><a href ="index.php?EX=calendar">Agenda</a></li>
    <li><a>Articles</a>
        <div class="submenu">

            <a class="cursor_read" href="index.php?EX=showArticle">Consulter</a>
            <?PHP
            if (isset($user)) {
            ?>
            <a class="cursor_text" href="index.php?EX=createArticle">Ecrire</a>
            <?PHP
            }
            ?>
        </div>
    </li>
    <?PHP
    if (isset($user)) {
    ?>
    <li><a class="cursor_message">Messagerie</a>
        <div class="submenu">
            <a class="cursor_message" href="index.php?EX=consultMessages">Consulter</a>
            <a class="cursor_text" href="index.php?EX=writeMessages">Ecrire</a>
        </div>
    </li>
    <li><a href="index.php?EX=cloud">Partage</a>
    </li>
    <?PHP
    }
    if ((isset($user)) && ($user->getRole() != 'MEMBRE')) {
    ?>
    <li><a>Administration</a>
        <div class="submenu">
            <a href="index.php?EX=manageMembers">Gestion des membres</a>
            <a>Validations</a>
            <?php if($user->getRole() == 'SADMIN'){?>
                <a href="index.php?EX=manageAsso">Gestion assos</a>
                <a class="cursor_notice" href="index.php?EX=reportList">Journal</a>
            <?php } ?>
        </div>
    </li>
    <?PHP
    }
    ?>
</ul>