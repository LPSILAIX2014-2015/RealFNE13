<form method="POST" id="formulaire" name="MAIL" action="">
    <fieldset>

        <p><label for="count">Messages envoyés :</label>
            <p id="compteur"></p>
        </p>

		<p>
            <label for="receiver">Destinataire :</label>
			<?php
			//Il faut qu'en utilisant la recherche de membre, en cliquant sur "envoyer un message à un membre", le pseudo du membre soit transmis au formulaire et écrit automatiquement dans "Destinataire"
			if (isset($_GET['dest']))
			{
				echo "<input type='text' id='destinataire' name='RECEIVER' size='30' value=".$_GET['dest']." length='50' required='required'/>";
			}
			else
			{
				echo "<input type='text' id='destinataire' name='RECEIVER' size='30' maxlength='50' required='required'/>";
			}
			?>
			<a href="index.php?EX=searchMember"><input type="button" value="Rechercher un membre" /></a>
		</p>
		
        <p>
            <label for="category">Catégorie :</label>
                <p id="list_categories"></p>
        </p>

        <p>
            <label for="subject">Sujet :</label>
			<?php
			if (isset($_SESSION['title']))
			{
				$titre = htmlspecialchars($_SESSION['title'],ENT_QUOTES);
				echo "<input type='text' id='sujet' name='TITLE' size='30' value='".$titre."' maxlength='300' required='required'/><br><br>";
			}
			else
			{
				echo "<input type='text' id='sujet' name='TITLE' size='30' maxlength='300' required='required'/>";
			}
			?>
        </p>

        <p>
            <label for="theme">Thématique :</label>
                <p id="list_themes"></p><br><br>
        </p>

        <p>
            <label for="message">Message :</label>
			<?php
			if (isset($_SESSION['content']))
			{
				echo '<textarea id="message" style="resize: none;" name="CONTENT" rows="10" cols="45" required="required">'.$_SESSION["content"].'</textarea><br><br>';
			}
			else
			{
				echo '<textarea id="message" style="resize: none;" name="CONTENT" rows="10" cols="45" required=required"></textarea>';
			} ?>
        </p>

        <p>
            <input type="submit" value="Ok"/><a href="Php/resetForm.php"><input type="button" value="Effacer" /></a>
        </p>
    </fieldset>
</form>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script>
    $.ajax({
        type: "POST",
        url: "Php/listThemes.php",
        success: function(msg){
            $("#list_themes").html(msg);
        }
    })

    $.ajax({
        type: "POST",
        url: "Php/listCategories.php",
        success: function(msg){
            $("#list_categories").html(msg);
        }
    })

    $.ajax({
        type: "POST",
        url: "Php/nbMessages.php",
        success: function(msg){
            $("#compteur").text(msg);
        }
    })

    $(document).ready( function () {
            $("#formulaire").submit(function () {

                $.ajax({
                    type: "POST",
                    url: "Php/message.php",
                    data: "category="+$("#category option:selected").val()+"&theme="+$("#theme option:selected").val()+"&receiver1=" + $("#destinataire").val() + "&title=" + $("#sujet").val() + "&content=" + $("#message").val()+"&nbmessages="+$("#compteur").text(),
                    success: function (msg) {

                        if (msg == "0") {
                            alert("Le destinataire n'est pas inscrit.");
                            document.location.href = "./index.php?EX=searchMember";
                        }
                        else if (msg == "2") {
                            alert("Vous avez dépassé le nombre de messages autorisés par association.");
                            document.location.href = "./index.php";
                        }
						else if (msg == "4") {
							alert("Vous n'avez pas sélectionné de thème.");
						}
						else if (msg == "5") {
							alert("Vous n'avez pas sélectionné de catégorie.");
						}
						else
                        {
                            alert("Le message a été envoyé.");
                            document.location.href = "./index.php?EX=sendMessage";
                        }
                    }
                });
                return false;
            });
        }
    );
	
</script>