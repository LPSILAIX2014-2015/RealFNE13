<?php global $content_messages; ?>
<div class="panel panel-default">
  <div class="panel-heading">Messages</div>
  <div class="panel-body">
    <div class="table-responsive">
		<table class="tableMessages table table-hover">
			<thead>
				<tr>
					<th class="SENDER_MESSAGE">Envoyé par</th>
					<th class="TITLE_MESSAGE">Titre</th>
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
  <script type="text/javascript" src="Js/showMessage.js"></script>

	

</div>


