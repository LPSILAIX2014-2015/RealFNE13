<?php global $content_Cloud; ?>
<?php global $asso_size; ?>
<?php global $idAsso; ?>

<input hidden class="idAsso" value="<?php echo $idAsso; ?>" type="text"/>

<form hidden id="formFile" action="index.php?EX=addFile" method="POST" enctype="multipart/form-data">
    <input class="inputFile" type="file" name="file"/>
    <input type="submit"/>
</form>
<button class="addFile">Ajouter un document</button>
<button hidden class="sendFile">Valider l'ajout</button>
<button hidden class="cancelFile">Annuler l'ajout</button>
<div class="divCloud">
    <h3 class="panel-title">Partage</h3>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="tableMessages table table-hover">
                <thead>
                    <tr>
                        <th class="USER_CLOUD">Propriétaire</th>
                        <th class="PATH">Fichier</th>
                        <th class="DATE_CLOUD">Date</th>
                        <th class="BUTTON_CLOUD"></th>
                    </tr>
                </thead>
                <tbody>
                    <?= $content_Cloud; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div><p >Espace utilisé : <strong class="percent"><?php echo $asso_size; ?></strong> %</p></div>

<script type="text/javascript" src="Js/cloud.js"></script>