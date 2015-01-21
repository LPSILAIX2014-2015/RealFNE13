<h1 align="center">Récuperation de mot de passe</h1><br>
<form role="form" class="form-vertical" id="formRMP">
	<div class="form-group" align="center">
    	<label for="mail" class="control-label">Adresse mail</label>
        <div class="controls">
            <?php global $eml; ?>
            <input type="email" id="mail" name="mail" class="form-control" placeholder="Tapez votre address mail" disabled="true" value='<?= $eml; ?>' readonly="readonly">
        </div>
    </div>
    <div class="form-group" align="center">
    	<label for="pass1" class="control-label">Nouveau mot de passe</label>
        <div class="controls">
            <input type="password" id="pass1" name="pass2" class="form-control" placeholder="Nouveau mot de passe" maxlength="30">
        </div>
    </div>
    <div class="form-group" align="center">
    	<label for="pass2" class="control-label">Confirmer votre nouveau mot de passe</label>
        <div class="controls">
            <input type="password" id="pass2" name="pass2" class="form-control" placeholder="Confirmer votre nouveau mot de passe" maxlength="30">
        </div>
    </div>
    <div class="form-group" align="center">
    	<label for="iCaptcha" class="control-label">Captcha</label><br>
    	<img class="center-block" src="Html/captcha.php" /><br>
        <div class="controls">
            <input type="text" id="iCaptcha" name="iCaptcha" class="form-control" placeholder="Tapez le code" maxlength="6">
        </div>
    </div>
    <input type="submit" name="btnConf" class="btn btn-default center-block">
</form>
<div id="result"></div><!-- id="error" -->
<div id="res"></div><!-- id="error" -->