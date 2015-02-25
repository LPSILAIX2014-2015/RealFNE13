$(document).ready(function() {

	getCommentaire();
	
});

function getCommentaire(){
	var idArticle = $('#divCom').attr('idArticle');
	var currentComId = "";

	$.ajax({
		url: 'Ajax/comHandler.php',
		type: 'POST',
		dataType: 'json',
		data: {idPost: idArticle},
		success: function(response) {
			console.log(response);

			for(i in response.com){

				currentComId = 'com'+ response.com[i]['ID'];

				$('#divCom').append('<div id="'+ currentComId +'" class="com">');
				$('#'+currentComId).append('<span class="nameCom">'+ response.com[i]['NAME'] + response.com[i]['SURNAME'] +'</span>'
								   +'<span class="dateCom">'+ response.com[i]['COM_DATE'] +'</span>');
				$('#'+currentComId).append('<hr class="sepCom">');
				$('#'+currentComId).append('<div class="contentCom">'+ response.com[i]['CONTENT'] +'</div>');
				$('#'+currentComId).append('</div>');
			}
		}
	});
	$('#divCom').append('</div>');
};


jQuery(function($) {
    //Change this selector to apply the pagination
    var items = $(".com");
    //don't touch this value until you know what you do!
    var numItems = items.length;


    /////////////////////////////////////////////
    //Set the number of item displayed par page//
    /////////////////////////////////////////////

    var perPage = 10;


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
