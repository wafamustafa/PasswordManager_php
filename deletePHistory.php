<?php

// File created by Barbara Cam 2021/03.

use Codesses\php\Models\{Session};
require_once "./php/Models/Session.php";

// Get the session.
$session = Session::getInstance();

// If the user is not logged in, redirect to the login page.
if( !$session->hasUser() ) {
  header( "Location: login.php" );
  exit;
}

use Codesses\php\Models\{DatabaseTwo, PasswordHistory};

require_once './php/Models/DatabaseTwo.php';
require_once './php/Models/PasswordHistory.php';

//delete password history by password history id
if(isset($_POST['ph_id'])){
    $id = $_POST['ph_id'];
    $db = DatabaseTwo::getDb();
    $ph = new passwordHistory();
    $count = $ph->deletePasswordHistory($id, $db);
    if($count){
        header("Location: pHistory.php");
        exit;
    }
    else {        
        echo("Problem deleting password history");
        return false;
    }  

}

?>