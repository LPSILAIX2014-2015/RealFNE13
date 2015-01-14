$(document).ready(function() {

	$('.buttonShowMessages').on('click', function() {
		console.log($(this).attr('class'));
		if($(this).attr('class') != "buttonShowMessages btn-sm btn-warning")
		{
			hideMessages($(this));
		}
		else
		{
			showMessages($(this));
		}		
	});

	$('.currentTdMessage').on('click', function(e) {
		var button = $(this).parent().children('td:last-child').children('.buttonShowMessages');
		if(button.attr('class') != "buttonShowMessages btn-sm btn-warning")
		{
			hideMessages(button);
		}
		else
		{
			showMessages(button);
		}		
	});

});


function hideMessages(arg) {
	arg.parent().parent().children('td').children('pre').hide();
	arg.attr('class', 'buttonShowMessages btn-sm btn-warning');
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
	arg.attr('class', 'buttonShowMessages btn-sm btn-danger');
	arg.children('i').attr('class', "glyphicon glyphicon-minus");
}


