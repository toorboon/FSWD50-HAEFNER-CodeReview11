
<nav class="sticky-top navbar bg-site-greennav ">
  <div class="w-100">  
    <div class="d-flex justify-content-between">
      <div class="d-flex">
      	<a class="navbar-brand text-dark" href="index.php"><i class="fas fa-globe text-dark mx-1"></i>New Travelomatic</a>
        <!-- Links -->
<?php
  if (isset($_SESSION['userId'])) {
?>        
        <ul class="navbar-nav d-inline">
          <!-- Dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark" href="#" id="navbardrop" data-toggle="dropdown">
              Filter
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="restaurants.php">Restaurants</a>
              <a class="dropdown-item" href="events.php">Events</a>
              <a class="dropdown-item" href="sights.php">Sights</a>
              <?php if (isset($_SESSION['admin'])) { echo '<a class="dropdown-item" id="register_button"   data-toggle="modal" data-target="#register_form">New Location</a>';} ?>
            </div>
            
          </li>
        </ul>
<?php
  }
?>  
      </div>
      
      <div class="d-flex flex-grow-1">
<?php
  if (isset($_SESSION['userId'])) {
?> 
        <!-- This is for the search bar -->
        <input id="search_text" class="form-control mx-3" name="search_text" type="search" placeholder="Search by name of Sight, Restaurant or Event" aria-label="Search">
<?php
  }
?> 
      </div>
<?php
  if (isset($_SESSION['userId'])) {
?>           
      <div class="d-flex">  
        <button id="logout" class="btn btn-outline-success mx-1" type="submit" name="logout-submit">Logout</button>
      </div>  
<?php
  }
?> 
        
<?php
  if (!(isset($_SESSION['userId']))) {
?>       
        <div class="d-flex">
          <div>
            <?php 
              $login = '';
              
              if (isset($_GET['error'])){
                if ($_GET['error'] == "sqlerror") {
                  echo "<p class='text-danger my-auto'>SQL Error!</p>";
                  if (isset($_GET['uid'])){
                    $login = $_GET['uid'];
                  }

                } else if ($_GET['error'] == "wrongpwd"){
                  echo "<p class='text-danger  my-auto'>Password is wrong!</p>";  
                  if (isset($_GET['uid'])){
                    $login = $_GET['uid'];
                  }

                } else if ($_GET['error'] == "nouser"){
                  echo "<p class='text-danger my-auto'>There is no user with this username!</p>";
                }
              }
            ?>
          </div>
          <form class="d-flex form" action="includes/login.inc.php" method="POST" accept-charset="utf-8">
            <input class="mx-1" type="text" name="mailuid" placeholder="Username/E-Mail..." value="<?php if($login){echo $login;} ?>">
            <input class="mx-1" type="password" name="pwd" placeholder="Password...">
            <button class="btn btn-outline-success mx-1" type="submit" name="login-submit">Login</button>
          </form>
       <!--  <div class="g-signin2" data-onsuccess="onSignIn">Google</div> -->
      </div> 
<?php
  }
?>   
    </div><!--main d-flex-->
  </div><!--w100 mainbar-->  
</nav>
