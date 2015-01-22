
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
     include './header.php';
    ?>
    
    <script type="text/javascript">
  $(document).ready(function(){
    var name = new Array();
    var surname = new Array();
    var cp = new Array();
    var profession = new Array();
    $.ajax({
    type: 'POST',
    url: '../Php/autocomplete.php',
    dataType: 'json',
    data: {'categories': 'tmp'},
    success: function(data) {
        data.forEach(function(entry) {
            name.push(entry['NAME']);
            surname.push(entry['SURNAME']);
            cp.push(entry['CP']);
            profession.push(entry['PROFESSION']);
        });
       
      $( "#name" ).autocomplete({
        source: name
      });
    }
  });
  
  
  
   $('#btn1').click(function (){
      var selected = [];
$(' input:checked').each(function() {
    selected.push($(this).attr('value'));
});
document.location.href="../Html/email.php?option1="+selected;
     
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
</head>

<body>
   
    <div class="container">
    		<div class="row">
    			<h3>FNESITE</h3>
    		</div>
        
                
        <form class="form-horizontal" action="./data.php" method="post">
					  <div class="control-group">
					    <label class="control-label">Name</label>
					    <div class="controls">
                                                <input name="NAME" id="name" type="text"  placeholder="Name" pattern="^[a-zA-Z \.\,\+\-]*$" value="">
                                                <span>(Alphabétique)</span>
					    </div>
					  </div>
                                          <div class="control-group">
					    <label class="control-label">SurName</label>
					    <div class="controls">
					      	<input name="SURNAME" id="surname" type="text"  placeholder="SurName" value="">
					      	
					    </div>
					  </div>
                                          <div class="control-group">
					    <label class="control-label">cp - code postale</label>
					    <div class="controls">
                                                <input name="CP" type="text" id="cp"  placeholder="cp - code postale" pattern="[0-9]{5}"  value="">
                                                <span>(5 chiffres)</span>
					    </div>
					  </div>
					  
					  <div class="control-group">
					    <label class="control-label">Profession</label>
					    <div class="controls">
					      	<input name="PROFESSION" id="profession" type="text"  placeholder="PROFESSION" value="">
					      	
					    </div>
					  </div>
                                          <div class="control-group">
					    <label class="control-label">Association</label>
					    <div class="controls">
					      	<input name="ASSOCIATION" id="association" type="text"  placeholder="Association" value="">
					      	
					    </div>
					  </div>
                                          <div class="control-group">
					    <label class="control-label">Spécialité</label>
					    <div class="controls">
					      	<input name="SPECIALITE" id="specialite" type="text"  placeholder="Spécialité" value="">
					      	
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Rechercher</button>
						  
					  </div>
                                          
					</form>
        
			<div class="row">
				
				
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
		                  <th>Name</th>
                                  <th>SurName</th>
                                  <th>CP</th>
		                  <th>Profession</th>
                                  <th>Action
                                      <label id="btn1" class="btn">envoyer</label>
                                  </th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php
					   $pdo = new MDBase();
                                           if ( !empty($_POST)) {
                                               $nom = $_POST['NAME'];
                                               $conditions = array();
                                               $params = array();
                                               if($nom) {
                                                   $conditions[] = "NAME = '". $nom. "'";
                                                   $params[]= $nom;
                                               }
                                               if($_POST['SURNAME']) {
                                                   $conditions[] = "SURNAME = '". $_POST['SURNAME']. "'";
                                                   $params[] = $_POST['SURNAME'];
                                               }
                                               if($_POST['CP']) {
                                                   $conditions[] = "CP = '". $_POST['CP']. "'";
                                                   $params[] = $_POST['CP'];
                                               }
                                               if($_POST['PROFESSION']) {
                                                   $conditions[] = "PROFESSION = '". $_POST['PROFESSION']. "'";
                                                   $params[] = $_POST['PROFESSION'];
                                               }
                                               
                                               $where = " WHERE ".implode($conditions,' AND ');
                                               $surnom = $_POST['SURNAME'];
                                               if(count($conditions) > 0) {
                                                   $sql = 'SELECT * FROM user'. $where;
                                               }else {
                                                   $sql = 'SELECT * FROM user order by NAME ASC';
                                               }
                                               
                                               foreach ($pdo->query($sql) as $row) {
                                                $img = null;
                                               if($row['PHOTOPATH']) {
                                                   $img = $row['PHOTOPATH'];
                                               }
                                                    echo '<tr>';
						    echo '<td>'. $row['NAME'] . '</td>';
						    echo '<td>'. $row['SURNAME'] . '</td>';
						    echo '<td>'. $row['CP'] . '</td>';
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
                        <li><label>Association</label><span>'.DBase::getAssociation($row['ASSOCIATION_ID']).'</span></li>
                        <li><label>Thème</label><span>'.DBase::getTheme($row['THEME_ID']).'</span></li>
                        <li><label>Thème Interest</label><span>'.DBase::getTheme($row['THEME_INTEREST_ID']).'</span></li>
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
                                               
                                               $sql = 'SELECT * FROM user order by NAME ASC';
                                                  if(count($sql) > 0) {
                                                     
	 				   foreach ($pdo->query($sql) as $row) {
                                               $img = null;
                                               if($row['PHOTOPATH']) {
                                                   $img = $row['PHOTOPATH'];
                                               }
						   		echo '<tr>';
							   	echo '<td>'. $row['NAME'] . '</td>';
							   	echo '<td>'. $row['SURNAME'] . '</td>';
							   	echo '<td>'. $row['CP'] . '</td>';
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
                        <li><label>Association</label><span>'.DBase::getAssociation($row['ASSOCIATION_ID']).'</span></li>
                        <li><label>Thème</label><span>'.DBase::getTheme($row['THEME_ID']).'</span></li>
                        <li><label>Thème Interest</label><span>'.DBase::getTheme($row['THEME_INTEREST_ID']).'</span></li>
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
                                          
                                           }
                                           
                                           }
					   DBase::disconnect();
					  ?>
                              
				      </tbody>
	            </table>
    	</div>
    </div> <!-- /container -->
  </body>
</html>