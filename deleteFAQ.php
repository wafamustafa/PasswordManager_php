<?php

use Codesses\php\Models\{DatabaseTwo, FAQ};

require "./php/Models/FAQ.php";
require "./php/Models/DatabaseTwo.php";

if (isset($_POST['faq_id'])) {
    $id = $_POST['faq_id'];
    $db = DatabaseTwo::getDb();

    $s = new FAQ();
    $count = $s->deleteFAQ($id, $db);
    if ($count) {
        header("Location: listFAQ.php");
        exit;
    } else {
        echo " problem deleting";
    }
}
