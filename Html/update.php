<?php
	if(!isset($_SESSION['ROLE']) || (($_SESSION['ROLE']!='SADMIN' && $_SESSION['ROLE']!='ADMIN')))
		header('Location: ./index.php');
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	else
		header('Location: ./index.php?EX=manageMembers');

    // insert data
    $user= new MUser($id);
    $name = $user->getName();
    $surname = $user->getSurname();
    $theme2 = $user->getThemeInterest();
    $theme1 = $user->getTheme();
    $themedetails= $user->getThemeDetails();
    $cp = $user->getCp();
    $profession = $user->getProfession();
    $profession2 = $user->getProfession2();
    $presentation = $user->getPresentation();
    $assoc=$user->getAssoName();
    if($_SESSION['ROLE']=='ADMIN'&&$user->getAssociation()!=(new MUser($_SESSION['ID_USER']))->getAssociation())
    	header('Location: ./index.php?EX=manageMembers');
     $erreur = null;
     if(isset($_GET['error'])) {
         $erreur = $_GET['error'];
     }
		$i=0;
		$pdo=new MDBase();
		$themesList = $pdo -> getAllThemes();
		foreach($themesList as $line){
				$themes[$i]['ID']=$line['ID'];
				$themes[$i]['NAME']=$line['NAME'];
				$i++;
		}

    ?>

    <div class="container">

    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Modifier un utilisateur</h3>
		    		</div>

	    			<form class="form-horizontal" id="updateMemberForm" action="index.php?EX=updateAMember&id=<?php echo $id?>" method="post">
					  <div class="control-group">
					    <label class="control-label">Nom</label>
					    <div class="controls">
					      	<input name="SURNAME" type="text" pattern="[^'\x22\;\.]+" placeholder="Nom" value="<?php echo !empty($surname)?$surname:'';?>">
					      	<span>(Alphabétique)</span>
					    </div>
					  </div>
                                          <div class="control-group">
					    <label class="control-label">Pr&eacute;nom</label>
					    <div class="controls">
					      	<input name="NAME" type="text"  pattern="[^'\x22\;\.]+" placeholder="Prénom" value="<?php echo !empty($name)?$name:'';?>">

					    </div>
					  </div>
                      <div class="control-group">
					    <label class="control-label">Code postal</label>
					    <div class="controls">
					      	<input name="CP" type="text" pattern="[0-9]{5}" placeholder="Code postal" value="<?php echo !empty($cp)?$cp:'';?>">
					      	<span>(5 chiffres)</span>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Profession</label>
					    <div class="controls">
					      	<input name="PROFESSION" type="text"  placeholder="Profession" value="<?php echo !empty($profession)?$profession:'';?>">

					    </div>
					  </div>
                      <div class="control-group">
                        <label class="control-label">Profession secondaire</label>
                        <div class="controls">
                            <input name="PROFESSION2" type="text"  placeholder="Profession secondaire" value="<?php echo !empty($profession2)?$profession2:'';?>">

                        </div>
                      </div>
                        <div class="control-group">

                            <label for="themes1" class="col-sm-2 control-label">Th&eacute;matique d'expertise</label>
                            <div class="controls">
                                <select class="controls" name="THEME" type="text">
                                    <?php
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
                            <label class="control-label">Sous th&eacute;matique</label>
                            <div class="controls">
                                <input name="DETAILS" type="text" rows="5" cols="40" placeholder="Sous thématique" value="<?php echo !empty($themedetails)?$themedetails:'';?>">
                            </div>
                        </div>
                        <div class="control-group">

                            <label for="themes2" class="col-sm-2 control-label">Th&eacute;matique d'implication</label>
                            <div class="controls">
                                <select class="controls" name="THEME2" type="text">
                                    <?php
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
                        <div class="control-group">
                            <label class="control-label">Pr&eacute;sentation</label>
                            <div class="controls">
                                <textarea name="PRESENTATION" id="presentation" type="text" rows="10" cols="90" placeholder="Présentation" value="<?php echo !empty($presentation)?$presentation:'';?>"></textarea>
                            </div>
                        </div>

					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Edit</button>
<<<<<<< HEAD
							<a href="./index.php?EX=manageMembers"><button type="button" class="btn">Retour</button></a>
=======
                          <a class="btn" href="./index.php?EX=manageMembers">Retour</a>
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b
						</div>
					</form><!--
                    <form class="form-horizontal" id="frmCHIMG" enctype="multipart/form-data" method="post">
                        <div class="control-group">
                            <label class="control-label">Photo</label>
                            <div class="controls">
                                <input type="file"  id="sel_img" name="PHOTO" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">Edit</button>
                        </div>
                        <div id="chI"></div><br>
                    </form> -->

					<form class="form-horizontal" action="index.php?EX=updateRole&id=<?php echo $id?>" method="post">
						<div class="control-group">

								<label for="themes1" class="col-sm-2 control-label">Nouveau Rôle</label>
								<div class="controls">
										<select class="controls" name="ROLE" type="text">
<<<<<<< HEAD
														<option value ='MEMBER'>Membre</option>
														<option value ='VALIDATOR'>Validateur</option>
=======
														<option value ='VALIDATOR'>Validateur</option>
														<option value ='MEMBER'>Membre</option>
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b
												?>
										</select>
								</div>
						</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-success">Edit</button>
<<<<<<< HEAD
						<a href="./index.php?EX=manageMembers"><button type="button" class="btn">Retour</button></a>
=======
												<a class="btn" href="./index.php?EX=manageMembers">Retour</a>
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b
					</div>
				</form>
				</div>

    </div> <!-- /container -->
