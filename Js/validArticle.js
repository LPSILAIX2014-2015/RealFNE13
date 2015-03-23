/**
 * Created by a11721385 on 20/03/15.
 */
$(document).ready(function () {

    $("#filterVALID").on('change', function () {
        location.href = './index.php?EX=validArticle&FILTER=' + $("#filterVALID").val();
    });
});