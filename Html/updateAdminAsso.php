<?php 
	$id = 0;
	
	if ( !empty($_GET['idPrev'])) {
		$id = $_REQUEST['id'];
		$idPrev = $_REQUEST['idPrev'];
		$idNext = $_REQUEST['idNext'];
	}
	$asso= new Massoc($id);
	$prevAdmin = new Muser($idPrev);
	$nextAdmin = new Muser($idNext);
	
?>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Changement de gérant</h3>
		    		</div>

	    			<form class="form-horizontal" action="./index.php?EX=swapRoles&idPrev=<?= $idPrev?>&idNext=<?= $idNext?>" method="post">
	    			  <input type="hidden" name="id" value="<?php echo $id;?>"/>
					  <p class="alert alert-error">Le poste de gérant de <?= $asso->getName();?> passera de <?= $prevAdmin->toString();?> à <?= $nextAdmin->toString();?>.</p>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Changer de gérant</button>
                          <a class="btn" href="./index.php?EX=updateAsso&id= <?= $id?>">Retour</a>
						</div>
					</form>
				</div>

    </div> <!-- /container -->