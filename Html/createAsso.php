<?php
if(!isset($_SESSION['ROLE'])||($_SESSION['ROLE']!='SADMIN'))
	header('Location: ./index.php');
$i=0;
$pdo = new MDBase();
$territoryList = $pdo -> getAllTerritories();
foreach($territoryList as $line){
	$territories[$i]['ID']=$line['ID'];
	$territories[$i]['NAME']=$line['NAME'];
	$i++;
}

$i=0;
$themeList = $pdo -> getAllThemes();
foreach($themeList as $line){
	$themes[$i]['ID']=$line['ID'];
	$themes[$i]['NAME']=$line['NAME'];
	$i++;
}


$erreur = null;
if(isset($_GET['error'])) {
	$erreur = $_GET['error'];
}

?>
<div>

	<div class="span10 offset1">
		<div class="row">
			<h3>Créer une association</h3>
		</div>

		<form class="form-horizontal" action="index.php?EX=createAdmin" enctype="multipart/form-data" method="post">
			<div class="control-group">
				<label class="control-label">Nom</label>
				<div class="controls">
					<input name="NAME" type="text" pattern="[^'\x22\;\.]+" placeholder="Nom" value="<?php echo !empty($name)?$name:'';?>">
					<span>(Alphabétique)</span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Territoire</label>
			</br>
			<select class="controls" name="TERRITORY" type="text">
				<?php
				foreach ($territories as $key => $territory) {
					if($territory['ID']!=$territoryID)
						echo('<option value ='.$territory['ID'].'>'.$territory['NAME'].'</option>');
					else

						echo('<option value ='.$territory['ID'].' selected>'.$territory['NAME'].'</option>');
				}
				?>
			</select>
			</div>
			<div class="control-group">
				<label class="control-label">Theme</label>
			</br>
			<select class="controls" name="THEME" type="text">
				<?php
				foreach ($themes as $key => $theme) {
					echo('<option value ='.$theme['ID'].'>'.$theme['NAME'].'</option>');
				}
				?>
			</select>
			</div>
			<div class="form-group">
				<label for="articleImage" class="col-sm-3 control-label">Logo de l'association</label>
				<div class="col-sm-5">
					<input type="file" id="articleImage" name="articleImage">
				</div>
				<input type="hidden" name="max_file_size" value="3145728">
			</div>
			<div class="form-actions">
				<button type="submit" class="btn btn-success">Créer l'association</button>
				<a href="./index.php?EX=manageAsso"><button type="button" class="btn">Retour</button></a>
			</div>
		</form>
	</div>
</div> <!-- /container -->
