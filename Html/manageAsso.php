<?php
    if((isset($_SESSION['ROLE']))&&($_SESSION['ROLE'])=='SADMIN'){}
    else{
        header("Location: ./index.php");
    }
    $nbLines=10;
    if(isset($_POST['LINES']))
      $nbLines=$_POST['LINES'];
    $nbPage=1;
    if(isset($_GET['PAGE']))
      $nbPage=$_GET['PAGE'];
    $offset= ($nbPage-1)*$nbLines;
?>
<script type="text/javascript">
    $(document).ready(function(){
        var name = new Array();
        var theme = new Array();
        var territoire = new Array();
        $.ajax({
            type: 'POST',
            url: './Php/autocomplete.php',
            dataType: 'json',
            data: {'categories': 'tmp'},
            success: function(data) {

                var jss = jQuery.parseJSON(data);

                jss.forEach(function(entry) {

                    name.push(entry['NAME']);
                    theme.push(entry['THEME']);
                    territoire.push(entry['TERRITORY']);
                });
            }
        });
    });



</script>
<?php

    $i = 0;

    $pdo = new MDBase();
    $associationsList = $pdo ->getAllAssocs();
    foreach($associationsList as $line){
        $associations[$i]['ID'] = $line['ID'];
        $associations[$i]['NAME'] = $line['NAME'];
        $i++;
    }
    $i = 0;

    $territoriesList = $pdo ->getAllTerritories();
    foreach($territoriesList as $line){
        $territories[$i]['ID'] = $line['ID'];
        $territories[$i]['NAME'] = $line['NAME'];
        $i++;
    }
    $i = 0;

    $themesList = $pdo ->getAllThemes();
    foreach($themesList as $line){
        $themes[$i]['ID'] = $line['ID'];
        $themes[$i]['NAME'] = $line['NAME'];
        $i++;
    }


?>

<div class="container">
<div class="row">
    <h3>Les associations membres du réseau FNE13</h3>
</div>


<form class="form-horizontal" id="manageAsso" action="./index.php?EX=manageAsso" method="post">
    <div class="control-group">
        <label class="control-label">Nom</label>
        <div class="controls">
            <select class="controls" name="NAME" type="text">
                <?php
                    echo('<option></option>');
                    foreach ($associations as $key => $association) {
                      if((isset($_POST['NAME']))&&($_POST['NAME']==$association['ID']))
                          echo('<option value ='.$association['ID'].' selected>'.$association['NAME'].'</option>');
                      else
                        echo('<option value ='.$association['ID'].'>'.$association['NAME'].'</option>');
                    }
                ?>
            </select>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label">Th&egrave;me</label>
        <div class="controls">
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
    </div>

    <div class="control-group">
        <label class="control-label">Territoire</label>
        <div class="controls">
            <select class="controls" name="TERRITORY" type="text">
                <?php
                    echo('<option></option>');
                    foreach ($territories as $key => $territory) {
                      if((isset($_POST['TERRITORY']))&&($_POST['TERRITORY']==$territory['ID']))
                        echo('<option value ='.$territory['ID'].' selected>'.$territory['NAME'].'</option>');
                      else
                        echo('<option value ='.$territory['ID'].'>'.$territory['NAME'].'</option>');
                    }
                ?>
            </select>
        </div>
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
        <a href="./index.php?EX=createAsso"><button type="button" class="btn">Création</button></a>
    </div>

</form>

<div class="row">


    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Nom</th>
            <th>Theme</th>
            <th>Territoire</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ( isset($_POST['NAME'])) {
            $conditions = array();
            $params = array();
            if($_POST['NAME']) {
                $conditions[] = "ID = '". $_POST['NAME'] . "' ";
                $params[]= $_POST['NAME'];
            }
            if($_POST['THEME']) {
                $conditions[] = "THEME_ID = '". $_POST['THEME'] . "' ";
                $params[] = $_POST['THEME'];
            }
            if($_POST['TERRITORY']) {
                $conditions[] = "TERRITORY_ID = '". $_POST['TERRITORY'] . "' ";
                $params[] = $_POST['TERRITORY'];
            }
            $where = " WHERE ".implode($conditions,' AND ');
            if(count($conditions) > 0) {
                foreach ($pdo->query('SELECT Count(*) As NUM FROM ASSOCIATION'. $where) as $row) {
                  $rowNumber= $row['NUM'];
                }
                $sql = 'SELECT * FROM ASSOCIATION'. $where .' LIMIT '.$nbLines.' OFFSET '.$offset;
            }else {
                foreach ($pdo->query('SELECT Count(*) As NUM FROM ASSOCIATION') as $row) {
                  $rowNumber= $row['NUM'];
                }
                $sql = 'SELECT * FROM ASSOCIATION order by NAME ASC LIMIT '.$nbLines.' OFFSET '.$offset;
            }
            $data=$pdo->query($sql);
            foreach ($data as $row) {
                echo ($i%2==0)?'<tr class="tr-even">':'<tr>';
                echo '<td>'. $row['NAME'] . '</td>';
                echo '<td>'.(new MTheme($row['THEME_ID']))->getName().'</td>';
                echo '<td>'.(new MTerritory($row['TERRITORY_ID']))->getName().'</td>';
                echo '<td width=250>';
                echo '&nbsp;';
                echo '<a class="btn btn-success" href="index.php?EX=updateAsso&id='.$row['ID'].'">Edit</a>';
                echo '&nbsp;';
                echo '<a class="btn btn-danger" href="index.php?EX=deleteAsso&id='.$row['ID'].'">Supprimer</a>';
                echo '</td>';
                echo '</tr>';
                ++$i;
            }

        }else {
            foreach ($pdo->query('SELECT Count(*) As NUM FROM ASSOCIATION') as $row) {
              $rowNumber= $row['NUM'];
            }
            $sql = 'SELECT * FROM ASSOCIATION order by NAME ASC LIMIT '.$nbLines.' OFFSET '.$offset;
            if(count($sql) > 0) {
              foreach ($pdo->query($sql) as $row) {
                    echo ($i%2==0)?'<tr class="tr-even">':'<tr>';
                    echo '<td>'. $row['NAME'] . '</td>';
                    echo '<td>'.(new MTheme($row['THEME_ID']))->getName().'</td>';
                    echo '<td>'.(new MTerritory($row['TERRITORY_ID']))->getName().'</td>';
                    echo '<td width=250>';
                    echo '&nbsp;';
                    echo '<a class="btn btn-success" href="index.php?EX=updateAsso&id='.$row['ID'].'">Edit</a>';
                    echo '&nbsp;';
                    echo '<a class="btn btn-danger" href="index.php?EX=deleteAsso&id='.$row['ID'].'">Supprimer</a>';
                    echo '</td>';
                    echo '</tr>';
                    ++$i;

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
              echo '<button type="submit" class="changePageButton" form="manageAsso" formaction="./index.php?EX=manageAsso&PAGE='.$i.'">'.$i.'</button>';
          ?>
        </div>
    </div>
</div>
</div>
