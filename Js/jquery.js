/**
 * Created by a11721385 on 27/11/14.
 */
$("#test").click(function() {
        $.ajax({
            type: 'POST',
            url: '../Php/essai.php',
            success: function (darep) {

               if(darep=="1")
               console.log("Bravo faggot");

                else console.log("Faggot");

            }
        })
    }
);