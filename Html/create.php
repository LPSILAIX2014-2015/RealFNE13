<?php
	if(!isset($_SESSION['ROLE'])||($_SESSION['ROLE']!='SADMIN'&&$_SESSION['ROLE']!='ADMIN'))
		header('Location: ./index.php');
    $i=0;
    $pdo = new MDBase();
    $assocsList = $pdo -> getAllAssocs();
    foreach($assocsList as $line){
        $assocs[$i]['ID']=$line['ID'];
        $assocs[$i]['NAME']=$line['NAME'];
        $i++;
    }

    $erreur = null;
    if(isset($_GET['error'])) {
         $erreur = $_GET['error'];
    }

    if ( isset($_POST['SURNAME'])) {
        $surname = $_POST['SURNAME'];
        $name = $_POST['NAME'];
        $email = $_POST['EMAIL'];
        $association = $_POST['ASSOCIATION'];
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO USER (SURNAME, NAME, EMAIL, ASSOCIATION_ID) values(?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($surname, $name, $email, $association));
        $id= $pdo->lastInsertId();
        echo $id;
        header("./index.php?EX=createUser&id=".$id);
    }
?>
    <div class="container">

    			<div class="span10 offset1">
    				<div class="row">
		    			<h2>Création d'un utilisateur</h2>
                                        <?php if(!empty($erreur)) { ?>
                                        <div class="isa_error">Utilisateur existe!</div>
                                        <?php } ?>
		    		</div>
	    			<form class="form-horizontal" action="index.php?EX=createUser" method="post">
						<div class="control-group">
				            <label class="control-label">Nom de famille</label>
				            <div class="controls">
				                <input name="SURNAME" id="surname" type="text"  placeholder="Nom" pattern="[^'\x22\;\.]+" value="">
				                <span>(Alphabétique)</span>
				            </div>
				        </div>
				        <div class="control-group">
				            <label class="control-label">Pr&eacute;nom</label>
				            <div class="controls">
				                <input name="NAME" id="name" type="text"  placeholder="Prénom" pattern="[^'\x22\;\.]+" value="">

				            </div>
				        </div>
				        <div class="control-group">
					    	<label class="control-label">Email</label>
					    	<div class="controls">
					      	<input name="MAIL" id="mail" type="text"  placeholder="EMAIL" value="">

					    </div>
						</div>
						<?php
						if($_SESSION['ROLE']=='SADMIN'){
							echo '
						<div class="control-group">
		            <label class="control-label">Association</label>
		            </br>
		            <select class="controls" name="ASSOCIATION" type="text">';
		                        foreach ($assocs as $asso) {
		                            echo('<option value ='.$asso['ID'].'>'.$asso['NAME'].'</option>');
		                        }
		                    ?>
		            </select>
		        </div>
						<div class="control-group">
		            <label class="control-label">R&ocirc;le</label>
		            </br>
		            <select class="controls" name="ROLE" type="text">
		                <option value ='MEMBRE' selected>Membre</option>
		                <option value ='VALIDATOR'>Mod&eacute;rateur</option>
		                <option value ='ADMIN'>Administrateur</option>
		            </select>
		        </div>
						<?php } ?>
				        <div class="form-actions">
				        	</br></br>
						  	<button type="submit" class="btn btn-success">Création</button>
                <a href="./index.php?EX=manageMembers"><button type="button" class="btn">Retour</button></a>
                      	</div>
					</form>
				</div>

    </div> <!-- /container -->
  </body>
</html>
