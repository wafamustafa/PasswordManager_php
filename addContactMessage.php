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

// If the user is not logged in, redirect to the Contact Us Page.
if( !$session->hasUser() ) {
    header( "Location: contactUs.php" );
    exit;
}

//if all fields posted, add to Database
if(isset($_POST['addContactMessage'])){
    $user = $_POST['user'];
    $timestamp = $_POST['timestamp'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // New db connection
    $db = DatabaseTwo::getDb();
    //Instantiate a new class
    $s = new Contact();
    //Function Call to Database
    $c = $s->addContactMessage($user, $timestamp, $first_name, $last_name, $email, $message, $db);
    
    //if Message added, redirect back to list, else, echo error
    if($c){
        header('Location: listContactMessages.php');
        exit;
    } else {
        echo "problem adding a contact message";
    } 
};      
//Form Validation
if(isset($_POST['submit'])) {
    $emailerr = "";
    $nameerr = "";
    $lasterr = "";
    $usererr = "";
    $timestamperr = "";
    $messageerr = "";
    $user = $_POST['user'];
    $timestamp = $_POST['timestamp'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    if($email == ""){
        $emailerr = "please enter email";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailerr = "please enter a valid email";
    } else {
        $emailerr = " That's a valid email";
    }
    if(empty($user)) {
        $usererr = " Please enter name";
    }
    if(empty($timestamp)) {
        $timestamperr = " Please enter name";
    }
    if(empty($first_name)) {
        $nameerr = " Please enter name";
    }
    if(empty($last_name)) {
        $lasterr = " Please enter name";
    }
    if(empty($message)) {
        $messageerr = " Please enter name";
    }
}
?>


<html lang="en">

    <head>
        <!-- Head -->
        <?php include "php/head.php" ?>
        <title>Pass**** Manager Home</title>
        <link rel="stylesheet" href="./css/contact.css">
        <script src="./js/script.js" async defer></script>
    </head>

    <body>
        <!-- Header -->
        <?php include "php/header.php" ?>
        <main>
            <h2 style="margin:0;background-color:#562f56;text-align:center;padding:1em;font-size:2em;">Add Contact Message</h2>
            <div>
                <!--    Form to Add  Contact Message -->
                <form action="" method="post">
                    <div class="content">
                        <label for="user">User</label>
                        <input type="text" id="user" name="user" placeholder="Enter User">
                        <span style="color: red"><?= isset($usererr)? $usererr: ''; ?></span>
                    </div>
                    <div class="content">
                        <label for="timestamp">Time</label>
                        <input type="datetime-local" id="timestamp" name="timestamp" placeholder="Enter timestamp">
                        <span style="color: red"><?= isset($timestamperr)? $timestamperr: ''; ?></span>
                    </div>
                    <div class="content">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" id="first_name" placeholder="Enter first name">
                        <span style="color: red"><?= isset($nameerr)? $nameerr: ''; ?></span>
                    </div>
                    <div class="content">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" id="last_name" placeholder="Enter last name">
                        <span style="color: red"><?= isset($lasterr)? $lasterr: ''; ?></span>
                    </div>
                    <div class="content">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Enter email">
                        <span style="color: red"><?= isset($emailerr)? $emailerr: ''; ?></span>
                    </div>
                    <div class="content">
                        <label for="message">Message</label>
                        <input type="text" name="message" id="message1" placeholder="Enter message">
                        <span style="color: red"><?= isset($messageerr)? $messageerr: ''; ?></span>
                    </div>
                    <div style="display:flex;background-color:#562f56;text-align:center;padding:2% 37%;">
                        <a href="./listContactMessages.php" class="content linkAsButton inputDiv" style="padding:0.8em;text-decoration:none;color:black;width:8em;height:3em;font-weight:inherit;">Back</a>
                        <button type="submit" class="content cBox" name="addContactMessage" style="text-decoration:none;color:black;width:9em;height:4em;font-size:initial;margin-top:0.4em;">Add Contact Message</button>
                    </div>
                </form>
            </div>
        </main>
        <!-- Footer -->
        <?php include "php/footer.php"?>
    </body>
</html