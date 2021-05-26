<?php
//Elle
//use references
use Codesses\php\Models\{DatabaseTwo, Contact, Session};

//Inlcude Statements
require_once './php/Models/DatabaseTwo.php';
require_once './php/Models/Contact.php';
require_once './php/Models/Session.php';

// Get the session object.
$session = Session::getInstance();

// If the user is not logged in, redirect to the Contact Us page.
if( !$session->hasUser() ) {
    header( "Location: contactUs.php" );
    exit;
}

//If a delete request has been sent, delete item
if(isset($_POST['cm_id'])){

    $id = $_POST['cm_id'];
    //Create new database connection
    $db = DatabaseTwo::getDb();
    //Instantiate a new class
    $s = new Contact();
    //Function Call to Database
    $count = $s->deleteContactMessage($id, $db);
    
    if($count){
        //If deleted, show updated list
        header("Location: listContactMessages.php");
        exit;
    }
    //In case of error
    else {
        echo " problem deleting";
    }
    }
?>