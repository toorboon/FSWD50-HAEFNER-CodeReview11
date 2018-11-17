<?php  session_start(); 
if (!(isset($_SESSION['userId']))){
    header("Location: ../index.php");
  } 
?>

<?php 
  
  include("head.php");
?>

  <title>Restaurants</title>
  </head>
  <body>
    
  <!--navbar comes here-->
  <?php include("header.php"); ?>

  <!--Modal for new objects comes here-->
  <?php include("form.php"); ?>

  <!--body comes here-->
  <?php include("body.php"); ?>

  <!-- Bootstrap scripts comes here -->
  <?php include("footer_scripts.php"); ?>

  
  </body>
</html>