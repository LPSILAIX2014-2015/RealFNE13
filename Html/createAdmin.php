<?php
	if(!isset($_SESSION['ROLE'])||($_SESSION['ROLE']!='SADMIN'))
		header('Location: ./index.php');
     $id = null;
 	function replace_accents($string){
        return str_replace( array('à','á','â','ã','ä', 'ç', 'è','é','ê','ë', 'ì','í','î','ï', 'ñ', 'ò','ó','ô','õ','ö', 'ù','ú','û','ü', 'ý','ÿ', 'À','Á','Â','Ã','Ä', 'Ç', 'È','É','Ê','Ë', 'Ì','Í','Î','Ï', 'Ñ', 'Ò','Ó','Ô','Õ','Ö', 'Ù','Ú','Û','Ü', 'Ý', '\''), array('a','a','a','a','a', 'c', 'e','e','e','e', 'i','i','i','i', 'n', 'o','o','o','o','o', 'u','u','u','u', 'y','y', 'A','A','A','A','A', 'C', 'E','E','E','E', 'I','I','I','I', 'N', 'O','O','O','O','O', 'U','U','U','U', 'Y', '_'), $string);
	}
    if ( isset($_POST['NAME'])) {
        $name = $_POST['NAME'];
        $territory = $_POST['TERRITORY'];
        $theme = $_POST['THEME'];
        $pathImage = "";

        $repertoireDestination = "Img/LogoAsso/";

        $nomOrigine = $_FILES["articleImage"]["name"];
        //On check s'il y à une image, s'il y en à une, on la traite
        if(strlen($nomOrigine) != 0){

            $elementsChemin = pathinfo($nomOrigine);
            $extensionFichier = $elementsChemin['extension'];
            $errorType ="";

            $extensionsAutorisees = array("jpeg", "jpg","png");
            $maxImageSize = $_POST["max_file_size"];

            $sanitizeFileName = replace_accents($_FILES["articleImage"]["name"]);

            $pathImage .= $repertoireDestination. $sanitizeFileName;

            //Check if the file is an image
            if (in_array($extensionFichier, $extensionsAutorisees)) {

                //Check if the size of the image is correct
                if($_FILES["articleImage"]["size"] < $maxImageSize){

                    //Check if the file is correctly moved
                    if (move_uploaded_file($_FILES["articleImage"]["tmp_name"],$pathImage)) {

                    }else{
                        echo "L'image n'a pas été bien placé à cause d'une erreur";
                    }

                }else{
                    echo "L'image n'a pas été inséré à cause de son importante taille";
                }

            } else{
                echo "L'image n'a pas été inséré car elle n'est pas du bon format";
            }
        }

        $pdo = new MDBase();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO ASSOCIATION (NAME, TERRITORY_ID,THEME_ID,IMAGEPATH) values(?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($name, $territory, $theme,$pathImage));
        $id= $pdo->lastInsertId();

    }
		else
				header("Location: ./index.php?EX=createAsso")
    ?>
    <div>

    			<div class="span10 offset1">
    				<div class="row">
		    			<h2>Création d'un administrateur</h2>
                                        <?php if(!empty($erreur)) { ?>
                                        <div class="isa_error">L'utilisateur existe !</div>
                                        <?php } ?>
		    		</div>

	    			<form class="form-horizontal" action="index.php?EX=creationAdmin" method="post">
	    			<input type="hidden" name="ID" value="<?php echo $id;?>"/>
					  <div class="control-group">
					    <label class="control-label"> Prénom</label>
					    <div class="controls">
					      	<input name="NAME" id="name" type="text" pattern="[^'\x22\;\.]+" placeholder="Prénom" value="" required>
					      	<span>(Alphabétique)</span>
					    </div>
					  </div>
                      <div class="control-group">
					    <label class="control-label"> Nom</label>
					    <div class="controls">
					      	<input name="SURNAME" id="surname" type="text"  pattern="[^'\x22\;\.]+" placeholder="Nom" value="" required>

					    </div>
					  </div>

                      <div class="control-group">
					    <label class="control-label">Email</label>
					    <div class="controls">
					      	<input name="MAIL" id="mail" type="text"  placeholder="EMAIL" value="" required>

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
