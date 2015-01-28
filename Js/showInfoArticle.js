$(document).ready(function() {

	//When an article is clicked, redirect to showArticle
	$('.lienarticle').on('click', function() {

		var id = $(this).attr('id');
		id = id.replace(/article/, '');
		document.location.href = 'index.php?EX=showInfoArticle&id='+id;
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
    var perPage = 2;


    items.slice(perPage).hide();
    // now setup pagination
    $("#pagination").pagination({
        items: numItems,
        itemsOnPage: perPage,
        cssStyle: "compact-theme",
        onPageClick: function(pageNumber) { // this is where the magic happens
            // someone changed page, lets hide/show trs appropriately
            var showFrom = perPage * (pageNumber - 1);
            var showTo = showFrom + perPage;
            items.hide() // first hide everything, then show for the new page
            .slice(showFrom, showTo).show();
        }
    });
});