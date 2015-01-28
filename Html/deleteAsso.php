<?php 
	$id = 0;
	
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
?>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Supprimer une association</h3>
		    		</div>
		    		
	    			<form class="form-horizontal" action="./Php/deleteAsso.php" method="post">
	    			  <input type="hidden" name="id" value="<?php echo $id;?>"/>
					  <p class="alert alert-error">Êtes-vous sûr de vouloir supprimer cette association ?</p>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-danger">Oui</button>
                                                  <a class="btn" href="./index.php?EX=manageMembers">Non</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->