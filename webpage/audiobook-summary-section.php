<?php
session_start();

if (!isset($_SESSION['id'])) {
  header("Location:user-login.php");
} else {
  include '../includes/autoload-class.php';
  include 'view-functions.php';
  $user = new User();
}

if (isset($_GET['categories-value'])) {
  $value = $_GET['categories-value'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/sections.css">
  <link rel="stylesheet" href="css/transitions.css">
  <link rel="stylesheet" href="css/box.css">
  <link rel="stylesheet" href="css/footer.css">
  <title>Audiobook</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <style>
    .hide {
      display: none;
    }

    .categories-hidden {
      text-transform: capitalize;
    }
  </style>
</head>

<body>
  <header>
    <div class="container">
      <?php
      if (isset($_SESSION['first-name']) && isset($_SESSION['last-name']) && isset($_SESSION['email'])) {

      ?>
        <a href="UserProf.html" id="account-name">
          <p>Hi, <?php echo $_SESSION['first-name'] ?> <?php echo $_SESSION['last-name'] ?></p>
        </a>

        <img src="<?php echo $_SESSION["profile"] ?>" alt="" class="user-image">
      <?php
      }
      ?>
    </div>
  </header>
  <nav class="navbar sticky-top navbar-expand-lg navbar-dark mx-0 w-100" style="background-color: #485665;">
    <a class="navbar-brand" href="books-section.php">
      <img src="img/ribrary-logo-white.png" width="50" height="50" class="d-inline-block" alt="logo.png">
      Ribrary
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav ml-3 mr-auto mt-2 mt-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="books-section.php">Ebook</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="audiobook-section.php">Audiobook</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="podcast-section.php">Podcast</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="document-section.php">Research Document</a>
        </li>

      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search">
        <button class="btn btn btn-outline-light my-2 my-sm-0 mr-5" type="submit">Search</button>
      </form>
  </nav>



  <main>
    <!--<div class="backdrop">
    <button class="upbtn" onclick="window.location.href='upload-audiobook-section.php'">Upload your own audiobook here!</button>
    <center>-->
    <!--  <button type="button" class="btn">Add Forum</button></p> -->
    </center>
    <main>
        <div class="container1 mx-auto my-5">
            <div class="row my-3">
                <div class="col-md-3 mx-auto">
                <img src="img/aerol.jpg" class="img-thumbnail" alt="cover" style = "width:400px; height:300px;">
                </div>
            </div>
            <div class="row">
                <div class="col-md-9 mx-auto">
                    <div class="card" style="width: 100%">
                        <div class="card-body">
                            <h5 class="card-title">Audiobook title</h5>
                            <p class="card-text">Synopsis: This audiobook is all about Hakdog</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Ratings</li>
                            <li class="list-group-item">Author: Author_name</li>
                            <li class="list-group-item">Genre: </li>
                            <li class="list-group-item">Narrated by: Narrator_name</li>
                        </ul>
                        <div class="card-body">
                            <a href="#" class="btn btn-primary">Start Reading</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
    </main>
  </main>


  <center>
    <footer class="site-footer">
      <h6>Ribrary</h6>
      <ul class="footer-links">
        <li><a href="">About Us</a></li>
        <li><a href="">Contacts</a></li>
        <li><a href="">Help & Support</a></li>
        <h6>‎© Ribrary 2022. All Rights Reserve</h6>
      </ul>
      </div>
      </div>
      </div>
      </div>
      </div>
      </div>
    </footer>
    <!-- SCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>

</html>