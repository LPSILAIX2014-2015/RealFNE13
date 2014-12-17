    <?php
     $erreur = null;
     if(isset($_GET['error'])) {
         $erreur = $_GET['error'];
     }
    ?>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h2>Création d'un utilisateur</h2>
                                        <?php if(!empty($erreur)) { ?>
                                        <div class="isa_error">Utilisateur existe!</div>
                                        <?php } ?>
		    		</div>
    		
	    			<form class="form-horizontal" action="./Php/create.php" method="post">
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
					    <label class="control-label">Profession</label>
					    <div class="controls">
					      	<input name="PROFESSION" id="profession" type="text"  placeholder="Profession" value="">
					      	
					    </div>
					  </div>

                                          <div class="control-group">
					    <label class="control-label">Email</label>
					    <div class="controls">
					      	<input name="MAIL" id="mail" type="text"  placeholder="EMAIL" value="">
					      	
					    </div>
					  </div>
                                          <div class="control-group">
					    <label class="control-label">cp - code postale</label>
					    <div class="controls">
					      	<input name="CP" type="text" id="cp" pattern="[0-9]{5}" placeholder="cp - code postale" value="">
					      	<span>(5 chiffres)</span>
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