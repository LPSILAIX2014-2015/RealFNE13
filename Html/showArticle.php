<?php
	global $data_article;
?>

	<div class="container-fluid pvarticle">
    <h1>Liste des articles</h1>
<?php
      for($i = 0 ; $i < count($data_article) ; ++$i)
      {
        echo "<div id='article" . $data_article[$i]['ID']
                    . "' class='lienarticle'>";
          echo "<div id='imgplace'>";
            echo "<img src='" . $data_article[$i]['IMAGEPATH']
                    . "' class='img-responsive' />";
          echo "</div>";
        
          echo "<div id='infoarticle'>";
            echo "<h2>" . $data_article[$i]['TITLE'] . "</h2>";
            echo "<p class='auteur'>"
                    . $data_article[$i]['NAME']
                    . " ". $data_article[$i]['SURNAME']
                    . ", le ". $data_article[$i]['PDATE']
                    . "</p>";
            echo "<p class='description'>"
                    . $data_article[$i]['DESCRIPTION']
                    . "</p>";
          echo "</div>";
        echo "</div>";
      }
?>
	</div>
  	<div id='pagination' class='compact-theme simple-pagination'></div>

	<script type="text/javascript" src="Js/showInfoArticle.js"></script>