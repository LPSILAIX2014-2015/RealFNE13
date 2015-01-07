/**
 * Created by a11721385 on 27/11/14.
 */
$("#test").click(function() {
        $article_id=1;

        $.ajax({
            type: "POST",
            url: "../Php/EssaiDeValidationArticle.php",
            data: { idd : $article_id } }
        ).done(function () {
                alert("ARTICLE VALIDE");
            });
    }
);