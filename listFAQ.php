<?php

use Codesses\php\Models\{DatabaseTwo, FAQ};

require "./php/Models/FAQ.php";
require "./php/Models/DatabaseTwo.php";

$dbcon = DatabaseTwo::getDb();
$f = new FAQ();
$faq =  $f->getFAQ(DatabaseTwo::getDb());

?>
<!DOCTYPE html>
<html>

<head>
    <!--global head.php-->
    <?php include "php/head.php" ?>
    <title>Pass**** Manager FAQ</title>
    <link rel="stylesheet" href="css/FAQ.css">
    <script src="./js/script.js" async defer></script>
</head>

<body>
    <!--main nav-->
    <?php include 'php/header.php' ?>
    <main>
        <div class="mainDiv">
            <!-- YOUR STUFF GOES HERE-->
            <div class="content">
                <h2 id="faqh2">FAQ</h2>
                <ul id="faqlist">
                    <?php foreach ($faq as $qa) { ?>
                        <div class="questionanswersection">
                            <div class="cBox">
                                <li class="faqquestions"><?= $qa['question'] ?></li>
                            </div>
                            <li class="faqanswers"><?= $qa['answer'] ?></li>
                        </div>
                        <div class="formDiv">
                            <div class="inputDiv">
                                <form action="./updateFAQ.php" method="post">
                                    <input type="hidden" name="faq_id" value="<?= $qa['faq_id']; ?>" />
                                    <input type="submit" id="updateFAQ" name="updateFAQ" value="Update" />
                                </form>
                            </div>
                            <form action="./deleteFAQ.php" method="post">
                                <div class="inputDiv">
                                    <input type="hidden" name="faq_id" value="<?= $qa['faq_id']; ?>" />
                                    <input type="submit" id="deleteFAQ" name="deleteFAQ" value="Delete" />
                                </div>
                            </form>
                        </div>
                    <?php } ?>
                </ul>
                <div class="inputDiv">
                    <a href="./createFAQ.php" id="createFAQ" class="backLink">Add FAQ</a>
                </div>
                <div class="inputDiv">
                    <a href="./clientFAQ.php" id="createFAQ" class="backLink">Client FAQ</a>
                </div>
            </div>
        </div>
    </main>
    <!--global footer-->
    <?php include "php/footer.php" ?>
</body>

</html>