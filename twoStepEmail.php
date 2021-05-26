<?php
/*use Codesses\php\Models\{DatabaseTwo, Codes};

require "./php/Models/twoStepCode.php";
require "./php/Models/DatabaseTwo.php";

$t = new Codes();

if (isset($_POST['submit'])) {

  $email = $_POST['email'];

  $db = DatabaseTwo::getDb();
  $s = new Codes();
  $t = $s->getIdByEmail($email, $db);

  if ($t) {
    header("Location:twoStep.php");
    exit;
  } else {
    echo "Problem finding email";
  }
}*/
?>

<!DOCTYPE html>
<html>

<head>
  <!--global head.php-->
  <?php include "php/head.php" ?>
  <title>Pass**** Manager</title>
  <link rel="stylesheet" href="./css/twoStepEmail.css">

</head>

<body>
  <!--main nav-->
  <?php include 'php/header.php' ?>
  <main>
    <div class="mainDiv">
      <!--side nav-->
      <!-- YOUR STUFF GOES HERE-->
      <div class="content">
        <div class="headings">
          <h2>Two Step Verification</h2>
          <p>Please enter your email</p>
        </div>
        <form action="#" method="POST" class="twostepform">
        <?php if (isset($error)) : ?>
        <p class='error'><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
          <div class="inputDiv">
            <label>First Name:</label>
            <input type="text" class="twostepbar" name="first_name" value="<?php echo htmlspecialchars($first_name);?>"><br>
          </div>
          <div class="inputDiv">
            <label>Last Name:</label>
            <input type="text" class="twostepbar" name="last_name" value="<?php echo htmlspecialchars($last_name);?>"><br>
          </div>
          <div class="inputDiv">
            <label>E-Mail:</label>
            <input type="text" class="twostepbar" name="email" value="<?php echo htmlspecialchars($email);?>"><br>
          </div>
          <div class="inputDiv">
            <input type="submit" name="action" value="Submit" />
            <input type="submit" name="action" value="Reset" /><br>
          </div>
        </form>
      </div>
  </main>
  <!--global footer-->
  <?php include "php/footer.php" ?>
</body>

</html>