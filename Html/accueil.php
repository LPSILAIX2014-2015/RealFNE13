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
<<<<<<< HEAD
            <a class="imgLogo" <?php echo 'data-id="'.$data_association[$i]['ID'].'" href="index.php?EX=showArticle&idA='.$data_association[$i]['ID'].'"'; ?>
                style="background-image:url('<?php echo $data_association[$i]['IMAGEPATH']; ?>');">
=======
            <a <?php echo 'href="index.php?EX=showArticle&idA='.$data_association[$i]['ID'].'"'; ?>
               style="background-image:url('<?php echo $data_association[$i]['IMAGEPATH']; ?>');">
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b
            </a>
            <?php
        }
        else
        {
            ?>
<<<<<<< HEAD
            <a class="imgLogo noLogo" <?php echo 'data-id="'.$data_association[$i]['ID'].'" href="index.php?EX=showArticle&idA='.$data_association[$i]['ID'].'"'; ?> >
=======
            <a class="noLogo" <?php echo 'href="index.php?EX=showArticle&idA='.$data_association[$i]['ID'].'"'; ?> >
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b
                <?php echo '<span>'.$data_association[$i]['NAME'].'</span>'; ?>
            </a>
            <?php
        }
    }
    ?>
<<<<<<< HEAD
    <div hidden class="popUp"></div>
</p>

<script src="Js/home.js"></script>
=======
</p>
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b
