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
            <a class="imgLogo" <?php echo 'data-id="'.$data_association[$i]['ID'].'" href="index.php?EX=showArticle&idA='.$data_association[$i]['ID'].'"'; ?>
                style="background-image:url('<?php echo $data_association[$i]['IMAGEPATH']; ?>');">
            </a>
            <?php
        }
        else
        {
            ?>
            <a class="imgLogo noLogo" <?php echo 'data-id="'.$data_association[$i]['ID'].'" href="index.php?EX=showArticle&idA='.$data_association[$i]['ID'].'"'; ?> >
                <?php echo '<span>'.$data_association[$i]['NAME'].'</span>'; ?>
            </a>
            <?php
        }
    }
    ?>
    <div hidden class="popUp"></div>
</p>

<script src="Js/home.js"></script>