<?php

use Codesses\php\Models\{DatabaseTwo, FAQ};

require "./php/Models/FAQ.php";
require "./php/Models/DatabaseTwo.php";

$f = new FAQ();

if (isset($_POST['addFAQ'])) {

  $question = $_POST['question'];
  $answer = $_POST['answer'];

  $db = DatabaseTwo::getDb();
  $s = new FAQ();
  $f = $s->addFAQ($question, $answer, $db);

  if ($f) {
    header("Location:listFAQ.php");
    exit;
  } else {
    echo "Problem adding FAQ";
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <!--global head.php-->
  <?php //include "php/head.php" 
  ?>
  <title>Pass**** Manager FAQ</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/FAQ.css">
  <script src="./js/script.js" async defer></script>
</head>

<body>
  <!--main nav-->
  <?php include 'php/header.php' ?>
  <main>
    <div class="mainDiv">
      <div class="content">
        <h2 class="hidden">Add FAQ</h2>
        <div id="FAQForm" class="formDiv2">
          <form name="addFAQForm" action="" method="POST">
            <div class="inputDiv">
              <label for="faq_question">Question</label>
              <input type="text" name="question" id="question" value="" />
            </div>
            <div class="inputDiv">
              <label for="faq_answer">Answer</label>
              <input type="text" name="answer" id="answer" value="" />
            </div>
            <div class="inputDiv">
              <input type="submit" name="addFAQ" value="Submit" />
            </div>
            <div id="backtoFaq">
              <a href="./listFAQ.php" class="backLink">Back to FAQ</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
  <!--global footer-->
  <?php include "php/footer.php" ?>
</body>

</html>