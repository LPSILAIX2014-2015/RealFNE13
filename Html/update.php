<?php 
        include '../Php/DBase.php';
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
        if ( !empty($_POST)) {
		$name = $_POST['NAME'];
                $surname = $_POST['SURNAME'];
		$email = $_POST['MAIL'];
		$cp = $_POST['CP'];
                $profession = $_POST['PROFESSION'];
		$user_id = $_GET['id'];
                $pdo = DBase::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE user SET NAME = ?, SURNAME= ?, CP = ?, MAIL = ?, PROFESSION = ? WHERE ID = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($name, $surname, $cp, $email, $profession, $user_id));
		DBase::disconnect();
		header("Location: ../Html/datatable.php");
                
        }
		// insert data
        
		$pdo = DBase::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM user where ID = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$name = $data['NAME'];
                $surname = $data['SURNAME'];
		$email = $data['MAIL'];
		$cp = $data['CP'];
                $profession = $data['PROFESSION'];
		DBase::disconnect();
	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
     include './header.php';
     $erreur = null;
     if(isset($_GET['error'])) {
         $erreur = $_GET['error'];
     }
   
    ?>
</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Modifier un utlisateur</h3>
                                        <?php if(!empty($erreur)) { ?>
                                        <div class="isa_error">Utilisateur existe!</div>
                                        <?php } ?>
		    		</div>
    		
	    			<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
					  <div class="control-group">
					    <label class="control-label">Name</label>
					    <div class="controls">
					      	<input name="NAME" type="text" pattern="^[a-zA-Z \.\,\+\-]*$" placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
					      	<span>(Alphabétique)</span>
					    </div>
					  </div>
                                          <div class="control-group">
					    <label class="control-label">SurName</label>
					    <div class="controls">
					      	<input name="SURNAME" type="text"  placeholder="SurName" value="<?php echo !empty($surname)?$surname:'';?>">
					      	
					    </div>
					  </div>
                                          <div class="control-group">
					    <label class="control-label">CP</label>
					    <div class="controls">
					      	<input name="CP" type="text" pattern="[0-9]{5}" placeholder="CP" value="<?php echo !empty($cp)?$cp:'';?>">
					      	<span>(5 chiffres)</span>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Email</label>
					    <div class="controls">
					      	<input name="MAIL" type="text" placeholder="Email" value="<?php echo !empty($email)?$email:'';?>">
					      	
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Profession</label>
					    <div class="controls">
					      	<input name="PROFESSION" type="text"  placeholder="Profession" value="<?php echo !empty($profession)?$profession:'';?>">
					      	
					    </div>
					  </div>
                                          <div class="control-group">
					    <label class="control-label">Association</label>
					    <div class="controls">
					      	<input name="ASSOCIATION" id="association" type="text"  placeholder="Association" value="<?php echo !empty($assoc)?$assoc:'';?>">
					      	
					    </div>
					  </div>
                                          <div class="control-group">
					    <label class="control-label">Spécialité</label>
					    <div class="controls">
					      	<input name="SPECIALITE" id="specialite" type="text"  placeholder="Spécialité" value="<?php echo !empty($specialite)?$specialite:'';?>">
					      	
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Edit</button>
                                                  <a class="btn" href="./datatable.php">Retour</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>