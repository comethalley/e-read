<?php
session_start();

if (!isset($_SESSION['id'])) {
  header("Location:user-login.php");
} else {
  include '../includes/autoload-class.php';
  include 'view-functions.php';
  $user = new User();
  $userData = $user->emailExist($_SESSION['email']);
}

// dropdown
if (isset($_GET['categories-value'])) {
  $value = $_GET['categories-value'];
}

//Search
if (isset($_GET['search-podcast'])) {
  $searchInput = $_GET['search-podcast'];
  $searchData = $user->searchPodcast($searchInput);
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
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <title>Podcast</title>

  <!-- sweet alert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- BOOTSTRAP ICON -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

  <style>
    .hide {
      display: none;
    }

    .capitalize {
      text-transform: capitalize;
    }

    .view-message {
      color: red;
    }

    .view-message:hover {
      text-decoration: underline;
    }

    .navbar {
      z-index: 1;
    }
  </style>
</head>

<body>
  <!-- HEADER -->
  <?php include 'header.php' ?>

  <nav class="navbar sticky-top navbar-expand-lg navbar-dark mx-0 w-100" style="background-color: #485665;">
    <a class="navbar-brand" href="ebook-section.php">
      <img src="img/ribrary-logo-white.png" width="50" height="50" class="d-inline-block" alt="logo.png">
      Ribrary
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav ml-3 mr-auto mt-2 mt-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="ebook-section.php">Ebook</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="audiobook-section.php">Audiobook</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="podcast-section.php">Podcast<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="document-section.php">Research Document</a>
        </li>

      </ul>
      <form action="" method="get" class="form-inline my-2 my-lg-0">

        <input type="text" class="form-control mr-sm-2" placeholder="Search Podcast" name="search-podcast">
        <button class="btn btn btn-outline-light my-2 my-sm-0 mr-5" type="submit">Search</button>
      </form>
  </nav>
  </div>

  <!----- DROPDOWN CATEGORIES -->
  <div class="dropdown my-3 mx-3 float-right">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
      Categories
    </button>

    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
      <form action="" method="get" class="categories-form">
        <input type="hidden" name="categories-value" id="categories-value">

        <option class="dropdown-item text-dark" value="science fiction">Science Fiction</option>
        <option class="dropdown-item text-dark" value="fantasy">Fantasy</option>
        <option class="dropdown-item text-dark" value="mystery">Mystery</option>
        <option class="dropdown-item text-dark" value="horror">Horror</option>
        <option class="dropdown-item text-dark" value="adventure">Adventure</option>
        <option class="dropdown-item text-dark" value="romance">Romance</option>
      </form>
    </div>
  </div>

  <!-- -------------------------->
  <main>
    <!--<div class="backdrop">
    <button class="upbtn" onclick="window.location.href='upload-audiobook-section.php'">Upload your own audiobook here!</button>
    <center>-->
    <!--  <button type="button" class="btn">Add Forum</button></p> -->
    </center>
    <main>
      <div class="container1 mx-2 my-5">

        <div class="newly-release categories">
          <div class="row">
            <div class="col-md-12">
              <h6 class=" display-4 mx-3">Newly Release</h6>
              <hr>
            </div>
          </div>
          <div class="row mb-3 ml-2">
            <?php
            $data = $user->displayPodcasts();
            foreach ($data as $row) {
            ?>
              <div class="col-2 my-2 mx-0 rounded ">
                <div class="card shadow text-center w-100 h-100">
                  <div>
                    <img src="../functions/uploads/<?php echo $row['podcast_cover_path'] ?>" class="card-img-top" alt="cover" style="width:170px; height:200px">
                  </div>
                  <div class="card-body">
                    <span style="display:inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 13ch;">
                      <p class="card-title" style="font-size:16px; font-weight:bold;"><?php echo $row["podcast_name"] ?></p>
                    </span>
                    <p class="card-text" style="font-size:13px;"><?php echo $row["podcast_host"] ?></p>
                    <?php
                    if ($userData['subscription'] == "subscribed") {
                    ?>
                      <a href="podcast-view.php?file=<?php echo $row["podcast_path"] ?>" class="btn btn-primary">Watch</a>
                    <?php
                    } else {
                    ?>
                      <button class="btn btn-primary showModal">Watch</button>
                    <?php
                    }
                    ?>

                  </div>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
        </div>
        <!-- --------------------------------------- -->
        <div class="most-popular categories">
          <div class="row">
            <div class="col-md-12">
              <h6 class=" display-4 mx-3">Most popular</h6>
              <hr>
            </div>
          </div>

          <div class="row mb-3 ml-2">
            <?php
            $data = $user->displayPodcasts();
            $count = 1;
            foreach ($data as $row) {
            ?>
              <div class="col-2 my-2 mx-0 rounded">
                <div class="card shadow text-center w-100 h-100">
                  <div>
                    <img src="../functions/uploads/<?php echo $row['podcast_cover_path'] ?>" class="card-img-top" alt="cover" style="width:170px; height:200px">
                  </div>
                  <div class="card-body">
                    <span style="display:inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 13ch;">
                      <p class="card-title" style="font-size:16px; font-weight:bold;"><?php echo $row["podcast_name"] ?></p>
                    </span>
                    <p class="card-text" style="font-size:13px;"><?php echo $row["podcast_host"] ?></p>
                    <?php
                    if ($userData['subscription'] == "subscribed") {
                    ?>
                      <a href="podcast-view.php?file=<?php echo $row["podcast_path"] ?>" class="btn btn-primary">Watch</a>
                    <?php
                    } else {
                    ?>
                      <button class="btn btn-primary showModal">Watch</button>
                    <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
        </div>

        <!-- -------------------------------------------- -->
        <div class="might-like categories">
          <div class="row">
            <div class="col-md-12">
              <h6 class=" display-4 mx-3">You might also like</h6>
              <hr>
            </div>
          </div>

          <div class="row mb-3 ml-2">
            <?php
            $data = $user->displayPodcasts('fantasy');
            foreach ($data as $row) {
            ?>
              <div class="col-2 my-2 mx-0 rounded">
                <div class="card shadow text-center w-100 h-100">
                  <div>
                    <img src="../functions/uploads/<?php echo $row['podcast_cover_path'] ?>" class="card-img-top" alt="cover" style="width:170px; height:200px">
                  </div>
                  <div class="card-body">
                    <span style="display:inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 13ch;">
                      <p class="card-title" style="font-size:16px; font-weight:bold;"><?php echo $row["podcast_name"] ?></p>
                    </span>
                    <p class="card-text" style="font-size:13px;"><?php echo $row["podcast_host"] ?></p>
                    <?php
                    if ($userData['subscription'] == "subscribed") {
                    ?>
                      <a href="podcast-view.php?file=<?php echo $row["podcast_path"] ?>" class="btn btn-primary">Watch</a>
                    <?php
                    } else {
                    ?>
                      <button class="btn btn-primary showModal">Watch</button>
                    <?php
                    }
                    ?>
                  </div>
                </div>
              </div>

            <?php
            }
            ?>

            <?php
            $data = $user->displayPodcasts('science fiction');
            foreach ($data as $row) {
            ?>
              <div class="col-2 my-2 mx-0 rounded">
                <div class="card shadow text-center w-100 h-100">
                  <div>
                    <img src="../functions/uploads/<?php echo $row['podcast_cover_path'] ?>" class="card-img-top" alt="cover" style="width:170px; height:200px">
                  </div>
                  <div class="card-body">
                    <span style="display:inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 13ch;">
                      <p class="card-title" style="font-size:16px; font-weight:bold;"><?php echo $row["podcast_name"] ?></p>
                    </span>
                    <p class="card-text" style="font-size:13px;"><?php echo $row["podcast_host"] ?></p>
                    <?php
                    if ($userData['subscription'] == "subscribed") {
                    ?>
                      <a href="podcast-view.php?file=<?php echo $row["podcast_path"] ?>" class="btn btn-primary">Watch</a>
                    <?php
                    } else {
                    ?>
                      <button class="btn btn-primary showModal">Watch</button>
                    <?php
                    }
                    ?>
                  </div>
                </div>
              </div>

            <?php
            }
            ?>
          </div>
        </div>
        <!-- ------------------------------------------ -->
        <div class="categories-hidden hide">
          <div class="row">
            <div class="col-md-12">
              <h6 class=" display-4 mx-3 capitalize"><?php echo $value ?></h6>
              <hr>
            </div>
          </div>
          <div class="row mb-3 ml-2">
            <?php
            $data = $user->displayPodcasts($value);

            if (empty($data)) {
              echo '<h1> No data available </h1>';
            }

            foreach ($data as $row) {
            ?>
              <div class="col-2 my-2 mx-0 rounded">
                <div class="card shadow text-center w-100 h-100">
                  <div>
                    <img src="../functions/uploads/<?php echo $row['podcast_cover_path'] ?>" class="card-img-top" alt="cover" style="width:170px; height:200px">
                  </div>
                  <div class="card-body">
                    <span style="display:inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 13ch;">
                      <p class="card-title" style="font-size:16px; font-weight:bold;"><?php echo $row["podcast_name"] ?></p>
                    </span>
                    <p class="card-text" style="font-size:13px;"><?php echo $row["podcast_host"] ?></p>
                    <?php
                    if ($userData['subscription'] == "subscribed") {
                    ?>
                      <a href="podcast-view.php?file=<?php echo $row["podcast_path"] ?>" class="btn btn-primary">Watch</a>
                    <?php
                    } else {
                    ?>
                      <button class="btn btn-primary showModal">Watch</button>
                    <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
        </div>

        <!--------------------------------------------------------------------------- -->
        <!-- SEARCH DISPLAY -->
        <div class="search-hidden hide">
          <div class="row">
            <div class="col-md-12">
              <h6 class=" display-4 mx-3 ">Searched: <?php echo $searchInput ?></h6>
              <hr>
            </div>
          </div>
          <div class="row mb-3 ml-2">
            <?php

            foreach ($searchData as $row) {
            ?>

              <div class="col-2 my-2 mx-0 rounded">
                <div class="card shadow text-center w-100 h-100">
                  <div>
                    <img src="../functions/uploads/<?php echo $row['podcast_cover_path'] ?>" class="card-img-top" alt="cover" style="width:170px; height:200px">
                  </div>
                  <div class="card-body">
                    <span style="display:inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 13ch;">
                      <p class="card-title" style="font-size:16px; font-weight:bold;"><?php echo $row["podcast_name"] ?></p>
                    </span>
                    <p class="card-text" style="font-size:13px;"><?php echo $row["podcast_host"] ?></p>
                    <?php
                    if ($userData['subscription'] == "subscribed") {
                    ?>
                      <a href="podcast-view.php?file=<?php echo $row["podcast_path"] ?>" class="btn btn-primary">Watch</a>
                    <?php
                    } else {
                    ?>
                      <button class="btn btn-primary showModal">Watch</button>
                    <?php
                    }
                    ?>
                  </div>
                </div>
              </div>

            <?php
            }
            ?>
          </div>
        </div>
        <!-- ---------------------------------------------------------------------- -->

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
        <h6>‎© Ribrary 2020. All Rights Reserve</h6>
      </ul>
      </div>
      </div>
      </div>
      </div>
      </div>
      </div>

      <!-- SCRIPT -->
      <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
      <script src="js/header.js"></script>
      <script>
        const categories = document.querySelectorAll('.categories');
        const categoriesForm = document.querySelector('.categories-form')
        const dropdownMenu = document.querySelector('.dropdown-menu');
        const categoriesValue = document.querySelector('#categories-value');
        const showModal = document.querySelector('body')

        const url = window.location.search
        const urlParam = new URLSearchParams(url)
        const parameter = urlParam.get('categories-value') //GET URL FOR DROPDOWN CATEGORIES
        const searchPodcast = urlParam.get('search-podcast') //GET URL FOR SEARCH

        const hideCategories = function() {
          categories.forEach(section => {
            section.classList.add('hide')
          })
        }

        //CATEGORIES
        if (parameter) {
          hideCategories()
          document.querySelector('.categories-hidden').classList.remove('hide')
        }

        // SEARCH EBOOKS
        if (searchPodcast) {
          hideCategories()
          document.querySelector('.search-hidden').classList.remove('hide')
        }

        dropdownMenu.addEventListener('click', function(e) {
          if (e.target.classList.contains('dropdown-item')) {
            const value = e.target.value
            categoriesValue.value = value
            categoriesForm.submit()

          }
        })


        showModal.addEventListener('click', function(e) {
          if (e.target.classList.contains('showModal')) {
            e.preventDefault()

            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: " It looks like you haven't subscribe!",
              footer: '<a href="membership.php">Subscribe now and be a member!</a>'
            })

          }

        })
      </script>

</body>

</html>