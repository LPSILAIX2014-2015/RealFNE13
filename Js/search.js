$(document).ready(function() {
    var paginationNumberPage = 1;
    allUsers(paginationNumberPage);
    $("input[type=radio]").click(function () {
        //quitar el readonly
        $('input:text').prop("readonly", false);

        if ($('input:checked[name=option]').val() == 'all_mem') {
            $('#title').text('Tous les members de l\'association ... ');
            $('.resultt').hide();
            $('.modif').html('<select name="members_all" id="members_all" class="form-control"></select>');
            allAssociations('members_all');
            afficherMembersAsso();
        }
    });
    $("#name").click(function () {
        cleanDivs();
        var idInputName = "#s_name";
        var divName = "#suggestions_name";
        var fieldSearch = "name";
        if ($(this).is(":checked")) {
            $('#searh_name').html('<input id="s_name" class="form-control" type="text" placeholder="Name" value=""/><div id="suggestions_name"></div>');
            $('#all_mem').attr('checked', false);
            $('.modif').html('');
            focusInputs(idInputName, divName);
        } else {
            $('#searh_name').html('');
            showHideAllUsers();
        }
        $('#searh_name').val("");
        $('#searh_name').trigger('change');
        getNames(idInputName, divName, fieldSearch);

    });
    $("#surname").click(function () {
        cleanDivs();
        var idInputName = "#s_surname";
        var divName = "#suggestions_surname";
        var fieldSearch = "surname";

        if ($(this).is(":checked")) {
            $('#searh_surname').html(' <input id="s_surname" class="form-control" type="text" placeholder="Surname" value=""/><div id="suggestions_surname"></div>');
            $('#all_mem').attr('checked', false);
            $('.modif').html('');
            focusInputs(idInputName, divName);
        } else {
            $('#searh_surname').html('');
            showHideAllUsers();
        }

        $('#searh_surname').val("");
        $('#searh_surname').trigger('change');
        getNames(idInputName, divName, fieldSearch);
    });
    $("#email").click(function () {
        cleanDivs();
        var idInputName = "#s_email";
        var divName = "#suggestions_email";
        var fieldSearch = "email";

        if ($(this).is(":checked")) {
            $('#searh_email').html(' <input id="s_email" class="form-control" type="text" placeholder="Email" value=""/><div id="suggestions_email"></div>');
            $('#all_mem').attr('checked', false);
            $('.modif').html('');
            focusInputs(idInputName, divName);
        } else {
            $('#searh_email').html('');
            showHideAllUsers();
        }
        $('#searh_email').val("");
        getNames(idInputName, divName, fieldSearch);
    });
    $("#terr").click(function () {
        cleanDivs();
        var idInputName = "#s_terr";
        var divName = "#suggestions_terr";
        var fieldSearch = "terr";
        if ($(this).is(":checked")) {
            $('#searh_terr').html(' <input id="s_terr" class="form-control" type="text" placeholder="territoire" value=""/><div id="suggestions_terr"></div>');
            $('#all_mem').attr('checked', false);
            $('.modif').html('');
            focusInputs(idInputName, divName);
        } else {
            $('#searh_terr').html('');
            showHideAllUsers();
        }
        $('#searh_terr').val("");
        $('#searh_terr').trigger('change');
        getNames(idInputName, divName, fieldSearch);
    });
    $("#prof").click(function () {
        cleanDivs();
        var idInputName = "#s_prof";
        var divName = "#suggestions_profession";
        var fieldSearch = "profession";

        if ($(this).is(":checked")) {
            $('#searh_prof').html(' <input id="s_prof" class="form-control" type="text" placeholder="Profession" value=""/><div id="suggestions_profession"></div>');
            $('#all_mem').attr('checked', false);
            $('.modif').html('');
            focusInputs(idInputName, divName);
        } else {
            $('#searh_prof').html('');
            showHideAllUsers();
        }
        $('#searh_prof').val("");
        $('#searh_prof').trigger('change');
        getNames(idInputName, divName, fieldSearch);
    });
    $("#asso").click(function () {
        cleanDivs();
        var idInputName = "#s_asso";
        var divName = "#suggestions_association";
        var fieldSearch = "association";
        if ($(this).is(":checked")) {
            $('#searh_asso').html(' <select class="form-control" name="association_mod" id="association_get"></select>');
            $('#all_mem').attr('checked', false);
            $('.modif').html('');
            focusInputs(idInputName, divName);
        } else {
            $('#searh_asso').html('');
            showHideAllUsers();
        }
        $('#searh_asso').val("");
        $('#searh_asso').trigger('change');
        var value = 'association_get';
        allAssociations(value);
    });
    $("#all_mem").click(function () {
        $('.pagination').html('');
        if (this.checked) { // check select status
            $('.search_individuel').each(function () { //loop through each checkbox
                if (this.checked) {
                    this.checked = false;  //select all checkboxes with class "checkbox1"
                    var input = '#searh_' + $(this).attr('id');
                    $(input).html('');

                }

            });
        }
        $('.dataRecherche').html('');
        if ($(this).is(":checked")) {
            $('.modif').html('<select name="members_all" id="members_all" class="form-control"></select>');
        } else {
            $('.modif').html('');
            showHideAllUsers();
        }

        allAssociations('members_all');


    });

    function focusInputs(inputSearch, inputSuggestions)
    {
        $(inputSearch).focusin(function(){
            cleanDivs();
        });

    }
    /*
     * function which makes the search (button search)
     * */
    $("#btn_search").click(function (e) {
        e.preventDefault();

        var selected = [];
        $('.methodsS input:checked').each(function () {

            selected.push($(this).attr('name'));

        });
        if (selected == '') {
            alert('Vous devez cliquer sur un parameter de recherche');
            return false;
        }
        else {
            var name = '';
            var surname = '';
            var email = '';
            var terr = '';
            var prof = '';
            var asso = '';
            if ($.inArray('name', selected) > -1) {
                if($('#s_name').val() == '')
                {
                    alert('Vous devez ecrire le name');
                    return false;
                }
                else name = $('#s_name').val();
            }
            if ($.inArray('surname', selected) > -1) {
                if($('#s_surname').val() == '')
                {
                    alert('Vous devez ecrire le surname');
                    return false;
                }
                else surname = $('#s_surname').val();
            }
            if ($.inArray('email', selected) > -1) {
                if($('#s_email').val() == '')
                {
                    alert('Vous devez ecrire l\'email');
                    return false;
                }
                else email = $('#s_email').val();
            }
            if ($.inArray('terr', selected) > -1) {
                if($('#s_terr').val() == '')
                {
                    alert('Vous devez ecrire le territoire');
                    return false;
                }
                else terr = $('#s_terr').val();
            }
            if ($.inArray('prof', selected) > -1) {
                if($('#s_prof').val() == '')
                {
                    alert('Vous devez ecrire la proffession');
                    return false;
                }
                else prof = $('#s_prof').val();
            }
            if ($.inArray('asso', selected) > -1) {

                asso = $('#association_get option:selected').val();
            }



            getResultsSearch(name, surname, email, terr, prof, asso);


        }
    });
    /**
     * Function to show the profile detail when click on button 'image' of a record on the table of resultats
     * @return popup with info of an user
     */
    function showDetailsUser()
    {
        $('.afficher').click(function(e) { //loop through each checkbox
            e.preventDefault();
            var id = $(this).attr('data');
            $.ajax({
                type: "POST",
                url: "Php/search3.php",
                data: {idDetailUser : id},
                beforeSend :  function(){$('#detailUser').html("<tr class='trwait'><td colspan='6' style='text-align: center'><img src='Img/wait.gif' class='wait' alt=''/></td></tr>");},
                success: function (data) {
                    $('.trwait').remove();
                    $('#detailUser').html(data);
                }
            });

        });
    }

    /**
     * Function to show / hide all users in function to checkboxes
     * @return table all users if neither is checked
     */
    function showHideAllUsers()
    {
        if ($(".methodsS input:checkbox:checked").length == 0)
        {
            allUsers(paginationNumberPage);
        }
    }

    /**
     * Function to show all members of an association when checkbox "Tous les members d'un association" is selected
     * @return table with all members of an association
     */
    function afficherMembersAsso() {
        $("#members_all").change(function () {
            $('.dataRecherche').html('<div class="table-responsive"><table class="table table-striped table-responsive" id="tableAllMembersAsso"><tr>' +
            '<th>Nom</th><th>Thème</th><th>Association</th><th>Territorire</th><th>Profil</th><th>Message</th>' +
            '</tr>' +
            '</table></div>');
            var id = $('#members_all option:selected').val();
            getAllMembersAsso(id);
        });
    }

    /**
     * Function for clean divs commons
     * @return div cleans
     */
    function cleanDivs()
    {
        $('#allUsers').html('');
        $('.dataRecherche').html('');
        $('.pagination').html('');
    }

    /**
     * Function for get all associations and put it in the input select (parameter value)
     * @param value
     * @return input select with the associations
     */
    function allAssociations(value) {
        var origin = value;
        var associations = "";
        $.getJSON("Php/search2.php", function (data) {
            $.each(data, function (index, item) {
                associations += "<option value='" + item.ID + "'>" + item.asso_name + "</option>";
            });
            if (origin == 'association_mod') {
                $('#association_mod').html(associations);
            }
            if (origin == 'members_all') {
                $('#members_all').html(associations);
                afficherMembersAsso();
                $('#members_all').trigger('change');
            }
            if (origin == 'association_get') {
                $('#association_get').html(associations);
            }

        });

    }



    /**
     *Function for get the suggestions in the inputs form
     * @params String value (div id input for search), divname (div name for get suggestions), fieldSearch (name field to search)
     **/
    function getNames(value, divName, fieldSearch) {
        $(value).on('input', function () {
            if ($(this).val() == "") {
                $(value).attr({'value': ''})
            }
            var name = $(this).val();
            var dataString = fieldSearch + '=' + name;
            $.ajax({
                type: "POST",
                url: "Php/search2.php",
                data: dataString,
                success: function (data) {
                    //Escribimos las sugerencias que nos manda la consulta
                    $(divName).fadeIn(800).html(data);

                    //Al hacer click en algua de las sugerencias
                    $('.list-group-item').on('click', function () {
                        //Obtenemos la id unica de la sugerencia pulsada
                        var id = $(this).attr('id');

                        //Editamos el valor del input con data de la sugerencia pulsada
                        $(value).val($(this).attr('data'));

                        $(value).attr({'value': id})
                        //Hacemos desaparecer el resto de sugerencias
                        $(divName).fadeOut(800);
                    });
                    setTimeout(function(){
                        $(divName).fadeOut("slow");
                    },3000);
                }
            });
        });
    }

    /**
     * Function for get the records of search
     * @params String name, surname, email,terr, prof, asso
     * @return Result of search a record with the params and insert the table with the resultats
     **/
    function getResultsSearch(name, surname, email, terr, prof, asso, page) {
        $('.dataRecherche').html('<div class="table-responsive"><table class="table table-striped table-responsive" id="tableDetailSearch"><tr>' +
        '<th>Nom</th><th>Thème</th><th>Association</th><th>Territorire</th><th>Profil</th><th>Message</th>' +
        '</tr>' +
        '</table></div>');
        if(page == null)
        {
            page = 1;
        }
        $.ajax({
            type: "POST",
            url: "Php/search3.php",
            data: {'page' : page, 'searchInputs' : 'yes', 'name': name, 'surname': surname, 'email': email, 'terr': terr, 'prof': prof, 'asso': asso},
            success: function (data) {
                var data = $.parseJSON(data);
                $('.pagination').html('');
                $('#paginate').append(data['pag']);
                //Add the rows of execute a query
                $('#tableDetailSearch > tbody').append(data['resultado']);
                //Show the detail of a record
                $('.pagi').click(function(e)
                {
                    e.preventDefault();
                    var page = ($(this).attr('value'));
                    getResultsSearch(name,surname,email,terr,prof,asso,page)
                    //allUsers(page,div,typeSearch, valueT);
                });
                showDetailsUser();
                //Event bpopup jquery for show the detail
                $('.afficher').click(function(){
                    $('#detailUser').bPopup();
                });
            }
        });

    }
    /**
     * Function for get all members of a association
     * @params Integer idasso - ID association
     * @return Table with the users of an association
     **/
    function getAllMembersAsso(idasso) {
        $('#allUsers').html('');
        var div = '#tableAllMembersAsso > tbody';
        $.ajax({
            type: "POST",
            url: "Php/search.php",
            data: {'asso': idasso, 'page' : paginationNumberPage },
            success: function (data) {
                //Parse JSON of reponse PHP
                var data = $.parseJSON(data);
                $('.pagination').html('');
                $('.pagination').append(data['pag']);
                //Add the rows of execute a query

                $(div).append(data['resultado']);
                //Show the detail of a record
                showDetailsUser();
                pagination(div,'asso',idasso);
                //allUsers(paginationNumberPage, div);
                //Event bpopup jquery for show the detail
                $('.afficher').click(function(){
                    $('#detailUser').bPopup();
                });
            }
        });
    }

    /**
     * Function for get all users at open the section recherche
     * @return table with all users
     */
    function allUsers(nmbPage, div, typeOfSearch, valueTypeSearch)
    {

        var typeS ;
        var valueS ;
        var dataObject = {};

        $('#allUsers').html('<div class="table-responsive"><table class="table table-striped" id="tableAllMembers"><tr>' +
        '<th>Nom</th><th>Thème</th><th>Association</th><th>Territorire</th><th>Profil</th><th>Message</th>' +
        '</tr>' +
        '</table></div>');
        if (div == null) {

           div = '#tableAllMembers > tbody';

        }
        if (div != '#tableAllMembers > tbody')
        {
            $('#allUsers').html('');
        }
        if (div == '#tableAllMembersAsso > tbody')
        {
            $('.dataRecherche').html('<div class="table-responsive"><table class="table table-striped table-responsive" id="tableAllMembersAsso"><tr>' +
            '<th>Nom</th><th>Thème</th><th>Association</th><th>Territorire</th><th>Profil</th><th>Message</th>' +
            '</tr>' +
            '</table></div>');
        }
        if (typeOfSearch == null){
            typeS = "all";
            dataObject[typeS] = typeS;
        }
        else {
            typeS = typeOfSearch;
            valueS = valueTypeSearch;
            dataObject[typeS] = valueS;
            $('#allUsers').html('');
        }
        dataObject['page'] = nmbPage;
        $.ajax({
            type: "POST",
            url: "Php/search.php",
            data: dataObject,
            beforeSend: function(){$(div).append("<tr class='trwait'><td colspan='6' style='text-align: center'><img src='Img/wait.gif' class='wait' alt=''/></td></tr>");},
            success: function (data) {
                $('.trwait').remove();
                var data = $.parseJSON(data);
                //$(div).html('');
                $('.pagination').html('');
                $('.pagination').append(data['pag']);
                //Add the rows of execute a query
                $(div).append(data['resultado']);

                //Show the detail of a record
                showDetailsUser();
                pagination(div);
                //Event bpopup jquery for show the detail
                $('.afficher').click(function(){
                    $('#detailUser').bPopup();
                });
            }
        });
    }
    $('#paginate').click(function(e) {
        e.preventDefault();
    });
    function pagination(div, typeSearch,valueT){
    $('.pagi').click(function(e)
    {
        e.preventDefault();
        var page = ($(this).attr('value'));
        allUsers(page,div,typeSearch, valueT);
    });
    }



});