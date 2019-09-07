<?php  session_start(); ?>

<?php 
  include("includes/dbconnect.inc.php");
  include("head.php");
?>

  <title>Travelomatic</title>
  </head>
  <body>
    
  <!--navbar comes here-->
  <?php include("header.php"); ?>

  <!--Modal for new objects comes here-->
  <?php if (isset($_SESSION['admin'])) { include("form.php"); } ?>

  <!--Modal for new users signup comes here-->
  <?php include("signup.php"); ?>

  <!--spare body-->
  <?php 
  if (!(isset($_SESSION['userId']))) { 
  ?>
  <div class="h-100">
    <div class="d-flex flex-column align-items-center mt-5">
    <div class="container">
      <div class="jumbotron text-center">
        <h1 class="display-4">Welcome to Travelomatic!</h1>
        <p class="lead">This is a simple blog, where you can drop your travel information</p>
        <hr class="my-4">
        <p>Sign up, if you dare</p>
        <p>User-Login: marcouser pw: test</p>
        <p>Admin-Login: marco pw: test</p>
        <button class="btn btn-info" type="button" data-toggle="modal" data-target="#signup_user">Signup</button>
      </div>
    </div>
    </div>
  </div>
  <?php
    }
  ?>

  <!--body comes here-->
  <?php if (isset($_SESSION['userId'])) { include("body.php"); } ?>

<!-- Bootstrap scripts comes here -->
<?php include("footer_scripts.php"); ?>
  
  </body>
</html>


    