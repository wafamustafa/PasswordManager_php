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

//Create new database connection
$dbconnection = DatabaseTwo::getDb();
//Instantiate a new class
$s = new Contact();
//Function Call to Database
$contactMessages =  $s->getAllContactMessages(DatabaseTwo::getDb());

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- global head -->
        <?php include "php/head.php" ?>
        <title>Pass**** Manager</title>
        <link rel="stylesheet" href="./css/contact.css">
        <script src="./js/script.js" async defer></script>
    </head>
    
    <!-- Body -->
    <body>
        <!-- Header -->
        <?php include "php/header.php" ?>
        <main>
            <h2 style="margin:0;background-color:#562f56;text-align:center;padding:1em;font-size:2em;">List of Contact Messages</h2>
            <div>
                <!--    Displaying Data in Table-->
                <table class="content" style="border: inset;padding: 0;font-size:1.3em;padding:1em;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>timestamp</th>
                            <th>User</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contactMessages as $contactMessages) { ?>
                            <tr>
                                <th><?= $contactMessages->cm_id; ?></th>
                                <td><?= $contactMessages->timestamp; ?></td>
                                <td><?= $contactMessages->user; ?></td>
                                <td><?= $contactMessages->first_name; ?></td>
                                <td><?= $contactMessages->last_name; ?></td>
                                <td><?= $contactMessages->email; ?></td>
                                <td><?= $contactMessages->message; ?></td>
                                <td>
                                <!-- Update Message-->
                                    <form action="./updateContactMessage.php" method="post" style="margin:0;background-color:#562f56;text-align:center;padding:0.5em;font-size:2em;">
                                        <input type="hidden" name="cm_id" value="<?= $contactMessages->cm_id; ?>"/>
                                        <input type="submit" class="inputDiv cBox" name="updateContactMessage" value="Update" style="width:9em; height:4em;"/>
                                    </form>
                                </td>
                                <td>
                                <!-- Delete Message -->
                                    <form action="./deleteContactMessage.php" method="post" style="margin:0;background-color:#562f56;text-align:center;padding:0.5em;font-size:2em;">
                                        <input type="hidden" name="cm_id" value="<?=  $contactMessages->cm_id; ?>"/>
                                        <input type="submit" class="inputDiv cBox" name="deleteContactMessage" value="Delete" style="width:9em; height:4em;"/>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div style="margin:0;background-color:#562f56;text-align:center;padding:1em;font-size:2em;">
                    <a class="inputDiv cBox" style="padding:0.5em;text-decoration:none;color:black;font-size:0.6em;height:2.5em;" href="./addContactMessage.php">Add Contact Message</a>
                </div>
            </div>
        </main>
        <!-- Global Footer -->
        <?php include "php/footer.php"?>
    </body>
</html>