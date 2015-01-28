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
    <h3>FNESITE</h3>
</div>


<form class="form-horizontal" action="./index.php?EX=manageAsso" method="post">
    <div class="control-group">
        <label class="control-label">Name</label>
        <div class="controls">
            <select class="controls" name="NAME" type="text">
                <?php
                    echo('<option></option>');
                    foreach ($associations as $key => $association) {
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
                        echo('<option value ='.$territory['ID'].'>'.$territory['NAME'].'</option>');
                    }
                ?>
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
            <th>Name</th>
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
                $conditions[] = "ID = '". $_POST['NAME'] . "'";
                $params[]= $_POST['NAME'];
            }
            if($_POST['THEME']) {
                $conditions[] = "THEME_ID = '". $_POST['THEME'] . "'";
                $params[] = $_POST['THEME'];
            }
            if($_POST['TERRITORY']) {
                $conditions[] = "TERRITORY_ID = '". $_POST['TERRITORY'] . "'";
                $params[] = $_POST['TERRITORY'];
            }
            $where = " WHERE ".implode($conditions);
            if(count($conditions) > 0) {
                $sql = 'SELECT * FROM ASSOCIATION'. $where;
            }else {
                $sql = 'SELECT * FROM ASSOCIATION order by NAME ASC';
            }

            foreach ($pdo->query($sql) as $row) {
                echo '<tr>';
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
            }

        }else {

            $sql = 'SELECT * FROM ASSOCIATION order by NAME ASC';
            if(count($sql) > 0) {

                foreach ($pdo->query($sql) as $row) {
                    echo '<tr>';
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

                }

            }

        }
        ?>

        </tbody>
    </table>
</div>
</div>
