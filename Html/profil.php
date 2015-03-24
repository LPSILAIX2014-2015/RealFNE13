<h1>Mon profil</h1>
    <div class="profileInfos">
			<h3><?= $GLOBALS['user']->getName().' '.$GLOBALS['user']->getSurname(); ?></h3>

            <?php


            $pdo = new MDBase();
            $i=0;
            $themesList = $pdo -> getAllThemes();
            foreach($themesList as $line){
                $themes[$i]['ID']=$line['ID'];
                $themes[$i]['NAME']=$line['NAME'];
                $i++;
            }

            ?>

			<div class="profilePicBloc">
				<img src="<?= $GLOBALS['user']->getPhotopath(); ?>" alt="Image" class="img-thumbnail center-block" width="140px" height="140px">
				<input type="button" value="Changer mon image" onclick="view('cmi')">
            </div>
			<div>
                <label>Association</label>
				<?= $GLOBALS['user']->getAssoName(); ?>
            </div>
			<?PHP if ($GLOBALS['user']->getTheme()) { ?><div>
                <label>Thème d'expertise</label>
                <?= (new MTheme($GLOBALS['user']->getTheme()))->getName();?>
            </div><?PHP } ?>
            <?PHP if ($GLOBALS['user']->getThemeInterest()) { ?><div>
                <label>Thème d'intérêt</label>
                <?= (new MTheme($GLOBALS['user']->getThemeInterest()))->getName();?>
            </div><?PHP } ?>
            <?PHP if ($GLOBALS['user']->getThemeDetails()) { ?><div>
                <label>Thème détails</label>
                <?= $GLOBALS['user']->getThemeDetails();?>
            </div><?PHP } ?>
			<div>
                <label>E-mail</label>
                <?= $GLOBALS['user']->getMail(); ?>
			</div>
            <div>
                <label>Adresse</label>
                <?PHP echo nl2br($GLOBALS['user']->getAddress()).', '.$GLOBALS['user']->getCp();?>
            </div>
			<div>
				<label>Profession</label>
				<?= $GLOBALS['user']->getProfession();?>
			</div>
            <?PHP if ($GLOBALS['user']->getProfession2()) { ?><div>
				<label>Profession secondaire</label>
				<?= $GLOBALS['user']->getProfession2(); ?>
			</div><?PHP } ?>
			<?PHP if ($GLOBALS['user']->getPresentation()) { ?><div class="profilePresentation">
				<label>Présentation</label>
				<?PHP echo nl2br($GLOBALS['user']->getPresentation());?>
			</div><?PHP } ?>
    </div>
				<div class="profileChangeImage" id="cmi" style="display: none;">
					<div class="col-sm-12">
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-title">Changer mon image de profil</h3>
							</div>
							<div class="panel-body" align="center">
								<form role="form" class="form-vertical" id="frmCHIMG" enctype="multipart/form-data">
									<div class="form-group" align="center">
										<label for="sel_img" class="control-label">Sélectionnez une image</label>
										<div class="controls">
											<input type="file" id="sel_img" name="sel_img" class="form-control btn-info">
										</div>
									</div>
                                    <input type="reset" value="Annuler" onClick="view('cmi')">
									<input type="submit" name="btnIm" id="btnIm" class="btn btn-info center-block" value="Upload">
									<div id="chI"></div><!-- id="error"--><br>
								</form>
							</div>
						</div>
					</div>
				</div>
    <div class="profileChangepass">
                            <a href="#" onclick="view('ch')" id="btn_changer"><h3 class="panel-title">Changement de mot de passe</h3></a>

							<div class="panel-body" align="center">
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
											<label for="rnew_pass" class="control-label">Confirmez votre nouveau mot de passe</label>
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

	<br>
	    <div class="profileChangepass">
                            <a href="#" onclick="view('ch1')" id="btn_changer1"><h3 class="panel-title">Modification de profil</h3></a>

							<div class="panel-body" align="center">
								<div id="ch1" style="display: none;">
									<br>
									<form role="form" class="form-vertical" id="formprofil" action="Php/updateMember.php" method="post">
                                        <div class="control-group">
                                            <label class="control-label">Profession</label>
                                            <div class="controls">
                                                <input name="PROFESSION" id="profession" type="text"  placeholder="Profession" value="<?= $GLOBALS['user']->getProfession(); ?>">

                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Présentation</label>
                                            <div class="controls">
                                                <input name="PRESENTATION" id="presentation" type="text"  placeholder="Présentation" value="<?= $GLOBALS['user']->getPresentation(); ?>">

                                            </div>
                                        </div>
                                        <div class="control-group">

                                            <label class="control-label">Deuxième profession</label>
                                            <div class="controls">
                                                <input name="PROFESSION2" id="profession2" type="text"  placeholder="Deuxième profession" value="<?= $GLOBALS['user']->getProfession2(); ?>">

                                            </div>
                                        </div>

                                        <div class="control-group">

                                            <label for="themes1" class="control-label">Th&eacute;matique d'expertise</label>
                                            <div class="controls">
                                                <select class="controls" name="THEME" type="text" id="themes1">
                                                    <?php
                                                    $theme1 = $GLOBALS['user']->getTheme();
                                                    foreach ($themes as $key => $theme) {
                                                        if($theme['ID']==$theme1)
                                                            echo('<option value ='.$theme['ID'].' selected>'.$theme['NAME'].'</option>');
                                                        else
                                                            echo('<option value ='.$theme['ID'].'>'.$theme['NAME'].'</option>');
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="control-group">

                                            <label class="control-label">Thème détails</label>
                                            <div class="controls">
                                                <input name="THEMEDETAILS" id="themedetails" type="text"  placeholder="Thème détails" value="<?= $GLOBALS['user']->getThemeDetails(); ?>">

                                            </div>
                                        </div>


                                        <div class="control-group">

                                            <label for="themes2" class="control-label">Th&eacute;matique d'implication</label>
                                            <div class="controls">
                                                <select class="controls" name="THEME2" type="text" id="themes2">
                                                    <?php
                                                    $theme2 = $GLOBALS['user']->getThemeInterest();
                                                    foreach ($themes as $key => $theme) {
                                                        if($theme['ID']==$theme2)
                                                            echo('<option value ='.$theme['ID'].' selected>'.$theme['NAME'].'</option>');
                                                        else
                                                            echo('<option value ='.$theme['ID'].'>'.$theme['NAME'].'</option>');
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" id="user_id" name="ID" value="<?= $GLOBALS['user']->getId(); ?>">
										<input type="submit" name="btnConf1" class="btn btn-info center-block">
										<div id="chP1"></div><!-- id="error"--><br>
									</form>
								</div>
							</div>
    </div>

    <script src="./Js/changeImage.js"></script>
