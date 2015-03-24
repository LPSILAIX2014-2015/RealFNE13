$(document).ready(function() {

<<<<<<< HEAD
    fillShowArticlePage(0);

    //Foutre les valeurs par défauts des consultations d'articles
    //PROBLEMU
    sortValidArticle();
=======
    $("#filterVALID").on('change', function () {
        location.href = './index.php?EX=validArticle&FILTER=' + $("#filterVALID").val();
    });

    //Foutre les valeurs par défauts des consultations d'articles
    //PROBLEMU
  //  sortAssocArticle();
   // sortThemeArticle();
  //sortValidArticle();
>>>>>>> 60abd7d9ee09b6110e2b44c610e4426c85a841a4
    //$('.lienarticle').hide();


	//When an article is clicked, redirect to showArticle
	$('.lienarticle').on('click', function() {

		var id = $(this).attr('id');
		id = id.replace(/article/, '');
		document.location.href = 'index.php?EX=showInfoArticle&id='+id;
	});

    //When select value change, articles will be filter

    $('#filterVALID').on('change' , function(event) {
        sortValidArticle();
    });

    if('#filterASSOC option:selected') {
        fillShowArticlePage(0);
    }

    $('#filterASSOC').on('change', function(event) {
        fillShowArticlePage(0);
    });

    $('#filterTHEME').on('change', function(event) {
        fillShowArticlePage(0);
    });


});



function fillShowArticlePage(page){

    var url = "";
    if (page != 0){
        url = "?p=" + page;
    }

    var assocFilter = $('#filterASSOC option:selected').attr('value');
    var themeFilter = $('#filterTHEME option:selected').attr('value');

    $.ajax({
        type: "POST", //Sending method
        url:"Ajax/showArticleHandler.php"+url,
        data: {'role': "consultArticle", 'assoc': assocFilter, 'theme': themeFilter},
        dataType: 'json',
        success: function(response){

            $('#divArticle').empty();
            //On boucle sur news pour remplir la page
            for(i in response.article){

                if(response.article[i]['IMAGEPATH'] != null) {
                    imgArticle = "<img src='" + response.article[i]['IMAGEPATH'] + "'"
                               +     " class='img-responsive' />";
                } else {
                    imgArticle = "<img src='Img/logo.png'"
                               +     " class='img-responsive transparence' />";
                }

                $('#divArticle').append(
                      "<div id='article" + response.article[i]['ID'] + "'"
                    +     " class='lienarticle'"
                    +     " data-assoc='" + response.article[i]['ASSOC_ID'] + "'"
                    +     " data-theme='" + response.article[i]['THEME_ID'] + "'>"
                    +   "<div id='imgplace'>"
                    +     imgArticle
                    +   "</div>"

                    +   "<div id='infoarticle'>"
                    +     "<h2>" + response.article[i]['TITLE'] + "</h2>"
                    +     "<p class='auteur'>"
                    +        response.article[i]['NAME']
                    +        " " + response.article[i]['SURNAME']
                    +        ", le " + response.article[i]['PDATE']
                    +     "</p>"
                    +     "<p class='description'>"
                    +        response.article[i]['CONTENT']
                    +     "</p>"
                    +   "</div>"
                    + "</div>"
                );

            }
        }
    }).done(function(response){
        // On active la pagination
        pagination(response.nbPage, response.page, 'fillShowArticlePage'); 
    });
};


// Pagination
function pagination(nbPage, page, method){
    endPagin2 = nbPage - 4;
    endPagin1 = nbPage - 3;

    var previousPage = parseInt(page - 1);
    var nextPage = parseInt(page) + 1;

    $('#pagination').empty();
    $('#pagination').append('<li id="previousArrow" onclick="'+method+'('+ previousPage +')">'+
                                '<a href="#" aria-label="Previous">'+
                                    '<span aria-hidden="true">&laquo;</span>'+
                                '</a>'+
                            '</li>');

    if (previousPage == 0){
        $('#previousArrow').attr('class', 'disabled');
        $('#previousArrow').removeAttr('onclick');
    }
    
    //Si le nombre de page est limité, 12 pages reste très correct, on affiche simplement la pagination
    if(nbPage <= 12){
        for (var i = 1; i <= nbPage; i++) {
            $('#pagination').append('<li id="page'+i+'"><a href="#" onclick="'+method+'('+i+')">'+i+'</a></li>');
            if (i == page) {
                $('#page'+i).attr('class', 'active');
            }
        }
    //Sinon on coupe la pagination au milieu et on fait une navigation dynamique.
    } else{

        //On affiche les 3 premiers liens normalement
        for (var i = 1; i < 4; i++) {
            $('#pagination').append('<li id="page'+i+'"><a href="#" onclick="'+method+'('+i+')">'+i+'</a></li>');
            if (i == page) {
                $('#page'+i).attr('class', 'active');
            }
        }

        //Si la page active est soit dans les 3 premiers, soit dans les 3 derniers, on coupe au milieu et on affiche '...'
        if(page < 3 || page > (nbPage-2)){
            $('#pagination').append('<li class="disabled"><a href="#">...</a></li>');

        } else if(page == 3){
            $('#pagination').append('<li id="page'+4+'"><a href="#" onclick="'+method+'('+4+')">'+4+'</a></li>');
            $('#pagination').append('<li class="disabled"><a href="#">...</a></li>');
        } else if(page == 4){
            $('#pagination').append('<li id="page'+4+'"><a href="#" onclick="'+method+'('+4+')">'+4+'</a></li>');
            $('#pagination').append('<li id="page'+5+'"><a href="#" onclick="'+method+'('+5+')">'+5+'</a></li>');
            $('#pagination').append('<li class="disabled"><a href="#">...</a></li>');
            $('#page'+page).attr('class', 'active');
        } else if(page > 4 && page < nbPage - 3){
            $('#pagination').append('<li class="disabled"><a href="#">...</a></li>');
            $('#pagination').append('<li id="page'+previousPage+'"><a href="#" onclick="'+method+'('+previousPage+')">'+previousPage+'</a></li>');
            $('#pagination').append('<li id="page'+page+'"><a href="#" onclick="'+method+'('+page+')">'+page+'</a></li>');
            $('#pagination').append('<li id="page'+nextPage+'"><a href="#" onclick="'+method+'('+nextPage+')">'+nextPage+'</a></li>');
            $('#pagination').append('<li class="disabled"><a href="#">...</a></li>');
            $('#page'+page).attr('class', 'active');
        } else if(page == nbPage - 3){
            $('#pagination').append('<li class="disabled"><a href="#">...</a></li>');
            $('#pagination').append('<li id="page'+endPagin2+'"><a href="#" onclick="'+method+'('+endPagin2+')">'+endPagin2+'</a></li>');
            $('#pagination').append('<li id="page'+endPagin1+'"><a href="#" onclick="'+method+'('+endPagin1+')">'+endPagin1+'</a></li>');
            $('#page'+page).attr('class', 'active');
        } else if(page == nbPage - 2){
            $('#pagination').append('<li class="disabled"><a href="#">...</a></li>');
            $('#pagination').append('<li id="page'+endPagin1+'"><a href="#" onclick="'+method+'('+endPagin1+')">'+endPagin1+'</a></li>');
        }

        for (var i = nbPage - 2; i <= nbPage; ++i) {
                $('#pagination').append('<li id="page'+i+'"><a href="#" onclick="'+method+'('+i+')">'+i+'</a></li>');
                if (i == page) {
                    $('#page'+i).attr('class', 'active');
                }
            }
    }
<<<<<<< HEAD

    $('#pagination').append('<li id="nextArrow" onclick="'+method+'('+nextPage+')">'+
                                '<a href="#" aria-label="Next">'+
                                    '<span aria-hidden="true">&raquo;</span>'+
                                '</a>'+
                            '</li>');

    if (nextPage > nbPage){
        $('#nextArrow').attr('class', 'disabled');
        $('#nextArrow').removeAttr('onclick');
    }       
};

/*
>>>>>>> 60abd7d9ee09b6110e2b44c610e4426c85a841a4
function sortValidArticle() {
    var idValid;
    if( $('#filterVALID option:selected').attr('value') == 'undefined') idValid =0;
    else  idValid = $('#filterVALID option:selected').attr('value');



    $('.lienarticle').hide();


    if(idValid == "0") //Si la sélection est a valider
    {

        for(var i = 0 ; i < $('.lienarticle').length ; ++i)
        {
            if ($('.lienarticle').get(i).getAttribute('data-valid')==0)
               // console.log($('.lienarticle')[i]);


                $('.lienarticle')[i].style.display=""; //Affiche div article


        }

    }

    else
    { //Si c'est la selection des articles déjà validé
       for(var i = 0 ; i < $('.lienarticle').length ; ++i)
       {

             if ($('.lienarticle').get(i).getAttribute('data-valid')>0)
             //console.log($('.lienarticle')[i]);
            $('.lienarticle')[i].style.display="";

             }

        }


}
*/



