<?php
	if(!isset($_SESSION['ROLE']) || (($_SESSION['ROLE']!='SADMIN' && $_SESSION['ROLE']!='ADMIN')))
		header('Location: ./index.php');
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	else
		header('Location: ./index.php?EX=manageMembers');
    if ( $_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['NAME'];
        $surname = $_POST['SURNAME'];
        $email = $_POST['MAIL'];
        $cp = $_POST['CP'];
        $profession = $_POST['PROFESSION'];
        $user_id = $_GET['id'];
        $pdo = new MDBase();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE USER SET NAME = ?, SURNAME= ?, CP = ?, MAIL = ?, PROFESSION = ? WHERE ID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($name, $surname, $cp, $email, $profession, $user_id));
		//header("Location: ./index.php?EX=manageMembers");
    }

    // insert data
    $user= new MUser($id);
    $name = $user->getName();
    $surname = $user->getSurname();
    $theme2 = $user->getThemeInterest();
    $theme = $user->getTheme();
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

    ?>

    <script type="text/javascript" src="./Js/updateTestImage.js"></script>
    <div class="container">

    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Modifier un utlisateur</h3>
		    		</div>

	    			<form class="form-horizontal" id="updateMemberForm" action="index.php?EX=updateMember&id=<?php echo $id?>" method="post">
					  <div class="control-group">
					    <label class="control-label">Nom de famille</label>
					    <div class="controls">
					      	<input name="SURNAME" type="text" pattern="[^'\x22\;\.]+" placeholder="Nom" value="<?php echo !empty($name)?$name:'';?>">
					      	<span>(Alphabétique)</span>
					    </div>
					  </div>
                                          <div class="control-group">
					    <label class="control-label">Pr&eacute;nom</label>
					    <div class="controls">
					      	<input name="NAME" type="text"  pattern="[^'\x22\;\.]+" placeholder="Prénom" value="<?php echo !empty($surname)?$surname:'';?>">

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
                                <select class="controls" name="THEME" type="text" value="<?php echo $_POST[$theme];?>">
                                    <?php
                                    foreach ($themes as $key => $theme) {
                                        echo('<option value ='.$theme['ID'].'>'.$theme['NAME'].'</option>');
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Sous th&eacute;matique</label>
                            <div class="controls">
                                <input name="DETAILS" type="text" rows="5" cols="40" placeholder="Sous thématique" value="<?php echo $_POST[$themedetails];?>">
                            </div>
                        </div>
                        <div class="control-group">

                            <label for="themes2" class="col-sm-2 control-label">Th&eacute;matique d'implication</label>
                            <div class="controls">
                                <select class="controls" name="THEME2" type="text" value="<?php echo $_POST[$theme2];?>">
                                    <?php
                                    echo('<option></option>');
                                    foreach ($themes as $key => $theme) {
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
                        <div class="control-group">
                            <label class="control-label">Photo</label>
                            <div class="controls">
                                <input type="file"  name="photo" class="form-control" required="required">
                            </div>
                        </div>
                        <div id="chI"></div><!-- id="error"--><br>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Edit</button>
                          <a class="btn" href="./index.php?EX=manageMembers">Retour</a>
						</div>
					</form>
				</div>

    </div> <!-- /container -->
