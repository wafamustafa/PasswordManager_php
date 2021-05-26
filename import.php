<?php

use Codesses\php\Models\Session;
require_once "./php/Models/Session.php";

// Get the session object.
$session = Session::getInstance();

// If the user is not logged in, load the login page.
if( !$session->hasUser() ) {
  header( "Location: login.php" );
  exit;
}

use Codesses\php\Models\{FH,Url,FP};
require_once "./php/Models/FileHelper.php";
require_once "./php/Models/Url.php";

// Get a url object.
$urlHelper = new Url;

// Set up the error messages array for use later in the html.
$errorMessages = array();
foreach( FH::$inputNames as $input ) {
  $errorMessages[$input] = "";
}

// $params are used in the html below.
$params = Url::getParams( FH::$inputNames );

// See if this is a GET or POST request.
$isPost = FP::isPost( FH::getSubmitName() );

if( $isPost ) {

  // Use the FP to retrieve the values from the form.
  $params = FP::getValuesObject( FH::$inputNames );
  pp( $params );

  $fileInputName = FH::$fileInputName;

  if( isset( $params->$fileInputName ) ) {

    if( FP::isFile( $fileInputName ) ) {

      $csvArray = FP::getUploadedCsv( $fileInputName );

      if( $csvArray != null ) {

        var_dump( $csvArray );

        $userId = $session->getUserId();
        foreach( $csvArray as $row ) {
          if( strcmp( $row[ FH::CSV_ARRAY_INDEX_URL ], "url" ) == 0 ) {
            continue;
          } 
          $urlHelper->createUrl( FH::getUrlParams( $userId, $row ) );
        }

        header( "Location: listPasswords.php" );
        exit;

      } else {
        $errorMessages[$fileInputName] = FH::$errorMessages[FH::ERROR_TYPE_NOT_CSV];
      }

    } else {
      $errorMessages[$fileInputName] = FH::$errorMessages[FH::ERROR_TYPE_FILE_NOT_FOUND];
    }
  
  } else {
    $errorMessages[$fileInputName] = FH::$errorMessages[FH::ERROR_TYPE_NO_FILE_SELECTED];
  }
}
?>


<html>
<head>
  <!--global head.php-->
  <?php include "php/head.php" ?>
  <title>Pass**** Manager Import</title>
  <link rel="stylesheet" href="./css/login.css">
  <script src="./js/import.js"></script>
</head>

<body>
  <!--main nav-->
  <?php include 'php/header.php' ?>
  <main>
    <div class="mainDiv">
      <!--side nav-->
      <?php include 'php/sideNav.php' ?>
      <!-- YOUR STUFF GOES HERE-->
      <div class="content">
        <div>
          <h2>Import Passwords</h2>

          <div class="formDiv">
            <form action="" method="POST" name="<?= FH::$fileFormName ?>" enctype="multipart/form-data">

              <label for="<?= FH::$fileInputName ?>" class="fileInputLabel">Choose a File</label>
                <input class="hidden" id="<?= FH::$fileInputName ?>" name="<?= FH::$fileInputName ?>" type="file" />
                <div class="fileInputDiv" id="<?= FH::$fileInputName ?>Div" name="<?= FH::$fileInputName ?>Div" style="margin-top: 1em;"></div>
              <div class="inputDiv">
                <input type="submit" value="Upload" name="<?= FH::getSubmitName() ?>">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!--global footer-->
  <?php include "php/footer.php" ?>
</body>

</html>