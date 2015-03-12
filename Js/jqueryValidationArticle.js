/**
 * Created by a11721385 on 27/11/14.
 */
$(".butt_valid").click(function() {
        $idp = $(this).attr('var');

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
        $idp = $(this).attr('var');

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