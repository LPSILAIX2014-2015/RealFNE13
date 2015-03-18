<?php
  $id = null;
  if ( !empty($_GET['id'])) {
    $id = $_REQUEST['id'];
  }
  if ( !empty($_POST)) {
        $user= new MUser($id);
        $prevRole=$user->getRole();
        if($prevRole !='ADMIN' && $prevRole != 'SADMIN'){
          $role = $_POST['ROLE'];

          // update data
          $user->setRole($role);
        }
    }
    header("Location: index.php?EX=manageMembers");
