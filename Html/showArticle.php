<?php
  global $data_article;
  global $data_assoc;
  global $data_theme;

  $nbArticles = count($data_article);

  function afficheArticle($indexArticle) {
    global $data_article;
    
    if(strlen($data_article[$indexArticle]['CONTENT']) > 250) {
      $description = substr($data_article[$indexArticle]['CONTENT'], 0, 250);
    } else {
      $description = $data_article[$indexArticle]['CONTENT'];
    }
    echo "<div id='article" . $data_article[$indexArticle]['ID'] . "'"
      .      " class='lienarticle'"
      .      " data-assoc='" . $data_article[$indexArticle]['ASSOC_ID'] . "'"
      .      " data-theme='" . $data_article[$indexArticle]['THEME_ID'] . "'>"
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
      .         $description
      .      "</p>"
      .    "</div>"
      .  "</div>";
  }
?>

  <div class="container-fluid pvarticle">

    <div class="filter">
      <select id="filterASSOC">
        <option class="optionAssoc" value="0">- Assoc -</option>
        <?php
        
          for($i = 0 ; $i < count($data_assoc) ; ++$i)
          {
            echo '<option class="optionAssoc" value="' . $data_assoc[$i]['ID'] . '">'
              .     $data_assoc[$i]['NAME']
              .  '</option>';
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
      if(is_null($_SESSION['ID_USER'])) {
        for($i = 0 ; $i < $nbArticles ; ++$i)
        {
          if($data_article[$i]['STATUS'] > 0)
          {
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