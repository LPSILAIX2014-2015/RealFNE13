<<<<<<< HEAD
<?php
	$id = 0;

=======
<?php 
	$id = 0;
	
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b
	if ( !empty($_GET['idPrev'])) {
		$id = $_REQUEST['id'];
		$idPrev = $_REQUEST['idPrev'];
		$idNext = $_REQUEST['idNext'];
	}
	$asso= new MAssoc($id);
	$prevAdmin = new MUser($idPrev);
	$nextAdmin = new MUser($idNext);
<<<<<<< HEAD

?>
    <div class="container">

=======
	
?>
    <div class="container">
    
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Changement de gérant</h3>
		    		</div>

	    			<form class="form-horizontal" action="./index.php?EX=swapRoles&idPrev=<?= $idPrev?>&idNext=<?= $idNext?>" method="post">
	    			  <input type="hidden" name="id" value="<?php echo $id;?>"/>
					  <p class="alert alert-error">Le poste de gérant de <?= $asso->getName();?> passera de <?= $prevAdmin->toString();?> à <?= $nextAdmin->toString();?>.</p>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Changer de gérant</button>
<<<<<<< HEAD
              <a class="btn" href="./index.php?EX=updateAsso&id= <?= $id?>"><button type="button" class="btn">Retour</button></a>
=======
                          <a class="btn" href="./index.php?EX=updateAsso&id= <?= $id?>">Retour</a>
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b
						</div>
					</form>
				</div>

<<<<<<< HEAD
    </div> <!-- /container -->
=======
    </div> <!-- /container -->
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b
