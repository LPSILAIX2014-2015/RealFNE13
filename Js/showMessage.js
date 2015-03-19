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
			$(this).parent().parent().remove();
			td = $(this).parent().parent();
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
			td = $(this).parent().parent();
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
			td = $(this).parent().parent();
			var id = td.attr('id');
			id = id.replace('message', '');
			$.getJSON('Ajax/setUnMessageArchive.php', { id : id }).done(function () {
                document.location.href = "index.php?EX=consultMessages";
            });

		}
	});

	$('.currentTdMessage').on('click', function() {

		if($(this).parent().attr('data-bool') != "1")
		{
			console.log("hide");
			hideMessages($(this).parent());
		}
		else
		{
			console.log("show");
			hideAll();
			showMessages($(this).parent());
		}
	});

});

function hideAll() {
	$('.contentMessage').hide();
}

function hideMessages(arg) {
	arg.children('td').children('div').hide();
	arg.attr('data-bool', '1');
}

function showMessages(arg) {
	tr = arg;

	if(tr.attr('class') == "lineMessage notReaded")
	{
		var id = tr.attr('id');
		id = id.replace('message', '');
		tr.attr('class' , '');
		$.getJSON('Ajax/setMessageReaded.php', { id : id });
	}
	arg.children('td').children('div').show();
	arg.attr('data-bool', '0');
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
