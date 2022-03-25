<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location:admin-login.php");
} else {
    include_once '../functions/functions.php';
    include_once '../functions/database.php';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USERS</title>

    <!-- GOOGLE FONT LINK -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- LINK FOR INCON (FONTAWESOME) -->
    <script defer src="https://kit.fontawesome.com/86dc2a589d.js" crossorigin="anonymous"></script>

    <!-- CSS TYLES -->
    <link rel="stylesheet" href="admin-user-style.css">
    <link rel="stylesheet" href="sidebar-style.css">
</head>

<body>
    <main>
        <!-- include sidebar.php-->
        <?php include 'sidebar.php'; ?>

        <div class="main-container">

            <!-- Display User from database -->
            <div class="table-container">
                <h1>User's list</h1>

                <table class="table">
                    <thead>
                        <tr class="table-header">
                            <th scope="col">No.</th>
                            <th scope="col">User ID</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody class="action">
                        <?php
                        $data = displayUser($connect);
                        $count = 1;
                        foreach ($data as $row) {
                        ?>
                            <tr>
                                <td> <?php echo $count ?></td>
                                <td> <?php echo $row["User_id"] ?></td>
                                <td> <?php echo $row["firstname"] ?></td>
                                <td> <?php echo $row["lastname"] ?></td>
                                <td> <?php echo $row["Username"] ?></td>
                                <td> <?php echo 'active' ?></td>
                                <td><i class="fa fa-solid fa-pen editbtn"></i>
                                    <i class="fa fa-solid fa-trash deletebtn"></i>
                                </td>
                            </tr>
                        <?php
                            $count++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>


            <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
            <div class="modal   fade" id="deletemodal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> Delete Student Data </h5>
                            <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <!--will redirect to admin-deleteUser-function.php-->
                        <form action="../functions/admin-deleteUser-function.php" method="POST">

                            <!-- DISPLAY -->
                            <div class="modal-body">
                                <input type="hidden" name="user_id" id="user_id">

                                <p> Do you want to Delete this Data?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                                <button type="submit" name="deleteData" class="btn btn-primary"> Confirm </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <!--  EDIT POP UP FORM (Bootstrap MODAL)-->
            <div class="modal   fade" id="editModal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> Delete Student Data </h5>
                            <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <!--  -->
                        <form action="" method="">.
                            <!-- DISPLAY -->
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input class="form-control" type="text" placeholder="Default input">


                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>

                                </div>
                                <p>sadsadasdas</p>
                                <p>sadsadasdas</p>
                                <p>sadsadasdas</p>
                                <p>sadsadasdas</p>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                                <button type="submit" name="deleteData" class="btn btn-primary"> Confirm </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </main>


    <!-- BOOTSTRAP JS PLUGIN -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <!-- SCRIPT FOR DELETE AND EDIT POP UP MODAL -->
    <script>
        //get action class
        const action = document.querySelector(".action");
        
        //if button clicked is "delete"
        action.addEventListener('click', function(e) {
            if (e.target.classList.contains('deletebtn')) {
                $('#deletemodal').modal('show');

                const tr = e.target.closest('tr');

                const data = tr.children;

                const number = data.item(1).innerHTML;
                const inputId = document.querySelector('#user_id');

                inputId.value = number
                console.log(number, inputId)

            }
        })

         //if button clicked is "edit"
        action.addEventListener('click', function(e) {
            if (e.target.classList.contains('editbtn')) {
                $('#editModal').modal('show');


            }
        })
    </script>

    <script src="sidebar-script.js"></script>
</body>

</html>