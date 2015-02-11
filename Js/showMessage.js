$(document).ready(function() {

	$('.displayArchive').on('click', function(event) {
		event.preventDefault();
		if($(this).attr('data-bool') == "1")
		{
			$(this).attr('data-bool', "0");	
			$('.panelArchiveMessages').show();
			$(this).html("Cacher les messages archivés");
			$(this).attr('class', 'displayArchive btn btn-danger')
		}
		else
		{
			$(this).attr('data-bool', "1");	
			$('.panelArchiveMessages').hide();
			$(this).html("Afficher les messages archivés");
			$(this).attr('class', 'displayArchive btn btn-success')
		}
	});

	$('.buttonDeleteMessages').on('click', function() {
		if(confirm("Êtes vous sur de vouloir supprimer le message ?"))
		{
			$(this).parent().parent().parent().remove();
			td = $(this).parent().parent().parent();
			var id = td.attr('id');
			id = id.replace('message', '');
			$.getJSON('Ajax/deleteMessage.php', { id : id }).done(function() {

			});
		}
	});

	$('.buttonArchivateMessages').on('click', function() {
		if(confirm("Êtes vous sur de vouloir archiver le message ?"))
		{
			td = $(this).parent().parent().parent();
			var id = td.attr('id');
			id = id.replace('message', '');
			$.getJSON('Ajax/setMessageArchive.php', { id : id });
			document.location.href = "index.php?EX=consultMessages";
		}
	});

	$('.buttonUnArchivateMessages').on('click', function() {
		if(confirm("Êtes vous sur de vouloir rétablir le messsage ?"))
		{
			td = $(this).parent().parent().parent();
			var id = td.attr('id');
			id = id.replace('message', '');
			$.getJSON('Ajax/setUnMessageArchive.php', { id : id });
			document.location.href = "index.php?EX=consultMessages";
		}
	});


	$('.buttonShowMessages').on('click', function() {
		if($(this).attr('class') != "buttonShowMessages btn btn-sm btn-success")
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
		var button = $(this).parent().children('td:last-child').children('.buttonShowMessages').trigger('click');
	});

});

function hideAll() {
	$('.contentMessage').hide();
	$('.buttonShowMessages').attr('class', 'buttonShowMessages btn btn-sm btn-success');
	$('.buttonShowMessages').children('i').attr('class', "glyphicon glyphicon-plus");
	$('.btnOptions').hide();
}

function hideMessages(arg) {
	arg.parent().parent().children('td').children('pre').hide();
	arg.attr('class', 'buttonShowMessages btn btn-sm btn-success');
	arg.children('i').attr('class', "glyphicon glyphicon-plus");
	arg.siblings('.btnOptions').hide();
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
	arg.attr('class', 'buttonShowMessages btn btn-sm btn-warning');
	arg.children('i').attr('class', "glyphicon glyphicon-minus");
	//Affichage des boutons d'options
	arg.siblings('.btnOptions').show();
}


