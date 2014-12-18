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
                    <button class ="btn btn-default" type="button" value="Citation" onclick="insertTag('<cite>', '</cite>');">
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
        <textarea onkeyup="preview();" onselect="preview();" id="textareaId" cols="122" rows="10"></textarea>

        <div id="previewDiv"></div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-danger">Annuler</button>
                <button type="submit" class="btn btn-success">Envoyer l'article à la validation</button>
            </div>
        </div>
    </form>
</div>