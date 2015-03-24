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

				var idcom = response.com[i]['ID'];
				var currentComId = 'com'+idcom ;

				$('#divCom').append('<div id="'+ currentComId +'" class="com">');
				$('#'+currentComId).append('<span class="nameCom">'+ response.com[i]['NAME'] + ' ' + response.com[i]['SURNAME'] +'</span>'
					 +'<span class="dateCom">'+ response.com[i]['COM_DATE'] +'</span>');
				$('#'+currentComId).append('<hr class="sepCom">');
				$('#'+currentComId).append('<div id="content'+idcom+'" class="contentCom">'+ response.com[i]['CONTENT'] +'</div>');
				$('#'+currentComId).append('</div>');

				//The person who post the com can modify his it. admins and the sysadmin can modify and delete all coms
				if (response.session['ROLE'] == 'SADMIN' || response.session['ROLE'] == 'ADMIN') {

					// add a button to delete coms, jquery 1.1 does not permit .live() function so we bind an onclick attribute
					$('#'+currentComId).append('<button id="updatecom'+idcom+'" class="updateCom" onclick="fillCommentaire('+ idcom +')" >Modifier</button>'+
											   '<button id="deletecom'+idcom+'" class="deleteCom" onclick="deleteCommentaire('+ idcom +')" >Supprimer</button>');
				}
			}
			$('#divCom').append('</div>');
			$('#textareaId').val('');


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
			            // someone changed page, lets hide/show trs appropriately
			            var showFrom = perPage * (pageNumber - 1);
			            var showTo = showFrom + perPage;
			            items.hide() // first hide everything, then show for the new page
			            .slice(showFrom, showTo).show();
			        }
			    });
			});
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
			getCommentaire();
		}
	});
}

function deleteCommentaire(id){

	$.ajax({
		url: 'Ajax/comHandler.php',
		type: 'POST',
		dataType: 'json',
		data: {idcom: id, role: "deleteCommentaire"},
		success: function(response) {
			getCommentaire();
		}
	});
}

function fillCommentaire(id){

	var content = $('#content'+id).text();
	$('.updateCom').remove();
	$('.deleteCom').remove();
	$('#content'+id).empty();
	$('#content'+id).append('<textarea id="modifyTextarea"></textarea>');
	$('#modifyTextarea').val(content);
	$('#com'+id).append('<button id="validationUpdate" onclick="updateCommentaire('+id+')">Valider</button>');

}

function updateCommentaire(id){

	var content = $('#modifyTextarea').val();

	$.ajax({
		url: 'Ajax/comHandler.php',
		type: 'POST',
		dataType: 'json',
		data: {idcom: id, content: content, role: "updateCommentaire"},
		success: function(response) {
			getCommentaire();
		}
	});
}
