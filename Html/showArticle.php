<?php
  global $data_article;
  $nbArticles = count($data_article);

  function afficheArticle($indexArticle) {
    global $data_article;

    echo "<div id='article" . $data_article[$indexArticle]['ID'] . "'"
      .      " class='lienarticle'>"
      .    "<div id='imgplace'>"
      .      "<img src='" . $data_article[$indexArticle]['IMAGEPATH'] . "'"
      .          " class='img-responsive' />"
      .    "</div>"
      
      .    "<div id='infoarticle'>"
      .      "<h2>" . $data_article[$indexArticle]['TITLE'] . "</h2>"
      .      "<p class='auteur'>"
      .         $data_article[$indexArticle]['NAME']
      .         " " . $data_article[$indexArticle]['SURNAME']
      .         ", le ". $data_article[$indexArticle]['PDATE']
      .      "</p>"
      .      "<p class='description'>"
      .         $data_article[$indexArticle]['DESCRIPTION']
      .      "</p>"
      .    "</div>"
      .  "</div>";
  }
?>

  <div class="container-fluid pvarticle">
    <h1>Liste des articles</h1>
<?php
      if(is_null($_SESSION['ID_USER'])) {
        for($i = 0 ; $i < $nbArticles ; ++$i)
        {
          if($data_article[$i]['STATUS'] > 0) {
            afficheArticle($i);
          }
        }
      } else {
        for($i = 0 ; $i < $nbArticles ; ++$i)
        { 
          afficheArticle($i);
        }
      }
?>
	</div>
  	<div id='pagination' class='compact-theme simple-pagination'></div>

	<script type="text/javascript" src="Js/showInfoArticle.js"></script>