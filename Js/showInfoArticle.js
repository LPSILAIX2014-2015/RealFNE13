$(document).ready(function() {

    //Foutre les valeurs par défauts des consultations d'articles
    //PROBLEMU
    sortAssocArticle();
    sortThemeArticle();
    sortValidArticle();
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
        sortAssocArticle();
    }

    $('#filterASSOC').on('change', function(event) {
        sortAssocArticle();
    });

    $('#filterTHEME').on('change', function(event) {
        sortThemeArticle();
    });


});

jQuery(function($) {
    //Change this selector to apply the pagination
    var items = $(".lienarticle");
    //don't touch this value until you know what you do!
    var numItems = items.length;


    /////////////////////////////////////////////
    //Set the number of item displayed par page//
    /////////////////////////////////////////////

    var perPage = 15;


    items.slice(perPage).hide();
    // now setup pagination
    $("#pagination").pagination({
        items: numItems,
        itemsOnPage: perPage,
        onPageClick: function(pageNumber) { // this is where the magic happens
            // someone changed page, lets hide/show trs appropriately
            var showFrom = perPage * (pageNumber - 1);
            var showTo = showFrom + perPage;
            items.hide() // first hide everything, then show for the new page
            .slice(showFrom, showTo).show();
        }
    });
});

//Sort function for Category and theme
function sortAssocArticle() {
    var idAssoc;
    if( $('#filterASSOC option:selected').attr('value') == 'undefined') idAssoc =0;
    else  idAssoc = $('#filterASSOC option:selected').attr('value');

    $('.lienarticle').hide();
    if(idAssoc == "0")
    {
        $('.lienarticle').show();
    }
    else
    {
        for(var i = 0 ; i < $('.lienarticle').length ; ++i)
        {
            if(idAssoc == $('.lienarticle').get(i).getAttribute('data-assoc'))
            {
                $('.lienarticle')[i].style.display = "";
            }
        }
    }
}

function sortThemeArticle() {

    var idTheme;
    if( $('#filterTHEME option:selected').attr('value') == 'undefined') idTheme =0;
                    else  idTheme = $('#filterTHEME option:selected').attr('value');
    $('.lienarticle').hide();
    if(idTheme == "0")
    {
        $('.lienarticle').show();
    }
    else
    {
        for(var i = 0 ; i < $('.lienarticle').length ; ++i)
        {
            if(idTheme == $('.lienarticle').get(i).getAttribute('data-theme'))
            {
                $('.lienarticle')[i].style.display = "";
            }
        }
    }
}

function sortValidArticle() {
    var idValid;
    if( $('#filterVALID option:selected').attr('valu' +
        'e') == 'undefined') idValid =0;
    else  idValid = $('#filterVALID option:selected').attr('value');


    $('.lienarticle').hide();
    $('.butt_suppr').hide();
    $('.butt_valid').hide();

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