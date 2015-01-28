<!-- <div class="infosperso">
    <div class="logo">LOGO</div>
    <div class="container-fluid">
        <div class="row">
            <form role="form" id="formconnec">
                <div class="col-sm-2"></div>
                <label for="login" class="col-sm-1 control-label">Login : </label>
                <div class="col-sm-2">
                    <input type="email" id="login" name="login" class="form-control input-sm" placeholder="Tapez votre address mail" maxlength="100">
                </div>
                <label for="password" class="col-sm-2 control-label">Mot de passe : </label>
                <div class="col-sm-2">
                    <input type="password" id="password" name="password" class="form-control input-sm" placeholder="Mot de passe" maxlength="30">
                </div>
                <div class="col-sm-1">
                    <input type="submit" name="loginbutton" class="btn btn-success" value="OK">
                </div>
            </form>
            <a href="index.php?EX=recup" class="lostpass">Mot de passe perdu ?</a>
        </div>
    </div>
</div> -->
<div class="infosperso">
    <form method="post" id="formconnec">
        Connexion :
        <label>Login : </label>
        <input type="text" name="login" id="login"/>
        <label>Mot de passe:</label>
        <input type="password" name="password" id="password">
        <input type="submit" value="OK" id="loginbutton"><br/>
        <a href="index.php?EX=recup" class="lostpass">Mot de passe perdu ?</a>
    </form>
</div>
