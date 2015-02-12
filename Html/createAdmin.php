<?php
	if(!isset($_SESSION['ROLE'])||($_SESSION['ROLE']!='SADMIN'))
		header('Location: ./index.php');
     $id = null;
    if ( isset($_POST['NAME'])) {
        $name = $_POST['NAME'];
        $territory = $_POST['TERRITORY'];
        $theme = $_POST['THEME'];
        $pdo = new MDBase();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO ASSOCIATION (NAME, TERRITORY_ID,THEME_ID) values(?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($name, $territory, $theme));
        $id= $pdo->lastInsertId();
        header("./index.php?EX=creationAdmin&id=".$id);
    }
    ?>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h2>Création d'un administrateur</h2>
                                        <?php if(!empty($erreur)) { ?>
                                        <div class="isa_error">Utilisateur existe!</div>
                                        <?php } ?>
		    		</div>

	    			<form class="form-horizontal" action="index.php?EX=creationAdmin" method="post">
	    			<input type="hidden" name="ID" value="<?php echo $id;?>"/>
					  <div class="control-group">
					    <label class="control-label">Name</label>
					    <div class="controls">
					      	<input name="NAME" id="name" type="text" pattern="^[a-zA-Z \.\,\+\-]*$" placeholder="Name" value="">
					      	<span>(Alphabétique)</span>
					    </div>
					  </div>
                      <div class="control-group">
					    <label class="control-label">SurName</label>
					    <div class="controls">
					      	<input name="SURNAME" id="surname" type="text"  placeholder="SurName" value="">
					      	
					    </div>
					  </div>

                      <div class="control-group">
					    <label class="control-label">Email</label>
					    <div class="controls">
					      	<input name="MAIL" id="mail" type="text"  placeholder="EMAIL" value="">
					      	
					    </div>
					  </div>				  
					 
                                          
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Création</button>
                          <a href="./index.php?EX=manageMembers"><button type="button" class="btn">Retour</button></a>
                      </div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>