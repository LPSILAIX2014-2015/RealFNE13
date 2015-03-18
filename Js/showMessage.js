$(document).ready(function() {

	//Quand la valeur du select change, on filtre les messages
	$('#filterCATEGORY').on('change', function(event) {
		sortCategory();
	});
	$('#filterTHEME').on('change', function(event) {
		sortTheme();
	});


	$('.displayArchive').on('click', function(event) {
		event.preventDefault();
		if($(this).attr('data-bool') == "1")
		{
			$(this).attr('data-bool', "0");	
			$('.divArchiveMessages').show();
			$(this).html("Cacher les messages archivés");
			$(this).attr('class', 'displayArchive')
		}
		else
		{
			$(this).attr('data-bool', "1");	
			$('.divArchiveMessages').hide();
			$(this).html("Afficher les messages archivés");
			$(this).attr('class', 'displayArchive')
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

	$('.buttonDeleteNotif').on('click', function() {
		if(confirm("Êtes vous sur de vouloir supprimer la notification ?"))
		{
			$(this).parent().parent().remove();
			td = $(this).parent().parent();
			var id = td.attr('id');
			id = id.replace('notif', '');
			$.getJSON('Ajax/deleteNotif.php', { id : id }).done(function() {

			});
		}
	});

	$('.buttonArchivateMessages').on('click', function() {
		if(confirm("Êtes vous sur de vouloir archiver le message ?"))
		{
			td = $(this).parent().parent().parent();
			var id = td.attr('id');
			id = id.replace('message', '');
			$.getJSON('Ajax/setMessageArchive.php', { id : id }).done(function () {
                document.location.href = "index.php?EX=consultMessages";
            });
		}
	});

	$('.buttonUnArchivateMessages').on('click', function() {
		if(confirm("Êtes vous sur de vouloir rétablir le messsage ?"))
		{
			td = $(this).parent().parent().parent();
			var id = td.attr('id');
			id = id.replace('message', '');
			$.getJSON('Ajax/setUnMessageArchive.php', { id : id }).done(function () {
                document.location.href = "index.php?EX=consultMessages";
            });

		}
	});


	$('.buttonShowMessages').on('click', function() {
		if($(this).attr('data-bool') != "1")
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
	$('.buttonShowMessages').attr('class', 'buttonShowMessages');
	$('.btnOptions').hide();
}

function hideMessages(arg) {
	arg.parent().parent().children('td').children('pre').hide();
	arg.attr('data-bool', '1');
	arg.siblings('.btnOptions').hide();
}

function showMessages(arg) {
	td = arg.parent().parent();
	if(td.attr('class') == "lineMessage notReaded")
	{
		var id = td.attr('id');
		id = id.replace('message', '');
		td.attr('class' , '');
		$.getJSON('Ajax/setMessageReaded.php', { id : id });
	}
	arg.parent().parent().children('td').children('pre').show();
	arg.attr('data-bool', '0');
	arg.siblings('.btnOptions').show();
}


//Fonctions de tri sur les select Catégorie et thème
function sortCategory() {
	var idCateg = $('#filterCATEGORY option:selected').attr('value');
	$('.lineMessage').hide();
	if(idCateg == "0")
	{
		$('.lineMessage').show();
	}
	else
	{
		for(var i = 0 ; i < $('.lineMessage').length ; ++i)
		{
			if(idCateg == $('.lineMessage').get(i).getAttribute('data-categ'))
			{
				$('.lineMessage')[i].style.display = "";
			}
		}
	}
}

function sortTheme() {
	var idTheme = $('#filterTHEME option:selected').attr('value');
	$('.lineMessage').hide();
	if(idTheme == "0")
	{
		$('.lineMessage').show();
	}
	else
	{
		for(var i = 0 ; i < $('.lineMessage').length ; ++i)
		{
			if(idTheme == $('.lineMessage').get(i).getAttribute('data-theme'))
			{
				$('.lineMessage')[i].style.display = "";
			}
		}
	}
}
