<h1>Bienvenue sur votre espace associatif</h1>

<p>
    Cet espace vous permet de communiquer avec votre association et les autres membres des associations FNE13.
</p>
<p class="logosassos">
    <?php
    global $data_association;
    for($i = 0 ; $i < count($data_association) ; ++$i)
    {
        if($data_association[$i]['IMAGEPATH'] != '')
        {
            ?>
            <a <?php echo 'href="index.php?EX=showArticle&idA='.$data_association[$i]['ID'].'"'; ?> >
                <img width="75" height="75" <?php echo 'src="'.$data_association[$i]['IMAGEPATH'].'"'; ?> >
            </a>
            <?php
        }
        else
        {
            ?>
            <a class="noLogo" <?php echo 'href="index.php?EX=showArticle&idA='.$data_association[$i]['ID'].'"'; ?> >
                <?php echo '<span>'.$data_association[$i]['NAME'].'</span>'; ?>
            </a>
            <?php
        }
    }
    ?>
</p>
