<form method="POST" id="nouvelleCategorie">
<p>
<label for="newCategory">Nom de la nouvelle cat&eacute;gorie :</label>
<input type="text" name="newCategory" />
</p>
<p>
<input type="submit" value="Cr&eacute;er une nouvelle cat&eacute;gorie" />
</p>
</form>
<br><br><br>
<form method="POST" id="majCategorie">
<p>
<label for="oldCategory">Nom de la cat&eacute;gorie :</label>
<input type="text" name="ancienneCategorie" />
</p>
<p>
<label for="newCategory">Nom de la nouvelle cat&eacute;gorie :</label>
<input type="text" name="nouvelleCategorie" />
</p>
<p>
<input type="submit" value="Modifier la cat&eacute;gorie" />
</p>
</form>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script>
    $(document).ready( function () {
            $("#nouvelleCategorie").submit(function () {

                $.ajax({
                    type: "POST",
                    url: "Php/message.php",
                    data: "category="+$("#category option:selected").val()+"&theme="+$("#theme option:selected").val()+"&receiver1=" + $("#destinataire").val() + "&title=" + $("#sujet").val() + "&content=" + $("#message").val()+"&nbmessages="+$("#compteur").text(),
                    success: function (msg) {

                        if (msg == "0") {
                            alert("Le destinataire n'est pas inscrit.");
                            document.location.href = "./index.php?EX=searchMember";
                        }
                        else if (msg == "1") {
                            alert("Vous n'êtes pas connecté.");
                        }
                        else if (msg == "2") {
                            alert("Vous avez dépassé le nombre de messages autorisés par association.");
                            document.location.href = "./index.php";
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
</script>