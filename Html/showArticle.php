
<?php
	
?>

<div class="pvarticle">

	<div class="filter">
		<select id="filterASSOC">
			<option class="optionAssoc" value="-1">- Assoc -</option>
			<?php

                //On recupere les themes de la base avec une requete
                $Themes = new MDBase();
                $values = $Themes->getAllAssocs();
                $option = "";

                //Les values des options du select correspondront aux IDs, Les textes aux NAMEs
                for($i = 0 ; $i < count($values) ; ++$i)
                {
                    $option.= '<option value="'.$values[$i]['ID'].'">'.$values[$i]['NAME'].'</option>';
                }

                //On affiche enfin nos options remplies comme il faut.
                echo $option;
             ?>
		</select>
		<select id="filterTHEME">
			<option value="-1">- Thème -</option>
			<?php

                //On recupere les themes de la base avec une requete
                $Themes = new MDBase();
                $values = $Themes->getAllThemes();
                $option = "";

                //Les values des options du select correspondront aux IDs, Les textes aux NAMEs
                for($i = 0 ; $i < count($values) ; ++$i)
                {
                    $option.= '<option value="'.$values[$i]['ID'].'">'.$values[$i]['NAME'].'</option>';
                }

                //On affiche enfin nos options remplies comme il faut.
                echo $option;
             ?>
		</select>
	</div>

	<h1>Liste des articles</h1>
	<div id="divArticle"></div>
	
</div>
<ul id='pagination' class='pagination'></ul>
<script type="text/javascript" src="Js/showInfoArticle.js"></script>

