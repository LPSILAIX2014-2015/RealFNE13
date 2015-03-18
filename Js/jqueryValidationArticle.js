/**
 * Created by a11721385 on 27/11/14.
 */
$(".butt_valid").click(function() {
<<<<<<< HEAD
        $idp = $(this).attr('var');

        console.log($idp);
=======
        $idp = $(this).attr('id').slice(6);
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b

        $.ajax({
            type: "POST",
            url: "./Php/validActionArticle.php",
            data: { idd : $idp } }
        ).done(function () {
                location.reload();
                alert("ARTICLE VALIDE");
            });
    }
);

$(".butt_suppr").click(function() {
<<<<<<< HEAD
        $idp = $(this).attr('var');
=======
        $idp = $(this).attr('id').slice(6);
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b

        $.ajax({
                type: "POST",
                url: "./Php/supprActionArticle.php",
                data: { idd : $idp } }
        ).done(function () {
                location.reload();
                alert("ARTICLE SUPPRIME");
            });
    }
);