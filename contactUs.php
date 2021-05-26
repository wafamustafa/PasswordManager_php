<!DOCTYPE html>
<html>
    <head>
        <!--global head.php-->
        <?php include "php/head.php" ?>
        <title>Pass**** Manager Contact Us</title>
        <link rel="stylesheet" href="./css/contact.css">
        <script src="./js/script.js" async defer></script>
    </head>
    <body>
      <!--main nav-->
      <?php include 'php/header.php' ?>
        <main>
        <div class="mainDiv">

          <div class="content">
            <h2>Contact Us</h2>
            <p>If you have any questions about the Password Manager, feel free to contact us!</p>
            <div class="formDiv" id="contactForm">
              <form action="./addContactMessage.php" method="POST">
                <div class="inputDiv" id="contactInputDiv">
                  <label for="name">Name </label>
                  <input type="text" id="first_name" name="first_name" value="" >
                  <span></span>
                </div>
                <div class="inputDiv" id="contactInputDiv1">
                  <label for="email">Email</label>
                  <input type="text"  id="email" name="email" value="" >
                  <span></span>
                </div>
                  <div class="inputDiv" id="contactInputDiv2">
                <label for="message">Message</label>
                <textarea name="message" id="message1" style="height:10em;" placeholder="Enter Message..."></textarea>
                <span></span>
                  </div>
                <div class="inputDiv" id="contactInputDiv3">
                <button type="submit" name="addContactMessage" id="submitBtn">Submit</button>
              </div>
              </form>
            </div>
          </div>
      </div>
    </main>
<!--global footer-->
<?php include "php/footer.php"?>
  </body>
</html>


