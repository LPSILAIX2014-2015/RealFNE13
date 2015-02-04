<?php
    $i=0;
    $pdo = new MDBase();
    $territoryList = $pdo -> getAllTerritories();
    foreach($territoryList as $line){
    	$territories[$i]['ID']=$line['ID'];
    	$territories[$i]['NAME']=$line['NAME'];
    	$i++;
    }

    $i=0;
    $themeList = $pdo -> getAllThemes();
    foreach($themeList as $line){
    	$themes[$i]['ID']=$line['ID'];
    	$themes[$i]['NAME']=$line['NAME'];
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
		    			<h3>Créer une association</h3>
		    		</div>

	    			<form class="form-horizontal" action="index.php?EX=createAdmin" method="post">
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
					  <div class="control-group">
					    <label class="control-label">Theme</label>
					    </br>
					    <select class="controls" name="THEME" type="text">
					      	<?php 
					    		foreach ($themes as $key => $theme) {
					    				echo('<option value ='.$theme['ID'].'>'.$theme['NAME'].'</option>');
					    			}
					    	?>
					    </select>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Créer l'association</button>
                          <a class="btn" href="./index.php?EX=manageAsso">Retour</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->