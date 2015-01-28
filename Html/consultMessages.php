<?php global $content_messages; ?>
<?php global $content_messages_archive; ?>

<div class="panel panel-default">
	<div class="panel-body">
		<button type="button" data-bool="1" class="displayArchive btn btn-success">Afficher les messages archivés</button>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Messages</h3>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="tableMessages table table-hover">
				<thead>
					<tr>
						<th class="SENDER_MESSAGE">Envoyé par</th>
						<th class="TITLE_MESSAGE">Objet</th>
						<th class="CATEGORY_MESSAGE">Catégorie</th>
						<th class="THEME_MESSAGE">Thème</th>
						<th class="DATE_MESSAGE">Date</th>
						<th class="BUTTON_MESSAGE"></th>
					</tr>
				</thead>
				<tbody>
					<?= $content_messages; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="panel panel-default panelArchiveMessages">
	<div class="panel-heading">
		<h3 class="panel-title">Messages archivés</h3>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="tableMessages table table-hover">
				<thead>
					<tr>
						<th class="SENDER_MESSAGE">Envoyé par</th>
						<th class="TITLE_MESSAGE">Objet</th>
						<th class="CATEGORY_MESSAGE">Catégorie</th>
						<th class="THEME_MESSAGE">Thème</th>
						<th class="DATE_MESSAGE">Date</th>
						<th class="BUTTON_MESSAGE"></th>
					</tr>
				</thead>
				<tbody>
					<?= $content_messages_archive; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<script type="text/javascript" src="Js/showMessage.js"></script>


