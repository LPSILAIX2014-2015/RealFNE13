<?php global $content_messages; ?>
<?php global $content_messages_archive; ?>
<?php global $data_category; ?>
<?php global $data_theme; ?>

<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group">
							<select class="filterCATEGORY form-control">
								<option value="0">- Catégorie -</option>
								<?php
								
									for($i = 0 ; $i < count($data_category) ; ++$i)
									{
										echo '<option value="'.$data_category[$i]['ID'].'">'.$data_category[$i]['NAME'].'</option>';
									}
								
								?>
							</select>
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group">
							<select class="filterTHEME form-control">
								<option value="0">- Thème -</option>
								<?php
								
									for($i = 0 ; $i < count($data_theme) ; ++$i)
									{
										echo '<option value="'.$data_theme[$i]['ID'].'">'.$data_theme[$i]['NAME'].'</option>';
									}
								
								?>
							</select>
						</div>
					</div>
				</div>
				
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<button type="button" data-bool="1" class="displayArchive btn btn-success">Afficher les messages archivés</button>	
			</div>
		</div>
	</div>
</div>

<div class="panel panel-primary panelArchiveMessages">
	<div class="panel-heading">
		<h3 class="panel-title">Messages archivés</h3>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="tableMessages table table-hover">
				<thead>
					<tr>
						<th class="READ_MESSAGE"></th>
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

<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Messages</h3>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="tableMessages table table-hover">
				<thead>
					<tr>
						<th class="READ_MESSAGE"></th>
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




<script type="text/javascript" src="Js/showMessage.js"></script>


