<?php
global $data_article;
global $data_assoc;
global $data_theme;
global $data_idUserList;

$nbArticles = count($data_article);

function afficheArticle($indexArticle) {
	global $data_article;

	if($data_article[$indexArticle]['IMAGEPATH'] != NULL) {
		$imgArticle = "<img src='".$data_article[$indexArticle]['IMAGEPATH']."'"
		.     " class='img-responsive' />";
	} else {
		$imgArticle = "<img src='Img/logo.png'"
		.     " class='img-responsive transparence' />";
	}

	$description = "";
	if(strlen($data_article[$indexArticle]['CONTENT']) > 250) {
		$contenuDecode = html_entity_decode($data_article[$indexArticle]['CONTENT']);

		$contenuDecode = str_replace('<br />', '[SLaaa]', $contenuDecode);
		$contenuDecode = str_replace('</p>', '[SLaaa]', $contenuDecode);
		$contenuTrunc = substr(strip_tags($contenuDecode), 0, 250);
		$contenuFormate = str_replace('[SLaaa]', '<br />', $contenuTrunc);


		$description = $contenuFormate;
	} else {
		$description = html_entity_decode($data_article[$indexArticle]['CONTENT']);
	}

	echo "<div id='article" . $data_article[$indexArticle]['ID'] . "'"
	.      " class='lienarticle'"
	.      " data-assoc='" . $data_article[$indexArticle]['ASSOC_ID'] . "'"
	.      " data-theme='" . $data_article[$indexArticle]['THEME_ID'] . "'>"
	.    "<div id='imgplace'>"
	.      $imgArticle
	.    "</div>"

	.    "<div id='infoarticle'>"
	.      "<h2>" . $data_article[$indexArticle]['TITLE'] . "</h2>"
	.      "<p class='auteur'>"
	.         $data_article[$indexArticle]['NAME']
	.         " " . $data_article[$indexArticle]['SURNAME']
	.         ", le ". $data_article[$indexArticle]['PDATE']
	.      "</p>"
	.      "<p class='description'>"
	.         $description
	.      "</p>"
	.    "</div>"
	.  "</div>";
}
?>

<div class="container-fluid pvarticle">

	<div class="filter">
		<select id="filterASSOC">
			<?php
			if(isset($_GET['idA']))
			{
				for($i = 0 ; $i < count($data_assoc) ; ++$i)
				{
					if(intval(htmlspecialchars($_GET['idA'])) == $data_assoc[$i]['ID'])
					{
						echo '<option class="optionAssoc" value="' . $data_assoc[$i]['ID'] . '">'
						.     $data_assoc[$i]['NAME']
						.  '</option>';
					}

				}
			}
			?>
			<option class="optionAssoc" value="0">- Assoc -</option>
			<?php
			if(isset($_GET['idA']))
			{
				for($i = 0 ; $i < count($data_assoc) ; ++$i)
				{
					if(intval(htmlspecialchars($_GET['idA'])) != $data_assoc[$i]['ID'])
					{
						echo '<option class="optionAssoc" value="' . $data_assoc[$i]['ID'] . '">'
						.     $data_assoc[$i]['NAME']
						.  '</option>';
					}

				}
			}
			else
			{
				for($i = 0 ; $i < count($data_assoc) ; ++$i)
				{
					echo '<option class="optionAssoc" value="' . $data_assoc[$i]['ID'] . '">'
					.     $data_assoc[$i]['NAME']
					.  '</option>';
				}
			}

			?>
		</select>
		<select id="filterTHEME">
			<option value="0">- Thème -</option>
			<?php

			for($i = 0 ; $i < count($data_theme) ; ++$i)
			{
				echo '<option value="' . $data_theme[$i]['ID'] . '">'
				.     $data_theme[$i]['NAME']
				.  '</option>';
			}
			?>
		</select>
	</div>

	<h1>Liste des articles</h1>

	<?php
	
<<<<<<< HEAD
=======
		if(is_null($_SESSION['ID_USER'])) {
			for($i = 0 ; $i < $nbArticles ; ++$i)
			{
				if($data_article[$i]['STATUS'] > 0)
				{
					afficheArticle($i);
				}
			}
		} else {
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b
			for($i = 0 ; $i < $nbArticles ; ++$i)
			{ 
				afficheArticle($i);
			}
<<<<<<< HEAD
		
=======
		}
	

	
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b
	?>
</div>
<div id='pagination' class='compact-theme simple-pagination'></div>

<script type="text/javascript" src="Js/showInfoArticle.js"></script>