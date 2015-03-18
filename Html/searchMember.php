<?php
global $user;
if(!(isset($_SESSION['ROLE']))){
    header("Location: ./index.php");
}
?>
<script type="text/javascript" src="Lib/jquery.bpopup.min.js"></script>
<script type="text/javascript" src="Js/search.js"></script>
<div> <!-- div main -->
    <div class="row" > <!-- div row -->
        <div class="col-md-12">
            <h1 id="title_h1">Chercher users</h1>
            <!-- list methods of search -->
            <div class="methodsS">
                <h4>Choisir la méthode de recherche: (minimum 1 type de recherche)</h4>
                <input id="name" class="search_individuel" name="name" type="checkbox" value="name">Par Prénom<br/>
                <div id="searh_name"></div>
                <input id="surname" class="search_individuel" name="surname" type="checkbox" value="surname">Par Nom<br/>
                <div id="searh_surname"></div>
                <input id="email" class="search_individuel" name="email" type="checkbox" value="email">Par Email<br/>
                <div id="searh_email"></div>
                <input id="terr" class="search_individuel" name="terr" type="checkbox" value="terr">Par Territoire<br/>
                <div id="searh_terr"></div>
                <input id="prof" class="search_individuel" name="prof" type="checkbox" value="prof">Par Profession<br/>
                <div id="searh_prof"></div>
                <input id="asso" class="search_individuel" name="asso" type="checkbox" value="asso">Par Association<br/>
                <div id="searh_asso"></div>
                <input id="all_mem" name="all_mem" type="checkbox" value="all_mem">Tous les membres d'une association
                <div class="modif"></div>
                <div class="dataRecherche table-responsive"></div>
                <input class="val" type="hidden" value="" id=""/>
            </div><!-- / list methods of search -->
            <div id="allUsers"></div>
            <div id="detailUser"></div>
            <ul class="pagination " id="paginate" >
            </ul>
            <p><a class="btn btn-sm" id="btn_search" href="#" role="button">Recherche</a></p>
            <p><a class="btn btn-sm pull-left" href="index.php?EX=searchMember" role="button">Réinitialiser</a></p>
        </div>
    </div> <!-- end div row -->
</div> <!-- end div main -->
