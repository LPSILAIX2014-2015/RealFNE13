<!-- TODO: Réparer autocompletion
-->
<?php
global $user;
if(!(isset($_SESSION['ROLE']))){
    header("Location: ../index.php");
}
?>
<script type="text/javascript">
    function cleanArray(array) {
      var i, j, len = array.length, out = [], obj = {};
      for (i = 0; i < len; i++) {
        obj[array[i]] = 0;
    }
    for (j in obj) {
        out.push(j);
    }
    return out;
}

$(document).ready(function(){
    var name = new Array();
    var surname = new Array();
    var cp = new Array();
    var association = new Array();
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: './Php/autocomplete.php',
        data: {'categories': 'tmp'},

        success: function(data) {
            data.forEach(function(entry) {

                name.push(entry['NAME']);
                surname.push(entry['SURNAME']);
                cp.push(entry['CP']);
                association.push(entry['ASSOCIATION']);
            });
            var nameA = cleanArray(name);
            $( "#name" ).autocomplete({
                source: nameA
            });
            var surnameA = cleanArray(surname);
            $( "#surname" ).autocomplete({
                source: surnameA
            });
            var cpA = cleanArray(cp);
            $( "#cp" ).autocomplete({
                source: cpA
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
    ?>

    <div class="container">
        <div class="row">
            <h3>FNESITE</h3>
        </div>
    <form class="form-horizontal" action="./index.php?EX=searchMember" method="post">
        <div class="control-group">
            <label class="control-label">Nom de famille</label>
            <div class="controls">
                <input name="SURNAME" id="surname" type="text"  placeholder="Nom de famille" pattern="[^'\x22\;\.]+" value="">
                <span>(Alphabétique)</span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Pr&eacute;nom</label>
            <div class="controls">
                <input name="NAME" id="name" type="text"  placeholder="Prenom" pattern="[^'\x22\;\.]+" value="">
                </div>
            </div>
        <div class="control-group">
            <label class="control-label">R&ocirc;le</label>
            </br>
            <select class="controls" name="ROLE" type="text">
                <option></option>
                <option value ='MEMBRE'>Membre</option>
                <option value ='VALIDATOR'>Mod&eacute;rateur</option>
                <option value ='ADMIN'>Administrateur</option>
            </select>
        </div>
        <div class="control-group">
            <label class="control-label">Code postal</label>
            <div class="controls">
                <input name="CP" type="text" id="cp"  placeholder="Code postal"  pattern="[0-9]{1,5}"  value="">
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

</div>

</form>

<div class="row">


    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Association</th>
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
                    $conditions[] = "NAME LIKE '%". $nom. "%'";
                    $params[]= $nom;
                }
                if($_POST['SURNAME']) {
                    $conditions[] = "SURNAME LIKE '%". $_POST['SURNAME']. "%'";
                    $params[] = $_POST['SURNAME'];
                }
                if($_POST['ROLE']) {
                    $conditions[] = "ROLE = '". $_POST['ROLE'] . "'";
                    $params[] = $_POST['ROLE'];
                }
                if($_POST['CP']) {
                    $conditions[] = "CP LIKE '". $_POST['CP']. "%'";
                    $params[] = $_POST['CP'];
                }
                if($_POST['PROFESSION']) {
                    $conditions[] = "PROFESSION LIKE '%". $_POST['PROFESSION']. "%'";
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
                    $sql = 'SELECT * FROM USER'. $where;
                }else {
                    $sql = 'SELECT * FROM USER order by NAME ASC';
                }

                foreach ($pdo->query($sql) as $row) {
                    $img = null;
                    if($row['PHOTOPATH']) {
                        $img = $row['PHOTOPATH'];
                    }
                    echo '<tr>';
                    echo '<td>'. $row['NAME'] . ' '.$row['SURNAME'].'</td>';
                    echo '<td>'.(new MAssoc($row['ASSOCIATION_ID']))->getName(). '</td>';
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
                echo '<a class="btn" href="email.php?id='.$row['ID'].'">Email</a>';
                echo '&nbsp;';
                echo '<input type="checkbox" name="option1[]" value='.$row['MAIL'].'>';
                echo '</td>';
                echo '</tr>';
            }
        }else {

            $sql2 = 'SELECT COUNT(*) FROM USER order by NAME ASC';
            $sql = 'SELECT * FROM USER order by NAME ASC';

            $val = $pdo->prepare($sql2);
            $val->execute();
            $res= $val->fetch();
            if($res[0] > 0) {

                foreach ($pdo->query($sql) as $row) {
                    $img = null;
                    if($row['PHOTOPATH']) {
                        $img = $row['PHOTOPATH'];
                    }
                    echo '<tr>';
                    echo '<td>'. $row['NAME'] . ' '.$row['SURNAME'].'</td>';
                    echo '<td>'. (new MAssoc($row['ASSOCIATION_ID']))->getName(). '</td>';
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
                       /* echo '&nbsp;';
                        echo '<a class="btn" href="email.php?id='.$row['ID'].'">Email</a>';
                        echo '&nbsp;';
                        echo '<input type="checkbox" name="option1[]" value='.$row['MAIL'].'>';*/

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
