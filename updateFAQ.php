<?php

use Codesses\php\Models\{DatabaseTwo, FAQ};

require "./php/Models/FAQ.php";
require "./php/Models/DatabaseTwo.php";

$question = $answer = "";

if (isset($_POST['updateFAQ'])) {
  $id = $_POST['faq_id'];
  $db = DatabaseTwo::getDb();

  $f = new FAQ();
  $faq = $f->getFAQById($id, $db);

  $question =  $faq->question;
  $answer = $faq->answer;
}
if (isset($_POST['updFAQ'])) {
  $question = $_POST['question'];
  $answer = $_POST['answer'];
  $id = $_POST['faq_id'];

  $db = DatabaseTwo::getDb();
  $f = new FAQ();
  $count = $f->updateFAQ($id, $question, $answer, $db);

  if ($count) {
    header('Location:  listFAQ.php');
    exit;
  } else {
    echo "problem";
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <!--global head.php-->
  <?php include "php/head.php" ?>
  <title>Pass**** Manager FAQ</title>
  <link rel="stylesheet" href="css/FAQ.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="./js/script.js" async defer></script>
</head>

<body>
  <!--main nav-->
  <?php include 'php/header.php' ?>
  <main>
    <div class="mainDiv">
      <div class="content">
        <h2 class="hidden">Update FAQ</h2>
        <div id="FAQForm" class="formDiv2">
          <form name="addFAQForm" action="" method="POST">
            <input type="hidden" name="faq_id" value="<?= $id; ?>" />
            <div class="inputDiv">
              <label for="faq_question">Question</label>
              <input type="text" name="question" id="question" value="<?= $question; ?>" />
            </div>
            <div class="inputDiv">
              <label for="faq_answer">Answer</label>
              <input type="text" name="answer" id="answer" value="<?= $answer; ?>" />
            </div>
            <div class="inputDiv">
              <input type="submit" name="updFAQ" value="Submit" />
            </div>
            <a href="./listFAQ.php" class="backLink">Back to FAQ</a>
          </form>
        </div>
      </div>
    </div>
  </main>
  <!--global footer-->
  <?php include "php/footer.php" ?>
</body>

</html>