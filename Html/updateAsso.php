<?php
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
    if ( isset($_POST['NAME'])) {
        $name = $_POST['NAME'];
        $territory = $_POST['TERRITORY'];
        $pdo = new MDBase();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE ASSOCIATION SET NAME = ?, TERRITORY_ID = ? WHERE ID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($name, $territory, $id));
    }

    // insert data
    $asso= new MAssoc($id);
    $name = $asso->getName();
    $territoryID = $asso->getTerritory();
    $userList= $asso->getMembers();
    $users= array();
    $i=0;
    foreach($userList as $line){
    	$users[$i]['ID']=$line['ID'];
    	$users[$i]['NAME']=$line['NAME'];
    	$users[$i]['SURNAME']=$line['SURNAME'];
    	$i++;
    }
    $i=0;
    $pdo = new MDBase();
    $territoryList = $pdo -> getAllTerritories();
    foreach($territoryList as $line){
    	$territories[$i]['ID']=$line['ID'];
    	$territories[$i]['NAME']=$line['NAME'];
    	$i++;
    }



     $erreur = null;
     if(isset($_GET['error'])) {
         $erreur = $_GET['error'];
     }
   
    ?>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Modifier une association</h3>
                                        <?php if(!empty($erreur)) { ?>
                                        <div class="isa_error">Utilisateur existe!</div>
                                        <?php } ?>
		    		</div>

	    			<form class="form-horizontal" action="index.php?EX=updateAsso&id=<?php echo $id?>" method="post">
					  <div class="control-group">
					    <label class="control-label">Name</label>
					    <div class="controls">
					      	<input name="NAME" type="text" pattern="^[a-zA-Z \.\,\+\-]*$" placeholder="Nom" value="<?php echo !empty($name)?$name:'';?>">
					      	<span>(Alphabétique)</span>
					    </div>
					  </div>
                      <div class="control-group">
					    <label class="control-label">Territoire</label>
					    </br>
					    <select class="controls" name="TERRITORY" type="text">
					      	<?php 
					    		foreach ($territories as $key => $territory) {
					    			if($territory['ID']!=$territoryID)
					    				echo('<option value ='.$territory['ID'].'>'.$territory['NAME'].'</option>');
					    			else

					    				echo('<option value ='.$territory['ID'].' selected>'.$territory['NAME'].'</option>');
					    		}
					    	?>
					    </select>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Modifier l'association</button>
                          <a class="btn" href="./index.php?EX=manageAsso">Retour</a>
						</div>
					</form>
				</div>
				<div class="span10 offset1">
    				<div class="row">
		    			<h3>Changer le gérant de l'association</h3>
		    		</div>
					<form class="form-horizontal" action="index.php?EX=updateAdminAsso&idPrev=<?php echo $users[0]['ID'] ?>&id=<?php echo $id?>" method="post">
					    <select class="selectpicker" name="idNext">
					    	<?php 
					    		foreach ($users as $key => $user) {
					    			echo('<option value ='.$user['ID'].'>'.$user['NAME'].' '.$user['SURNAME'].'</option>');
					    		}
					    	?>
    					</select>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Changer de gérant</button>
                          <a class="btn" href="./index.php?EX=manageAsso">Retour</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->