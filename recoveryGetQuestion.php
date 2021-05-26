<?php

// File created by Barbara Cam 2021/04.

use Codesses\php\Models\{DatabaseTwo, Recovery};

require "./php/Models/Recovery.php";
require "./php/Models/DatabaseTwo.php";

$recovery ="";
$question ="";
$answer = "";

//get email from the user
  if(isset($_POST['email'])){
    $email= $_POST['twostepbar'];    
      $db = DatabaseTwo::getDb();
      $r = new recovery();
      $recovery = $r->getSqByEmail($email, $db);      
      $question = $recovery->question;
      $answer = $recovery->answer;
          
  }
  //Verify answer match the database records
    
  if(isset($_POST['validateRecovery'])){
      $email= $_POST['email'];          
      $db = DatabaseTwo::getDb();
      $answer2 =$_POST['answer2'];
      $r = new recovery();
      $recovery = $r->getSqByEmail($email, $db);    
      $answer = $recovery->answer;

      if($answer === $answer2){
        header('Location: recoveryNewPassword.php');
        exit;
      } else if ($answer !== $answer2) {
        header('Location: recoveryWrongPassword.php');
      }    
      
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <!--global head.php-->
    <?php include "php/head.php" ?>
    <title>Pass**** Manager Recovery Create and update</title>
    <link rel="stylesheet" href="./css/recoveryInformation.css">
    <script src="./js/script.js" async defer></script>
  </head>
  <body>
    <!--main nav-->
    <?php include 'php/header.php' ?>
    <main>
      <div class="mainDiv">      
        <!-- YOUR STUFF GOES HERE-->
        <div class="content">
          <div>
            <h2 class="hidden">Recovery Information</h2>
            <div class="formDiv">
              <form action="" method="POST">               
                <h2>Recovery Questions</h2>
                <div name="question"><?= $question ?></div>                
                <input type="text" class="hidden" name="email" value="<?= $email?>">
                <div class="inputDiv">
                 <label for="answer2">Answer</label>
                 <input type="text" name="answer2" id="answer2" />
                </div>                       
                <div class='bt'>
                  <a href="./recoveryQuestionEmail.php" id="btn_back" class="backLink">Back</a>
                  <button type="submit" name="validateRecovery" id="btn-submit" class="backLink">Send</button>
                </div> 
              </form>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!--global footer-->
    <?php include "php/footer.php"?>
  </body>
</html>