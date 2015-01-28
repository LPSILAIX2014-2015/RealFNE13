
<br>
<div class="container-fluid">
	<div class="col-sm-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Mon profil : <?= $GLOBALS['user']->getSurname().' '.$GLOBALS['user']->getName(); ?></h3>
			</div>
			<div class="panel-body">
				<!-- <div class="row"> -->
					<img src="Img/photo.jpg" alt="Foto" class="img-thumbnail center-block" width="140px" height="140px"><br>
					<div class="row">
						<div class="col-sm-4">
							<div class="panel panel-info">
								<div class="panel-heading">
									<h3 class="panel-title">Assocation</h3>
								</div>
								<div class="panel-body">
									<?= $GLOBALS['user']->getAssoName(); ?>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="panel panel-info">
								<div class="panel-heading">
									<h3 class="panel-title">Theme details</h3>
								</div>
								<div class="panel-body">
									<?= $GLOBALS['user']->getThemeDetails();?>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="panel panel-info">
								<div class="panel-heading">
									<h3 class="panel-title">Role</h3>
								</div>
								<div class="panel-body">
									<?= $GLOBALS['user']->getRole();?>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<div class="panel panel-info">
								<div class="panel-heading">
									<h3 class="panel-title">Mail</h3>
								</div>
								<div class="panel-body">
									<?= $GLOBALS['user']->getMail(); ?>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="panel panel-info">
								<div class="panel-heading">
									<h3 class="panel-title">Address</h3>
								</div>
								<div class="panel-body">
									<?= $GLOBALS['user']->getAdress().', '.$GLOBALS['user']->getCp();?>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="panel panel-info">
								<div class="panel-heading">
									<h3 class="panel-title">Profession</h3>
								</div>
								<div class="panel-body">
									<?= $GLOBALS['user']->getProfession();?>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<div class="panel panel-info">
								<div class="panel-heading">
									<h3 class="panel-title">Profession 2</h3>
								</div>
								<div class="panel-body">
									<?= $GLOBALS['user']->getProfession2(); ?>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="panel panel-info">
								<div class="panel-heading">
									<h3 class="panel-title">Presentation</h3>
								</div>
								<div class="panel-body">
									<?= $GLOBALS['user']->getPresentation();?>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="panel panel-info">
								<div class="panel-heading">
									<h3 class="panel-title">Changer mot de passe</h3>
								</div>
								<div class="panel-body" align="center">
									<a href="index.php?EX=maillog" class="btn btn-success">Changer</a>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
</div>