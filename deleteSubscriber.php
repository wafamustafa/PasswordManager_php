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

//delete subscription information by id
use Codesses\php\Models\{DatabaseTwo, Subscriber};

require_once './php/Models/DatabaseTwo.php';
require_once './php/Models/Subscriber.php';

if(isset($_POST['subscriber_id'])){
    $id = $_POST['subscriber_id'];
    $db = DatabaseTwo::getDb();
    $s = new subscriber();
    $count = $s->deleteSubscriber($id, $db);
    if($count){
        header("Location: subscribe.php");
        exit;
    }
    else {
        // echo " problem deleting a subscriber ";
        echo("Problem deleting a subscriber");
        return false;
    }  

}

?>