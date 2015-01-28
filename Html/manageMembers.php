
<script type="text/javascript">
    $(document).ready(function(){
        var name = new Array();
        var surname = new Array();
        var cp = new Array();
        var profession = new Array();
        $.ajax({
            type: 'POST',
            url: './Php/autocomplete.php',
            dataType: 'json',
            data: {'categories': 'tmp'},
            success: function(data) {

                var jss = jQuery.parseJSON(data);

                jss.forEach(function(entry) {

                    name.push(entry['LOGIN']);
                    surname.push(entry['SURNAME']);
                    cp.push(entry['CP']);
                    // profession.push(entry['PROFESSION']);
                });

                $( "#name" ).autocomplete({
                    source: name
                });
                $( "#surname" ).autocomplete({
                    source: surname
                });
                $( "#cp" ).autocomplete({
                    source: cp
                });
            }
        });



        $('#btn1').click(function (){
            var selected = [];
            $(' input:checked').each(function() {
                selected.push($(this).attr('value'));
            });
            document.location.href="./Html/email.php?option1="+selected;

        });
        $('a.popin').click(function (){
            $('a.popin').fancybox();
            var image = $(this).next().children().children().children().val();
            $(this).next().children().children().remove('.photo-inner img');
            var html = $(this).next().children().children().children();
            if(!html.hasClass('photo-inner')) {

                $(this).next().children().children().first().append('<div class="photo-inner"><img src="'+image+'" height="186" width="153"></div>');
            }
        });
    });

</script>

<?php
    $i=0;
    $pdo = new MDBase();
    $assocsList = $pdo -> getAllAssocs();
    foreach($assocsList as $line){
        $assocs[$i]['ID']=$line['ID'];
        $assocs[$i]['NAME']=$line['NAME'];
        $i++;
    }
    $i=0;
    $territoriesList = $pdo -> getAllTerritories();
    foreach($territoriesList as $line){
        $territories[$i]['ID']=$line['ID'];
        $territories[$i]['NAME']=$line['NAME'];
        $i++;
    }
    $i=0;
    $themesList = $pdo -> getAllThemes();
    foreach($themesList as $line){
        $themes[$i]['ID']=$line['ID'];
        $themes[$i]['NAME']=$line['NAME'];
        $i++;
    }
    /*$i=0;
    $rolesList = $pdo -> getAllRoles();
    foreach($rolesList as $line){
        $roles[$i]['ID']=$line['ID'];
        $roles[$i]['NAME']=$line['NAME'];
        $i++;
    }*/ //Mettre une fonction pour récupérer les roles des membres
?>

<div class="container">
    <div class="row">
        <h3>FNESITE</h3>
    </div>


    <form class="form-horizontal" action="./index.php?EX=manageMembers" method="post">
        <div class="control-group">
            <label class="control-label">Nom de famille</label>
            <div class="controls">
                <input name="SURNAME" id="surname" type="text"  placeholder="Nom de famille" pattern="^[a-zA-Z \.\,\+\-]*$" value="">
                <span>(Alphabétique)</span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Pr&eacute;nom</label>
            <div class="controls">
                <input name="NAME" id="name" type="text"  placeholder="Prenom" value="">

            </div>
        </div>
        <!--<div class="control-group">
            <label class="control-label">R&ocirc;le</label>
            </br>
            <select class="controls" name="ROLE" type="text">
                    <?php 
                        /*foreach ($roles as $key => $role) {
                            echo('<option value ='.$role['ID'].'>'.$role['NAME'].'</option>');
                        }*/
                    ?>
            </select>
        </div>--> <!-- Il manque la fonction nécessaire pour trier par roles -->
        <div class="control-group">
            <label class="control-label">Code postal</label>
            <div class="controls">
                <input name="CP" type="text" id="cp"  placeholder="Code postal" pattern="[0-9]{5}"  value="">
                <span>(5 chiffres)</span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Profession</label>
            <div class="controls">
                <input name="PROFESSION" id="profession" type="text"  placeholder="Profession" value="">

            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Association</label>
            </br>
            <select class="controls" name="ASSOCIATION" type="text">
                    <?php 
                        echo('<option></option>');
                        foreach ($assocs as $key => $asso) {
                            echo('<option value ='.$asso['ID'].'>'.$asso['NAME'].'</option>');
                        }
                    ?>
            </select>
        </div>
        <div class="control-group">
            <label class="control-label">Th&egrave;me</label>
            </br>
            <select class="controls" name="THEME" type="text">
                    <?php 
                        echo('<option></option>');
                        foreach ($themes as $key => $theme) {
                            echo('<option value ='.$theme['ID'].'>'.$theme['NAME'].'</option>');
                        }
                    ?>
            </select>
        </div>
        <div class="form-actions">
            </br>
            </br>
            <button type="submit" class="btn btn-success">Rechercher</button>
            <a href="./index.php?EX=createMember"><button type="button" class="btn">Création</button></a>

        </div>

    </form>

    <div class="row">


        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Nom de famille</th>
                <th>Pr&eacute;nom</th>
                <th>CP</th>
                <th>Profession</th>
                <th>Action
                    <label id="btn1" class="btn">envoyer</label>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php
            if ( isset($_POST['NAME'])) {
                $nom = $_POST['NAME'];
                $conditions = array();
                $params = array();
                if($nom) {
                    $conditions[] = "NAME = '". $nom. "'";
                    $params[]= $nom;
                }
                if($_POST['SURNAME']) {
                    $conditions[] = "SURNAME = '". $_POST['SURNAME']. "'";
                    $params[] = $_POST['SURNAME'];
                }
                if($_POST['CP']) {
                    $conditions[] = "CP = '". $_POST['CP']. "'";
                    $params[] = $_POST['CP'];
                }
                if($_POST['PROFESSION']) {
                    $conditions[] = "PROFESSION = '". $_POST['PROFESSION']. "'";
                    $params[] = $_POST['PROFESSION'];
                }
                if($_POST['ASSOCIATION']) {
                    $conditions[] = "ASSOCIATION_ID = '". $_POST['ASSOCIATION']. "'";
                    $params[] = $_POST['ASSOCIATION'];
                }
                if($_POST['THEME']) {
                    $conditions[] = "THEME_ID = '". $_POST['THEME']. "' OR THEME_INTEREST_ID = '". $_POST['THEME']. "'";
                    $params[] = $_POST['THEME'];
                }
                $where = " WHERE ".implode($conditions,' AND ');
                $surnom = $_POST['SURNAME'];
                if(count($conditions) > 0) {
                    $sql = 'SELECT * FROM user'. $where;
                }else {
                    $sql = 'SELECT * FROM user order by NAME ASC';
                }

                foreach ($pdo->query($sql) as $row) {
                    $img = null;
                    if($row['PHOTOPATH']) {
                        $img = $row['PHOTOPATH'];
                    }
                    echo '<tr>';
                    echo '<td>'. $row['NAME'] . '</td>';
                    echo '<td>'. $row['SURNAME'] . '</td>';
                    echo '<td>'. $row['CP'] . '</td>';
                    echo '<td>'. $row['PROFESSION'] . '</td>';
                    echo '<td width=250>';
                    echo '<a class="btn popin" id="popin-'.$row['ID'] .'" href="#popin-data'.$row['ID'] .'">Image</a>';
                    echo '<div id="popin-data'.$row['ID'] .'" style="display: none;">
            
            <div class="active" style="display: block;"> 
                    <!-- About section -->
                    <div class="about">
                        <input type="hidden" value="'.$img.'">
                    </div>
                    <!-- /About section -->
                     
                    <!-- Personal info section -->
                    <ul class="personal-info">
            <li><label>Name</label><span>'.$row['NAME'].'</span></li>
                        <li><label>SurName</label><span>'.$row['SURNAME'].'</span></li>
                        <li><label>Adresse</label><span>'.$row['ADRESS'].'</span></li>
                        <li><label>CP</label><span>'.$row['CP'].'</span></li>
                        <li><label>Email</label><span>'.$row['MAIL'].'</span></li>
                            <li><label>Association</label><span>'.(new MAssoc($row['ASSOCIATION_ID']))->getName().'</span></li>
                        <li><label>Thème</label><span>'.(new MTheme($row['THEME_ID']))->getName().'</span></li>
                        <li><label>Thème Interest</label><span>'.(new MTheme($row['THEME_INTEREST_ID']))->getName().'</span></li>
                        <li><label>Profession</label><span>'.$row['PROFESSION'].'<br> '.$row['PROFESSION2'].'</span></li>
                        
                    </ul>
                    <!-- /Personal info section -->
                </div>
            
        </div>';
                    echo '&nbsp;';
                    echo '<a class="btn btn-success" href="index.php?EX=updateMember&id='.$row['ID'].'">Edit</a>';
                    echo '&nbsp;';
                    echo '<a class="btn btn-danger" href="index.php?EX=deleteMember&id='.$row['ID'].'">Supprimer</a>';
                    echo '</td>';
                    echo '</tr>';
                }
            }else {

                $sql = 'SELECT * FROM user order by NAME ASC';
                if(count($sql) > 0) {

                    foreach ($pdo->query($sql) as $row) {
                        $img = null;
                        if($row['PHOTOPATH']) {
                            $img = $row['PHOTOPATH'];
                        }
                        echo '<tr>';
                        echo '<td>'. $row['NAME'] . '</td>';
                        echo '<td>'. $row['SURNAME'] . '</td>';
                        echo '<td>'. $row['CP'] . '</td>';
                        echo '<td>'. $row['PROFESSION'] . '</td>';
                        echo '<td width=250>';
                        echo '<a class="btn popin" id="popin-'.$row['ID'] .'" href="#popin-data'.$row['ID'] .'">Image</a>';
                        echo '<div id="popin-data'.$row['ID'] .'" style="display: none;">
            
            <div id="profile" class="active" style="display: block;"> 
                    <!-- About section -->
                    <div class="about">
                        <input type="hidden" value="'.$img.'">
                    </div>
                    <!-- /About section -->
                     
                    <!-- Personal info section -->
                    <ul class="personal-info">
            <li><label>Name</label><span>'.$row['NAME'].'</span></li>
                        <li><label>SurName</label><span>'.$row['SURNAME'].'</span></li>
                        <li><label>Adresse</label><span>'.$row['ADRESS'].'</span></li>
                        <li><label>CP</label><span>'.$row['CP'].'</span></li>
                        <li><label>Email</label><span>'.$row['MAIL'].'</span></li>
                            <li><label>Association</label><span>'.(new MAssoc($row['ASSOCIATION_ID']))->getName().'</span></li>
                        <li><label>Thème</label><span>'.(new MTheme($row['THEME_ID']))->getName().'</span></li>
                        <li><label>Thème Interest</label><span>'.(new MTheme($row['THEME_INTEREST_ID']))->getName().'</span></li>
                        <li><label>Profession</label><span>'.$row['PROFESSION'].'<br> '.$row['PROFESSION2'].'</span></li>
                        
                    </ul>
                    <!-- /Personal info section -->
                </div>
            
        </div>';
                        echo '&nbsp;';
                        echo '<a class="btn btn-success" href="index.php?EX=updateMember&id='.$row['ID'].'">Edit</a>';
                        echo '&nbsp;';
                        echo '<a class="btn btn-danger" href="index.php?EX=deleteMember&id='.$row['ID'].'">Supprimer</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div> <!-- /container -->
