<?php
    $i=0;
    $pdo = new MDBase();
    $assocsList = $pdo -> getAllAssocs();
    foreach($assocsList as $line){
        $assocs[$i]['ID']=$line['ID'];
        $assocs[$i]['NAME']=$line['NAME'];
        $i++;
    }

    /*$i=0;
    $rolesList = $pdo -> getAllRoles();
    foreach($rolesList as $line){
        $roles[$i]['ID']=$line['ID'];
        $roles[$i]['NAME']=$line['NAME'];
        $i++;
    }*/ //Mettre une fonction pour récupérer les roles des membres

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
				                <input name="SURNAME" id="surname" type="text"  placeholder="Surname" pattern="^[a-zA-Z \.\,\+\-]*$" value="">
				                <span>(Alphabétique)</span>
				            </div>
				        </div>
				        <div class="control-group">
				            <label class="control-label">Pr&eacute;nom</label>
				            <div class="controls">
				                <input name="NAME" id="name" type="text"  placeholder="Name" value="">

				            </div>
				        </div>
				        <!--<div class="control-group">
				            <label class="control-label">R&ocirc;le</label>
				            </br>
				            <select class="controls" name="ROLE" type="text">
				                    <?php 
				                        /*foreach ($roles as $key => $role) {
				                            echo('<option value ='.$role['ID'].'>'.$role['NAME'].'</option>');
				                        }*/
				                    ?>
				            </select>
				        </div>--> <!-- Il manque la fonction nécessaire pour trier par roles -->
				        
				        <div class="control-group">
					    	<label class="control-label">Email</label>
					    	<div class="controls">
					      	<input name="MAIL" id="mail" type="text"  placeholder="EMAIL" value="">
					      	
					    </div>
					    <div class="control-group">
				            <label class="control-label">Association</label>
				            </br>
				            <select class="controls" name="ASSOCIATION" type="text">
				                    <?php 
				                        foreach ($assocs as $key => $asso) {
				                            echo('<option value ='.$asso['ID'].'>'.$asso['NAME'].'</option>');
				                        }
				                    ?>
				            </select>
				        </div>
				        
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