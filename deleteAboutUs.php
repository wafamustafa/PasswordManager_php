<?php
//File created by Wafa 04/2021
use Codesses\php\Models\{DatabaseTwo, AboutUs};

require "./php/Models/AboutUs.php";
require "./php/Models/DatabaseTwo.php";

if (isset($_POST['au_id'])) {
    $au_id = $_POST['au_id'];
    $db = DatabaseTwo::getDb();

    $au = new AboutUs();
    $deleteAbout = $au->deleteAboutus($au_id, $db);
    if ($deleteAbout) {
        header("Location:listAboutUs.php");
        exit;
    } else {
        echo "There was an Issue Deleting the Member";
    }
}
