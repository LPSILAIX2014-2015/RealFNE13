<?php 
$id = 1;
$emails = null;
if(isset($_GET['id'])) {
    $id = $_GET['id'];
}
 if(isset($_GET['option1'])) {
    $emails = $_GET['option1'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
     include './header.php';
    ?>
</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Envoi Email</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="../Php/email.php" method="post">
					 
                                          <div class="control-group">
                                             <label class="control-label">De</label>
                                            <div class="controls">
                                                <input type="text" name="sender" pattern="^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$"></textarea>
					    </div>
                                             <br>
					    <label class="control-label">Title</label>
					    <div class="controls">
                                                <input name="id" id="" type="hidden"  placeholder="" value=<?php echo "".$id ?> >
					      	<input name="emailto" id="" type="hidden"  placeholder="" value=<?php echo "".$emails ?>>
					      	<input name="title" id="" type="text"  placeholder="Title" value="">
					    </div>
                                            <br>
                                            <label class="control-label">Message</label>
                                            <div class="controls">
                                                <textarea name="content"></textarea>
					    </div>
					   <div class="form-actions">
						  <button type="submit" class="btn btn-success">Envoyer</button>
                                                  <a href="./data.php"><button type="button" class="btn">Retour</button></a>
						  
                                            </div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>
