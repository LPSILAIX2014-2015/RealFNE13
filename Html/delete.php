<?php
	$id = 0;

	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	if(!isset($_SESSION['ROLE'])||($_SESSION['ROLE']!='SADMIN'&&$_SESSION['ROLE']!='ADMIN'))
		header('Location: ./index.php');
	if($_SESSION['ROLE']=='ADMIN'&&(new MUser($id))->getAssociation()!=(new MUser($_SESSION['ID_USER']))->getAssociation())
    	header('Location: ./index.php?EX=manageMembers');
	$member = new MUser($id);

?>
    <div class="container">

    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Supprimer un utilisateur</h3>
		    		</div>

	    			<form class="form-horizontal" action="./index.php?EX=deleteAMember" method="post">
	    			  <input type="hidden" name="id" value="<?php echo $id;?>"/>

					  <p class="alert alert-error">Êtes-vous sûr de vouloir supprimer le membre <?php echo $member->getName()." ".$member->getSurName()?> ?</p>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-danger">Oui</button>
							<a href="./index.php?EX=manageMembers"><button type="button" class="btn">Non</button></a>

						</div>
					</form>
				</div>

    </div> <!-- /container -->
