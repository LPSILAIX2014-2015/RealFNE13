<div id="contentTypeArticle">
    

     <!--
                                             ------------------------------
                                             --     Div Message error    --
                                             ------------------------------
     -->


    <div class="col-md-8 col-md-offset-2" id="errorMsg" hidden="true">

                    <!--                -- Errors messages will appear here --                      -->
    
    </div>

    <!--
                                             ------------------------------
                                             --     Creation Buttons     --
                                             ------------------------------
     -->

    <div class="col-md-8 col-md-offset-2" id="buttonCreationArticle">

        <button id="buttonCreateArticle" type="button" class="btn btn-primary buttonCreate">Créer un Article</button>
        <button id="buttonCreateArticleInCalendar" type="button" class="btn btn-primary buttonCreate">Créer un Article lié à un évènements</button>
 
    </div>
</div>

<div id="contentCreateArticle" hidden="true">

    <!--
                                             ------------------------------
                                             --   form standart article  --
                                             ------------------------------
     -->

    <form class="form-horizontal" role="form" action="index.php?EX=formCreateArticle" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="articleTitle" class="col-sm-3 control-label">Titre de l'article</label>
            <div class="col-sm-5">
                <input type="text" name="articleTitle" class="form-control" id="articleTitle" placeholder="Titre">
            </div>
        </div>

        <div class="form-group">
            <label for="articleTheme" class="col-sm-3 control-label">Theme de l'article</label>
            <div class="col-sm-5">
                <input type="text" name="articleTheme" class="form-control" id="articleTheme" placeholder="Theme">
            </div>
        </div>

        <div class="form-group">
            <label for="articleImage" class="col-sm-3 control-label">Image d'illustration</label>
            <div class="col-sm-5">
                <input type="file" id="articleImage" name="articleImage">
            </div>
        </div>
        <input type="hidden" name="max_file_size" value="5000">

        <!-- 
                                     ------------------------------------------------------
                                     -- These fields dissplayed only for Calendar event  --
                                     ------------------------------------------------------
        -->

        <div class="inputOnlyCalendar form-group" hidden>
            <label for="eventPlace" class="col-sm-3 control-label">Lieu de l'évènement</label>
            <div class="col-sm-5">
                <input type="text" name="eventPlace" class="form-control" id="eventPlace" placeholder="Lieu">
            </div>
        </div>
        <div class="inputOnlyCalendar form-group" hidden>
            <label for="startDate" class="col-sm-3 control-label">Date et heure de début de l'évènement</label>
            <div class="col-sm-5">
                <input type="datetime-local" name="startDate" class="form-control" id="startDate" placeholder="jj/mm/aaaa hh/mm">
            </div>
        </div>
        <div class="inputOnlyCalendar form-group" hidden>
            <label for="duration" class="col-sm-3 control-label">Durée de l'évènement en jours</label>
            <div class="col-sm-2">
                <input type="number" name="duration" class="form-control" id="duration" min="1" placeholder="Durée">
            </div>
        </div>
        <div class="inputOnlyCalendar" hidden>
            <div class="form-group checkbox" style="text-align: center; margin-bottom: 20px;">
                <label>
                    <input type="checkbox" name="inscription" id="inscription"> Inscription à l'évènement obligatoire ?
                </label>
            </div>
        </div>


        <?php 
            echo '<input type="hidden" id="verfiUser" value="'.$_SESSION['ID_USER'].'" />' 
        ?>

        <!-- 
                                                --------------------------------
                                                --  Text Formatting options   --
                                                --------------------------------
        -->

        <div id="FieldArticleEdition">
            <p>
                <span class="btn-group">
                    <button class ="btn btn-default" type="button" value="G" onclick="insertTag('<g>', '</g>');">
                        <span class="glyphicon glyphicon-bold" aria-hidden="true"></span>
                    </button>
                    <button class ="btn btn-default" type="button" value="I" onclick="insertTag('<i>', '</i>');">
                        <span class="glyphicon glyphicon-italic" aria-hidden="true"></span>
                    </button>
                    <button class ="btn btn-default" type="button" value="S" onclick="insertTag('<u>', '</u>');">
                        <span class="glyphicon glyphicon-text-width" aria-hidden="true"></span>
                    </button>
                </span>
                <span class="btn-group">
                    <button class ="btn btn-default" type="button" value="Lien" onclick="insertTag('<>', '</>', 'lien');">
                        <span class="glyphicon glyphicon-link" aria-hidden="true"></span>
                    </button>
                    <button class ="btn btn-default" type="button" value="Citation" onclick="insertTag('<cite>', '</cite>', 'cite');">
                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                    </button>
                </span>
                <label style="margin-left:10px" for="setTextHeigth">Taille</label>
                <select id="setTextHeigth" style="height:32px; padding-top:2px;" onchange="insertTag('<taille valeur=&quot;' + this.options[this.selectedIndex].value + '&quot;>', '</taille>');">
                    <option value="tpetit">Trés Petit</option>
                    <option value="petit">Petit</option>
                    <option class="selected" value="normal" selected="selected">Normal</option>
                    <option value="gros">Gros</option>
                    <option value="tgros">Trés Gros</option>
                </select>
                <span class="btn-group" style="margin-left:10px">
                    <button class ="btn btn-default" type="button" onclick="insertTag('<aligne valeur=&quot;gauche&quot;>', '</aligne>');">
                        <span class="glyphicon glyphicon-align-left" aria-hidden="true"></span>
                    </button>
                    <button class ="btn btn-default" type="button" onclick="insertTag('<aligne valeur=&quot;centrer&quot;>', '</aligne>');">
                        <span class="glyphicon glyphicon-align-center" aria-hidden="true"></span>
                    </button>
                    <button class ="btn btn-default" type="button" onclick="insertTag('<aligne valeur=&quot;droite&quot;>', '</aligne>');">
                        <span class="glyphicon glyphicon-align-right" aria-hidden="true"></span>
                    </button>
                </span>
            </p>
        </div>

        <!-- 
                                                --------------------------------
                                                --   TextArea + div Preview   --
                                                --------------------------------
        -->

        <textarea onkeyup="preview();" onselect="preview();" onclick="preview();" id="textareaId" cols="122" rows="10"></textarea>

        <div id="previewDiv"></div>
        <input type="hidden" name="textareaDecrypt" id="textareaDecrypt"/>
        <div class="form-group">
            <div class="col-sm-12" id="btnActionFormDiv">
                <input id="resetForm" type="reset" class="btn btn-primary" value="Tout effacer" onclick="preview();" />
                <input type="button" class="btn btn-danger" value="Annuler" onclick="cancelCreactArticle(); "/>
                <input type="submit" class="btn btn-success" value="Envoyer l'article à la validation"/>
            </div>
        </div>
    </form>
</div>