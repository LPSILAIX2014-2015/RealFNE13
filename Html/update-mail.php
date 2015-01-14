<?php
     $pdo = new MDBase();
     $email = $_GET['email'];
?>
    <div class="container">
    
    			<div class="span10 offset1">
                    <div class="row">
                        <h3>Modifier un utlisateur</h3>

                    </div>

                    <form class="form-horizontal" enctype="multipart/form-data" action="../Php/update-mail.php?email=<?php echo $email?>" method="post">

                                      <div class="control-group">
                                        <label for="themes1" class="col-sm-2 control-label">Thématique d'expertise (*)</label>

                                <div class="controls">
                                        <?php
                                            $themes = $pdo->getAllThemes();
                                            foreach ($themes as $theme) {
                                                echo '<label><input type="radio" required="required" name="THEME" value='.$theme['ID'].'>'. utf8_encode($theme['NAME']) .'</label>';
                                                ?>
                                            
                                            <?php
                                            }
                                            ?>
                                        
                                    </div>
                                        </div>
                                          <div class="control-group">
					    <label class="control-label">Sous thématique</label>
					    <div class="controls">
					      	<input name="DETAILS" type="text" rows="5" cols="40" placeholder="Sous thématique" value="">
					      	
					    </div>
					  </div>
                                          <div class="control-group">
                                            <label for="themes1" class="col-sm-2 control-label">Thématique d'implication (*)</label>
                                        
                                    <div class="controls">
                                        <?php
                                            $themes = $pdo->getAllThemes();
                                            foreach ($themes as $theme) {
                                                echo '<label><input type="radio" name="THEME_INTEREST" required="required" value='.$theme['ID'].'>'. utf8_encode($theme['NAME']) .'</label>';
                                                ?>
                                            
                                            <?php
                                            }
                                            ?>
                                        
                                    </div>
                                        </div>
                                          <div class="control-group">
					    <label class="control-label">Profession</label>
					    <div class="controls">
					      	<input name="PROFESSION" type="text"  placeholder="Profession" value="">
					      	
					    </div>
					  </div>
                                          <div class="control-group">
					    <label class="control-label">Profession2</label>
					    <div class="controls">
					      	<input name="PROFESSION2" type="text"  placeholder="Profession" value="">
					      	
					    </div>
					  </div>
                                          <div class="control-group">
					    <label class="control-label">Présentation</label>
					    <div class="controls">
					      	<textarea name="PRESENTATION" id="presentation" type="text" rows="10" cols="90" placeholder="Présentation"></textarea>
					    </div>
					  </div>
                                          <div class="control-group">
					    <label class="control-label">Photo (*)</label>
					    <div class="controls">
					      	<input type="file"  name="photo" class="form-control" required="required">
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Edit</button>
                                                  <a class="btn" href="./datatable.php">Retour</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->