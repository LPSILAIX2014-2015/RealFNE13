<?php global $content_Cloud; ?>

<form hidden id="formFile" action="index.php?EX=addFile" method="POST" enctype="multipart/form-data">
    <input class="inputFile" type="file" name="file"/>
    <input type="submit"/>
</form>

<button class="addFile">Ajouter un document</button>
<button hidden class="sendFile">Valider l'ajout</button>
<button hidden class="cancelFile">Annuler l'ajout</button>
<div class="divCloud">
    <h3 class="panel-title">Cloud</h3>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="tableMessages table table-hover">
                <thead>
                    <tr>
                        <th class="USER_CLOUD">Propriétaire</th>
                        <th class="PATH">Fichier</th>
                        <th class="DATE_MESSAGE">Date</th>
                        <th class="BUTTON_MESSAGE"></th>
                    </tr>
                </thead>
                <tbody>
                    <?= $content_Cloud; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript" src="Js/cloud.js"></script>