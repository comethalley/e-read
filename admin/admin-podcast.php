<?php
session_start();

if (!isset($_SESSION['admin_name'])) {
    header("Location:index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Podcasts</title>

    <!-- GOOGLE FONT LINK -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <!-- LINK FOR INCON (FONTAWESOME) -->
    <script src="https://kit.fontawesome.com/86dc2a589d.js" crossorigin="anonymous"></script>

    <!-- Sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CSS TYLES -->
    <link rel="stylesheet" href="css/admin-uploadPodcast-style.css">
    <link rel="stylesheet" href="css/sidebar-style.css">
</head>

<body>
    <main>
        <!-- include sidebar.php-->
        <?php include 'sidebar.php'; ?>
        <div class="main-container">
            <h1> Upload Podcast</h1>


            <form action="../functions/admin-uploadPodcast-function.php" method="POST" enctype="multipart/form-data">

                <input type="file" name="file" accept=".mp4" id="podcast-video" required>
                <input type="text" name="channel" placeholder="podcast channel" required>

                <fieldset>
                    <p>Select categories : </p>

                    <div>
                        <input type="radio" id="science-fiction" name="categories" value="science fiction" required>
                        <label for="science-fiction">Science Fiction</label>
                    </div>

                    <div>
                        <input type="radio" id="fantasy" name="categories" value="fantasy">
                        <label for="fantasy">Fantasy</label>
                    </div>

                    <div>
                        <input type="radio" id="mystery" name="categories" value="mystery">
                        <label for="mystery">Mystery</label>
                    </div>

                    <div>
                        <input type="radio" id="horror" name="categories" value="horror">
                        <label for="horror">Horror</label>
                    </div>

                    <div>
                        <input type="radio" id="adventure" name="categories" value="adventure">
                        <label for="adventure">Adventure</label>
                    </div>

                    <div>
                        <input type="radio" id="romance" name="categories" value="romance">
                        <label for="romance">Romance</label>
                    </div>

                </fieldset>

                <button name="upload-podcast">Submit</button>
            </form>

            <!-- Test if podcasts display works -->
            <h1>Display Podcasts(test)</h1>
            <?php
            include '../includes/autoload-class.php';
            $user = new User();

            $data = $user->displayPodcasts();

            foreach ($data as $row) {
            ?>
                <p><?php echo $row['podcast_name'] ?></p>

                <img src="../functions/uploads/<?php echo $row['podcast_name'] ?>" alt="">


                <video controls width="250">
                    <source src="../functions/uploads/<?php echo $row['podcast_path'] ?>" type="video/mp4">

                    Sorry, your browser doesn't support embedded videos.
                </video>

            <?php
            }
            ?>



        </div>
    </main>


    <!-- SWEET ALERT -->
    <script>
        const windowUrl = window.location.search;
        const url = new URLSearchParams(windowUrl);
        const keyword = url.get('q')

        if (keyword && keyword == "uploadsuccess") {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: "success",
                title: 'Uploaded Succesfully'
            })

        }

        if (keyword && keyword == "largefile") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
            })
        }
    </script>

    <!-- SCRIPT -->
    <script src="js/sidebar-script.js"></script>

</body>

</html>