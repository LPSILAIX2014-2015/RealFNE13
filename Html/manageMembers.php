<?php
if(!(isset($_SESSION['ROLE'])) || (($_SESSION['ROLE'] == 'MEMBRE')||($_SESSION['ROLE'] == 'VALIDATOR'))){
    header("Location: ./index.php");
}
else if($_SESSION['ROLE']=='ADMIN'){
    $assoc=(new MUser($_SESSION['ID_USER']))->getAssociation();
}
$nbLines=10;
if(isset($_POST['LINES']))
  $nbLines=$_POST['LINES'];
$nbPage=1;
if(isset($_GET['PAGE']))
  $nbPage=$_GET['PAGE'];
$offset= ($nbPage-1)*$nbLines;
?>

<script src="Js/jquery.bpopup.min.js"></script>
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

        var i = 0;


/*
        $('html').click(function() {
            if(i == 1){
                console.log(i);
                var e=$.Event('keydown');
                e.which=27;
                $('body').trigger(e);
                $('a.popin').click(function(event){
                    event.stopPropagation();
                });
            }
        });
*/
$('a.fenprof').click(function (){
    //$('a.fenprof').fancybox();
    var ids = $(this).attr('href');
    console.log(ids);
    $(''+ids).bPopup({
        easing: 'easeOutBack', //uses jQuery easing plugin
        speed: 450,
        transition: 'slideDown',
        modalColor: 'white'
    });
    var image = $(this).next().children().children().children().val();
    var html = $(this).next().children().children().children();
    //if(!html.hasClass('photo-inner')) {

       // $(this).next().children().children().first().append('<div class="photo-inner"><img src="'+image+'" height="186" width="153"></div>');
   // }
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

<div class="">
<div class="row">
    <h3>Gestion des membres</h3>
</div>


<form class="form-horizontal" action="./index.php?EX=manageMembers" id="manageMember" method="post">
    <div class="control-group">
        <label class="control-label">Nom de famille</label>
        <div class="controls">
            <input name="SURNAME" id="surname" type="text"  placeholder="Nom de famille" pattern="^[a-zA-Z \.\,\+\-]*$" value="<?php echo (!isset($_POST['SURNAME']))?'' :$_POST['SURNAME'] ; ?>">
            <span>(Alphabétique)</span>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Pr&eacute;nom</label>
        <div class="controls">
            <input name="NAME" id="name" type="text"  placeholder="Prenom" value="<?php echo (!isset($_POST['NAME']))?'' :$_POST['NAME'] ; ?>">

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
            <input name="CP" type="text" id="cp"  placeholder="Code postal" pattern="\d+"  value="<?php echo (!isset($_POST['CP']))?'' :$_POST['CP'] ; ?>">
            <span>(5 chiffres)</span>
        </div>
    </div>
    <?php if(!isset($assoc)){
    ?>
    <div class="control-group">
        <label class="control-label">Association</label>
        </br>
        <select class="controls" name="ASSOCIATION" type="text">;
          echo('<option></option>');
          <?php
          foreach ($assocsList as $key => $association) {

            if((isset($_POST['ASSOCIATION']))&&($_POST['ASSOCIATION']==$association['ID']))
                echo('<option value ='.$association['ID'].' selected>'.$association['NAME'].'</option>');
            else
              echo('<option value ='.$association['ID'].'>'.$association['NAME'].'</option>');

          }
          ?>
        </select>
    </div>
    <?php } ?>
    <div class="control-group">
        <label class="control-label">Th&egrave;me</label>
        </br>
        <select class="controls" name="THEME" type="text">
          <?php
              echo('<option></option>');
              foreach ($themes as $key => $theme) {
                if((isset($_POST['THEME']))&&($_POST['THEME']==$theme['ID']))
                  echo('<option value ='.$theme['ID'].' selected>'.$theme['NAME'].'</option>');
                else
                  echo('<option value ='.$theme['ID'].'>'.$theme['NAME'].'</option>');
              }
          ?>
        </select>
    </div>
    <div class="control-group">
        <label class="control-label">Nombre de résultats à afficher</label>
        <div class="controls">
            <select class="controls" name="LINES" type="text">
                  <option value ='5' <?php if($nbLines == '5'){echo("selected");}?>>5</option>
                  <option value ='10'<?php if($nbLines == '10'){echo("selected");}?>>10</option>
                  <option value ='20'<?php if($nbLines == '20'){echo("selected");}?>>20</option>
                  <option value ='30'<?php if($nbLines == '30'){echo("selected");}?>>30</option>
                  <option value ='50'<?php if($nbLines == '50'){echo("selected");}?>>50</option>
            </select>

        </div>
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
            <th>Nom</th>
            <th>Thème</th>
            <th>Profession</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $dataCSV = array();
        $i=0;
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
            if($_POST['CP']) {
                $conditions[] = "CP LIKE '". $_POST['CP']. "%'";
                $params[] = $_POST['CP'];
            }
            if(isset($assoc)) {
                $conditions[] = "ASSOCIATION_ID = '". $assoc. "'";
                $params[] = $assoc;
            }
            else if($_POST['ASSOCIATION']) {
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
              foreach ($pdo->query('SELECT Count(*) As NUM FROM USER'. $where.' order by NAME ASC LIMIT '.$nbLines.' OFFSET '.$offset) as $row) {
                $rowNumber= $row['NUM'];
              }
              $sql = 'SELECT * FROM USER'. $where .' LIMIT '.$nbLines.' OFFSET '.$offset;
            }else {
              foreach ($pdo->query('SELECT Count(*) As NUM FROM USER') as $row) {
                $rowNumber= $row['NUM'];
              }
                $sql = 'SELECT * FROM USER order by NAME ASC LIMIT '.$nbLines.' OFFSET '.$offset;
            }

            foreach ($pdo->query($sql) as $row) {
                array_push($dataCSV, $row);
                $img = null;
                if($row['PHOTOPATH']) {
                    $img = $row['PHOTOPATH'];
                }
                echo ($i%2==0)?'<tr class="tr-even">':'<tr>';;
                echo '<td>'. $row['NAME'] . ' '.$row['SURNAME'].'</td>';
                echo '<td>'. (new MTheme($row['THEME_ID']))->getName() . '</td>';
                echo '<td>'. $row['PROFESSION'] . '</td>';
                echo '<td>';
                echo '<a class="btn fenprof" id="popin-'.$row['ID'] .'" href="#popin-data'.$row['ID'] .'">Profil</a>';
                echo '<div id="popin-data'.$row['ID'] .'"  style="left: 424.5px; position: absolute; top: 807.5px; z-index: 9999; opacity: 1; display: none;">

            <div class="active" style="display: block;">
                    <!-- About section -->
                    <div class="about">
                        <input type="hidden" value="'.$img.'">
                    </div>
                    <!-- /About section -->

                    <!-- Personal info section -->
                    <ul class="personal-info">
            <li><label>Prénom: </label><span>'.$row['NAME'].'</span></li>
                        <li><label>Nom: </label><span>'.$row['SURNAME'].'</span></li>
                        <li><label>Adresse: </label><span>'.$row['ADRESS'].'</span></li>
                        <li><label>Code Postal: </label><span>'.$row['CP'].'</span></li>
                        <li><label>Email: </label><span>'.$row['MAIL'].'</span></li>
                            <li><label>Association: </label><span>'.(new MAssoc($row['ASSOCIATION_ID']))->getName().'</span></li>
                        <li><label>Thème: </label><span>'.(new MTheme($row['THEME_ID']))->getName().'</span></li>
                        <li><label>Thème d\'intérêt: </label><span>'.(new MTheme($row['THEME_INTEREST_ID']))->getName().'</span></li>
                        <li><label>Profession: </label><span>'.$row['PROFESSION'].'<br> '.$row['PROFESSION2'].'</span></li>

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
                $i++;
            }
        }else {

            if(isset($assoc)){
              foreach ($pdo->query('SELECT Count(*) As NUM FROM USER WHERE ASSOCIATION_ID = '.$assoc) as $row) {
                $rowNumber= $row['NUM'];
              }
                $sql = 'SELECT * FROM USER WHERE ASSOCIATION_ID = '.$assoc.' Order by Name ASC   LIMIT '.$nbLines.' OFFSET '.$offset;
            }
            else{
              foreach ($pdo->query('SELECT Count(*) As NUM FROM USER') as $row) {
                $rowNumber= $row['NUM'];
              }
                $sql = 'SELECT * FROM USER order by NAME ASC LIMIT '.$nbLines.' OFFSET '.$offset;
              }
            if(count($sql) > 0) {

                foreach ($pdo->query($sql) as $row) {
                    array_push($dataCSV, $row);
                    $img = null;
                    if($row['PHOTOPATH']) {
                        $img = $row['PHOTOPATH'];
                    }
                    echo ($i%2==0)?'<tr class="tr-even">':'<tr>';;
                    echo '<td>'. $row['NAME'] . ' '.$row['SURNAME'].'</td>';
                    echo '<td>'. (new MTheme($row['THEME_ID']))->getName() . '</td>';
                    echo '<td>'. $row['PROFESSION'] . '</td>';
                    echo '<td>';
                    echo '<a class="btn fenprof" id="popin-'.$row['ID'] .'" href="#popin-data'.$row['ID'] .'">Profil</a>';
                    echo '<div id="popin-data'.$row['ID'] .'"  style="left: 424.5px; position: absolute; top: 807.5px; z-index: 9999; opacity: 1; display: none;">

            <div id="profile" class="active" style="display: block;">
                    <!-- About section -->
                    <div class="about">
                        <input type="hidden" value="'.$img.'">
                    </div>
                    <!-- /About section -->

                    <!-- Personal info section -->
                    <ul class="personal-info">
            <li><label>Prénom: </label><span>'.$row['NAME'].'</span></li>
                        <li><label>Nom: </label><span>'.$row['SURNAME'].'</span></li>
                        <li><label>Adresse: </label><span>'.$row['ADRESS'].'</span></li>
                        <li><label>Code Postal: </label><span>'.$row['CP'].'</span></li>
                        <li><label>Email: </label><span>'.$row['MAIL'].'</span></li>
                        <li><label>Association: </label><span>'.(new MAssoc($row['ASSOCIATION_ID']))->getName().'</span></li>
                        <li><label>Thème: </label><span>'.(new MTheme($row['THEME_ID']))->getName().'</span></li>
                        <li><label>Thème d\'intérêt: </label><span>'.(new MTheme($row['THEME_INTEREST_ID']))->getName().'</span></li>
                        <li><label>Profession: </label><span>'.$row['PROFESSION'].'<br> '.$row['PROFESSION2'].'</span></li>

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
                    $i++;
                }
            }
        }
        ?>
        </tbody>
    </table>
    <div class="control-group">
        <label class="control-label">Changer de Page</label>
        <div class="controls">
          <?php
            $numberPages= ceil($rowNumber/$nbLines);
            for($i=1;$i<=$numberPages;++$i)
              echo '<button type="submit" class="changePageButton" form="manageMember" formaction="./index.php?EX=manageMembers&PAGE='.$i.'">'.$i.'</button>';
          ?>
        </div>
    </div>
    <a target="_blank" href="index.php?EX=downloadCVS"><button class="downloadCVS">Télécharger format CSV</button></a>
    <?php
    $dataCSVOk = array();
    for($i = 0 ; $i < count($dataCSV) ; ++$i)
    {
        $current = array();
        array_push($current, utf8_decode($dataCSV[$i]['THEME_DETAILS']));
        array_push($current, utf8_decode($dataCSV[$i]['ROLE']));
        array_push($current, utf8_decode($dataCSV[$i]['NAME']));
        array_push($current, utf8_decode($dataCSV[$i]['SURNAME']));
        array_push($current, utf8_decode($dataCSV[$i]['MAIL']));
        array_push($current, utf8_decode($dataCSV[$i]['ADRESS']));
        array_push($current, utf8_decode($dataCSV[$i]['CP']));
        array_push($current, utf8_decode($dataCSV[$i]['PROFESSION']));
        array_push($current, utf8_decode($dataCSV[$i]['PROFESSION2']));
        array_push($dataCSVOk, $current);
    }
    $fichier_csv = fopen('Csv/ExportationUser.csv', 'w+');
    for($i = 0 ; $i < count($dataCSVOk) ; ++$i)
    {
        fputcsv($fichier_csv, $dataCSVOk[$i], ';');
    }
    fclose($fichier_csv);
    ?>
</div>
</div>

</div> <!-- /container -->
