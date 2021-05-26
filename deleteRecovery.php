<?php

// File created by Barbara Cam 2021/04.

use Codesses\php\Models\{Session};
require_once "./php/Models/Session.php";

// Get session
$session = Session::getInstance();

// If the user is not logged in, redirect to the login page.
if( !$session->hasUser() ) {
  header( "Location: login.php" );
  exit;
}

use Codesses\php\Models\{DatabaseTwo, Recovery};

require_once './php/Models/DatabaseTwo.php';
require_once './php/Models/Recovery.php';

//delete security question and answer from the database
if(isset($_POST['sa_id'])){
    $id = $_POST['sa_id'];
    $db = DatabaseTwo::getDb();
    $r = new recovery();
    $count = $r->deleteRecovery($id, $db);
    if($count){
        header("Location: recoveryInformation.php");
        exit;
    }
    else {
        // echo " problem deleting recovering ";
        echo("Problem deleting recovering information");
        return false;
    }  

}

?>