<div id="contentTypeArticle">
    <form id="typeArticle">
        <div class="container-fluid">
            <div class="row">
                <div id="offsetButtonArticle"></div>
            </div>
        </div>
        <div class="col-md-8 col-md-offset-3" id="buttonCreationArticle">
        <p>
            <button id="buttonCreateArticle" type="button" class="btn btn-primary">Créer un Article</button>
            <button id="buttonCreateArticleInCalendar" type="button" class="btn btn-primary">Créer un Article lié à un évènements</button>
        </p>
        </div>
    </form>
</div>

<div id="contentCreateArticle" hidden="true">

    <!-- form standart article -->

    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label for="articleTheme" class="col-sm-2 control-label">Theme de l'article</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="articleTheme" placeholder="Theme">
            </div>
        </div>

        <!-- This field is for Calendar event-->

        <div id="inputOnlyCalendar" class="form-group" hidden>
            <label for="endDate" class="col-sm-2 control-label">Durée de l'évènement en jours</label>
            <div class="col-sm-10">
                <input type="datetime" class="form-control" id="endDate" placeholder="Date de fin">
            </div>
        </div>

        <div id="FieldArticleEdition">
            <p>
                <input type="button" value="G" onclick="insertTag('<g>', '</g>', 'textarea');" />
                <input type="button" value="I" onclick="insertTag('<i>', '</i>', 'textarea');"/>
                <input type="button" value="Lien" onclick="insertTag('<>', '</>', 'textarea', 'lien');"/>
                <input type="button" value="Citation" onclick="insertTag('<cite>', '</cite>', 'textarea');"/>
                <label style="margin-left:10px" for="setTextHeigth">Taille</label>
                <select id="setTextHeigth" onchange="insertTag('<taille valeur=&quot;' + this.options[this.selectedIndex].value + '&quot;>', '</taille>', 'textarea');">
                    <option value="tpetit">Trés Petit</option>
                    <option value="petit">Petit</option>
                    <option class="selected" value="normal" selected="selected">Normal</option>
                    <option value="gros">Gros</option>
                    <option value="tgros">Trés Gros</option>
                </select>
            </p>
        </div>
        <textarea onkeyup="preview();" onselect="preview();" id="textareaId" cols="150" rows="10"></textarea>

        <div id="previewDiv"></div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-danger">Annuler</button>
                <button type="submit" class="btn btn-success">Envoyer l'article à la validation</button>
            </div>
        </div>
    </form>
</div>