$(document).ready(function() {

	$('#newCom').on('submit', function(event) {
		event.preventDefault();
		if ($('#textareaId').val() != "")
		{
			addCommentaire();
		}
	});

	getCommentaire();	
});

<<<<<<< HEAD
=======
jQuery(function($) {
    //Change this selector to apply the pagination
    var items = $(".com");
    //don't touch this value until you know what you do!
    var numItems = items.length;


    /////////////////////////////////////////////
    //Set the number of item displayed par page//
    /////////////////////////////////////////////

    var perPage = 1;

    items.slice(perPage).hide();
    // now setup pagination
    $("#pagination").pagination({
    	items: numItems,
    	itemsOnPage: perPage,
        onPageClick: function(pageNumber) { // this is where the magic happens
        	console.log(pageNumber);
            // someone changed page, lets hide/show trs appropriately
            var showFrom = perPage * (pageNumber - 1);
            var showTo = showFrom + perPage;
            items.hide() // first hide everything, then show for the new page
            .slice(showFrom, showTo).show();
        }
    });
});
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b

function getCommentaire(){
	var idArticle = $('#divCom').attr('idArticle');
	var currentComId = "";

	$.ajax({
		url: 'Ajax/comHandler.php',
		type: 'POST',
		dataType: 'json',
		data: {idPost: idArticle, role: "getCommentaire"},
		success: function(response) {
			$('#divCom').empty();
			for(i in response.com){
				currentComId = 'com'+ response.com[i]['ID'];

				$('#divCom').append('<div id="'+ currentComId +'" class="com">');
				$('#'+currentComId).append('<span class="nameCom">'+ response.com[i]['NAME'] + ' ' + response.com[i]['SURNAME'] +'</span>'
					+'<span class="dateCom">'+ response.com[i]['COM_DATE'] +'</span>');
				$('#'+currentComId).append('<hr class="sepCom">');
				$('#'+currentComId).append('<div class="contentCom">'+ response.com[i]['CONTENT'] +'</div>');
				$('#'+currentComId).append('</div>');
			}
			$('#divCom').append('</div>');
			$('#textareaId').val('');
<<<<<<< HEAD


			////////////////////////////////////////////
			//     Set the pagination of comments     //
			////////////////////////////////////////////


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
			        	console.log(pageNumber);
			            // someone changed page, lets hide/show trs appropriately
			            var showFrom = perPage * (pageNumber - 1);
			            var showTo = showFrom + perPage;
			            items.hide() // first hide everything, then show for the new page
			            .slice(showFrom, showTo).show();
			        }
			    });
			});
=======
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b
		}
	});
};

function addCommentaire(){
	var idArticle = $('#divCom').attr('idArticle');
	var content = $('#textareaId').val();

	$.ajax({
		url: 'Ajax/comHandler.php',
		type: 'POST',
		dataType: 'json',
		data: {idPost: idArticle, content: content, role: "addCommentaire"},
		success: function(response) {
			console.log(response);
			getCommentaire();
		}
	});
}
