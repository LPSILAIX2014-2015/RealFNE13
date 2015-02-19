<h1>Bienvenue sur votre espace FNE13</h1>

<p>
    Cet espace vous permet de communiquer avec votre association et les autres membres des associations FNE13.
</p>
<p class="logosassos">
    <?php
        global $data_association;
        for($i = 0 ; $i < count($data_association) ; ++$i)
        {
            ?>
                <a <?php echo 'href="index.php?EX=showArticle&idA='.$data_association[$i]['ID'].'"'; ?> >
                    <img width="75" height="58" <?php echo 'src="'.$data_association[$i]['IMAGEPATH'].'"'; ?> >
                </a>
            <?php
        }
    ?>
</p>
