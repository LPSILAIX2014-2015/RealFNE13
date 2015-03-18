<<<<<<< HEAD
<?php
	$id = 0;
    if(!isset($_SESSION['ROLE'])||($_SESSION['ROLE']!='SADMIN'))
        header('Location: ./index.php');
=======
<?php 
	$id = 0;
	
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
?>
    <div class="container">
<<<<<<< HEAD

=======
    
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Supprimer une association</h3>
		    		</div>
<<<<<<< HEAD

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
=======
		    		
	    			<form class="form-horizontal" action="./Php/deleteAsso.php" method="post">
	    			  <input type="hidden" name="id" value="<?php echo $id;?>"/>
					  <p class="alert alert-error">Êtes-vous sûr de vouloir supprimer cette association ?</p>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-danger">Oui</button>
                          <a class="btn" href="./index.php?EX=manageAsso">Non</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b
