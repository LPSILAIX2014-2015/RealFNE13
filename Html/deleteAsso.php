<?php
	$id = 0;
    if(!isset($_SESSION['ROLE'])||($_SESSION['ROLE']!='SADMIN'))
        header('Location: ./index.php');
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

?>
    <div class="">

    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Supprimer une association</h3>
		    		</div>

	    			<form class="form-horizontal" action="./Php/deleteAsso.php" method="post">
	    			  <input type="hidden" name="id" value="<?php echo $id;?>"/>
					  <p class="alert alert-error">Êtes-vous sûr de vouloir supprimer l'association <?php echo (new MAssoc($id))->getName()?> ?</p>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-danger">Oui</button>
							<a href="./index.php?EX=manageAsso"><button type="button" class="btn">Non</button></a>
						</div>
					</form>
				</div>

    </div> <!-- /container -->
