<?php

use Codesses\php\Models\{Session};

require_once "./php/Models/Session.php";

// Get the session object.
$session = Session::getInstance();

// If the user is not logged in, redirect to the login page.
if (!$session->hasUser()) {
    header("Location: login.php");
    exit;
}

use Codesses\php\Models\{DatabaseTwo, Password};

require "./php/Models/Crudpassword.php";
require "./php/Models/DatabaseTwo.php";

if (isset($_POST['deletebutton'])) {
    $id = $_POST['url_id'];
    $db = DatabaseTwo::getDb();

    $s = new Password();
    $count = $s->deletePassword($id, $db);
    if ($count) {
        header("Location: listPasswords.php");
        exit;
    } else {
        echo " problem deleting";
    }
}
