<?php global $content_messages; ?>
<?php global $content_messages_archive; ?>
<?php global $content_notif; ?>
<?php global $data_category; ?>
<?php global $data_theme; ?>


<div class="filter">
	<select id="filterCATEGORY">
		<option value="0">- Catégorie -</option>
		<?php
		
			for($i = 0 ; $i < count($data_category) ; ++$i)
			{
				echo '<option value="'.$data_category[$i]['ID'].'">'.$data_category[$i]['NAME'].'</option>';
			}
		
		?>
	</select>
	<select id="filterTHEME">
		<option value="0">- Thème -</option>
		<?php
		
			for($i = 0 ; $i < count($data_theme) ; ++$i)
			{
				echo '<option value="'.$data_theme[$i]['ID'].'">'.$data_theme[$i]['NAME'].'</option>';
			}
		
		?>
	</select>
	<button type="button" data-bool="1" class="displayArchive">Afficher les messages archivés</button>
</div>


<div class="divArchiveMessages">
<<<<<<< HEAD
	<h3>Messages archivés</h3>
	<div>
		<div>
			<table class="tableMessages">
=======
	<h3 class="panel-title">Messages archivés</h3>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="tableMessages table table-hover">
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b
				<thead>
					<tr>
						<th class="SENDER_MESSAGE">Envoyé par</th>
						<th class="TITLE_MESSAGE">Objet</th>
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

<div class="divNotif">
<<<<<<< HEAD
	<h3>Messages</h3>
	<div>
		<div>
			<table class="tableMessages">
=======
	<h3 class="panel-title">Messages</h3>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="tableMessages table table-hover">
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b
				<thead>
					<tr>
						<th class="SENDER_MESSAGE">Envoyé par</th>
						<th class="TITLE_MESSAGE">Objet</th>
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

<div class="divMessages">
<<<<<<< HEAD
	<h3>Notifications</h3>
	<div>
		<div>
			<table class="tableNotif">
=======
	<h3 class="panel-title">Notifications</h3>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="tableNotif table table-hover">
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b
				<thead>
					<tr>
						<th class="NOTIFICATION_NOTIF">Notification</th>
						<th class="DATE_NOTIF">Date</th>
						<th class="BUTTON_NOTIF"></th>
					</tr>
				</thead>
				<tbody>
					<?= $content_notif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>





<script type="text/javascript" src="Js/showMessage.js"></script>


