<?php
//Elle
//use references
use Codesses\php\Models\{DatabaseTwo, LoginHistory};

//Inlcude Statements
require_once './php/Models/DatabaseTwo.php';
require_once './php/Models/LoginHistory.php';

//If a delete request has been sent, delete item
if(isset($_POST['lh_id'])){

    $id = $_POST['lh_id'];
    //Create new database connection
    $db = DatabaseTwo::getDb();
    //Instantiate a new class
    $s = new LoginHistory($db);
    //Query Database
    $count = $s->deleteLoginHistory($id);
        
    if($count){
        //If deleted, show updated list
        header("Location: listLoginHistory.php");
        exit;
    }
    //In case of error
    else {
        echo " problem deleting";
    }
}
?>