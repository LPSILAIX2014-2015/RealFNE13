
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
					<div class="col-sm-12">
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-title">Mail</h3>
							</div>
							<div class="panel-body">
								<?= $GLOBALS['user']->getMail(); ?>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="panel panel-info">
								<div class="panel-heading">
									<h3 class="panel-title">Address</h3>
								</div>
								<div class="panel-body">
									<?= $GLOBALS['user']->getAddress().', '.$GLOBALS['user']->getCp();?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
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
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-title">Changer mot de passe</h3>
							</div>
							<div class="panel-body" align="center">
								<a href="#" onclick="view('ch')" id="btn_changer" class="btn btn-success center-block">Changer</a>
								<div id="ch" style="display: none;">
									<br>
									<form role="form" class="form-vertical" id="formCHMP">
										<div class="form-group" align="center">
											<label for="act_pass" class="control-label">Mot de passe actuel</label>
											<div class="controls">
												<input type="password" id="act_pass" name="act_pass" class="form-control" placeholder="Mot de passe actuel" maxlength="30">
											</div>
										</div>
										<div class="form-group" align="center">
											<label for="new_pass" class="control-label">Nouveau mot de passe</label>
											<div class="controls">
												<input type="password" id="new_pass" name="new_pass" class="form-control" placeholder="Nouveau mot de passe" maxlength="30">
											</div>
										</div>
										<div class="form-group" align="center">
											<label for="rnew_pass" class="control-label">Confirmer votre nouveau mot de passe</label>
											<div class="controls">
												<input type="password" id="rnew_pass" name="rnew_pass" class="form-control" placeholder="Confirmer votre nouveau mot de passe" maxlength="30">
											</div>
										</div>
										<div class="form-group" align="center">
											<label for="iCaptcha" class="control-label">Captcha</label><br>
											<img class="center-block" src="Html/captcha.php" /><br>
											<div class="controls">
												<input type="text" id="iCaptcha" name="iCaptcha" class="form-control" placeholder="Tapez le code" maxlength="6">
											</div>
										</div>
										<input type="submit" name="btnConf" class="btn btn-info center-block">
										<div id="chP"></div><!-- id="error"--><br>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><br>
