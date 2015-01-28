$(document).ready(function() {

	$('.buttonDeleteMessages').on('click', function() {
		if(confirm("Êtes vous sur de vouloir supprimer le message ?"))
		{
			$(this).parent().parent().remove();
			td = $(this).parent().parent();
			var id = td.attr('id');
			id = id.replace('message', '');
			$.getJSON('Ajax/deleteMessage.php', { id : id });
		}
	});



	$('.buttonShowMessages').on('click', function() {
		if($(this).attr('class') != "buttonShowMessages btn btn-sm btn-warning")
		{
			hideMessages($(this));
		}
		else
		{
			hideAll();
			showMessages($(this));
		}		
	});

	$('.currentTdMessage').on('click', function(e) {
		var button = $(this).parent().children('td:last-child').children('.buttonShowMessages');
		if(button.attr('class') != "buttonShowMessages btn btn-sm btn-warning")
		{
			hideMessages(button);
		}
		else
		{
			hideAll();
			showMessages(button);
		}		
	});

});

function hideAll() {
	$('.contentMessage').hide();
	$('.buttonShowMessages').attr('class', 'buttonShowMessages btn btn-sm btn-warning');
	$('.buttonShowMessages').children('i').attr('class', "glyphicon glyphicon-plus");
	$('.btnOptions').hide();
}

function hideMessages(arg) {
	arg.parent().parent().children('td').children('pre').hide();
	arg.attr('class', 'buttonShowMessages btn btn-sm btn-warning');
	arg.children('i').attr('class', "glyphicon glyphicon-plus");
}

function showMessages(arg) {
	td = arg.parent().parent();
	if(td.attr('class') == "notReaded")
	{
		var id = td.attr('id');
		id = id.replace('message', '');
		td.attr('class' , '');
		$.getJSON('Ajax/setMessageReaded.php', { id : id });
	}
	arg.parent().parent().children('td').children('pre').show();
	arg.attr('class', 'buttonShowMessages btn btn-sm btn-danger');
	arg.children('i').attr('class', "glyphicon glyphicon-minus");
	//Affichage des boutons d'options
	arg.parent().siblings('btnOptions').show();
}


