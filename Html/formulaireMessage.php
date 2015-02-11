<form method="POST" id="formulaire" name="MAIL" action="">
    <fieldset>

        <p><label for="count">Messages envoyés :</label><br><br>
            <p id="compteur"></p>
        </p><br><br>

        <p>
            <label for="category">Catégorie :</label><br><br>
                <p id="list_categories"></p><br><br>
        </p>

        <p>
            <label for="receiver">Destinataire :</label><br><br>
            <input type="text" id="destinataire" name="RECEIVER" size="30" maxlength="50" required="required"/><br><br>
        </p>

        <p>
            <label for="subject">Sujet :</label><br><br>
            <input type="text" id="sujet" name="TITLE" size="30" maxlength="50"required="required"/><br><br>
        </p>

        <p>
            <label for="theme">Thématique :</label><br><br>
            <select id="theme">
                <option value="1">Transports</option>
                <option value="2">Mission Juridique</option>
                <option value="3">Climat, Air, Energie</option>
                <option value="4">Santé Environnement</option>
                <option value="5">Aménagement durable du territoire</option>
                <option value="6">Industrie</option>
                <option value="7">Eau et milieux naturels</option>
                <option value="8">Agriculture</option>
            </select><br><br>
        </p>

        <p>
            <label for="message">Message :</label><br><br>
            <textarea id="message" style="resize: none;" name="CONTENT" rows="10" cols="45" required="required"></textarea><br><br>
        </p>

        <p>
            <input type="submit" value="Ok"/>
        </p>
    </fieldset>
</form>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script>
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
                            document.location.href = "./index.php?EX=endMessages";
                        }
                    }
                });
                return false;
            });
        }
    );
</script>