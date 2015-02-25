<?php
$pdo = new MDBase();
$email = $_GET['email'];
$i=0;
$themesList = $pdo ->getAllThemes();
foreach($themesList as $line){
    $themes[$i]['ID'] = $line['ID'];
    $themes[$i]['NAME'] = $line['NAME'];
    $i++;
}
?>
<div class="container">

    <div class="span10 offset1">
        <div class="row">
            <h3>Finalisation d'inscription</h3>
        </div>

        <form class="form-horizontal" id="createMemberForm" action="Php/update-mail.php?email='+'<?php echo $email?>" enctype="multipart/form-data" method="post">
            <div class="control-group">
                <label class="control-label">Identifiant (*)</label>
                <div class="controls">
                    <input name="LOGIN" type="text" rows="5" cols="40" placeholder="Identifiant" value="" required>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Mot de passe (*)</label>
                <div class="controls">
                    <input name="MOTDEPASSE" type="password" rows="5" cols="40" placeholder="Mot de passe" value="" required>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Confirmation mot de passe (*)</label>
                <div class="controls">
                    <input name="CONFIRMMOTDEPASSE" type="password" rows="5" cols="40" placeholder="Confirmation mot de passe" value="" required>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Adresse (*)</label>
                <div class="controls">
                    <input name="ADRESSE" type="text" rows="5" cols="40" placeholder="Adresse" value="" required>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Code postal (*)</label>
                <div class="controls">
                    <input name="CP" type="text" rows="5" cols="40" placeholder="Code postal" value="" required>
                </div>
            </div>

            <div class="control-group">

                <label for="themes1" class="col-sm-2 control-label">Th&eacute;matique d'expertise (*)</label>
                <div class="controls">
                    <select class="controls" name="THEME" type="text">
                        <?php
                        echo('<option></option>');
                        foreach ($themes as $key => $theme) {
                            echo('<option value ='.$theme['ID'].'>'.$theme['NAME'].'</option>');
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Sous th&eacute;matique</label>
                <div class="controls">
                    <input name="DETAILS" type="text" rows="5" cols="40" placeholder="Sous thématique" value="">
                    <span>(Pr&eacute;cision sur le th&egrave;me)</span>
                </div>
            </div>
            <div class="control-group">

                <label for="themes2" class="col-sm-2 control-label">Th&eacute;matique d'implication (*)</label>
                <div class="controls">
                    <select class="controls" name="THEME2" type="text">
                        <?php
                        echo('<option></option>');
                        foreach ($themes as $key => $theme) {
                            echo('<option value ='.$theme['ID'].'>'.$theme['NAME'].'</option>');
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Profession (*)</label>
                <div class="controls">
                    <input name="PROFESSION" type="text"  placeholder="Profession" value="" required>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Profession</label>
                <div class="controls">
                    <input name="PROFESSION2" type="text"  placeholder="Profession" value="">
                    <span>(Profession pass&eacute;e si actuellement retrait&eacute;)</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Pr&eacute;sentation</label>
                <div class="controls">
                    <textarea name="PRESENTATION" id="presentation" type="text" rows="10" cols="90" placeholder="Présentation" required></textarea>
                    <span>(Informations utiles)</span>
                </div>
            </div>
            <form class="form-horizontal" id="frmCHIMG" enctype="multipart/form-data" method="post">
                <div class="control-group">
                    <label class="control-label">Photo (*)</label>
                    <div class="controls">
                        <input type="file"  id="sel_img" name="PHOTO" class="form-control" required="required">
                    </div>
                </div>
                <div id="chI"></div><!-- id="error"--><br>
            </form>
            <div class="form-actions">
                <button type="submit" class="btn btn-success">Terminer son inscription</button>
            </div>
        </form>
    </div>

</div> <!-- /container -->
