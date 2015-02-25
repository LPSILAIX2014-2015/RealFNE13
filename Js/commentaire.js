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
				$('#'+currentComId).append('<span class="nameCom">'+ response.com[i]['NAME'] +'</span>'
								   +'<span class="dateCom">'+ response.com[i]['COM_DATE'] +'</span>');
				$('#'+currentComId).append('<hr class="sepCom">');
				$('#'+currentComId).append('<div class="contentCom">'+ response.com[i]['CONTENT'] +'</div>');
				$('#'+currentComId).append('</div>');
			}
		}
	});
	$('#divCom').append('</div>');
};