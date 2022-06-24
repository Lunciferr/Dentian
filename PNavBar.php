<!doctype html>
<html lang="en">

<head>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        .logoutBtn {
            float: right;
        }
    </style>
</head>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #464545;">
    <div class="container-fluid">
        <?php
        switch ($_SESSION['Status']) {
            case "Active":
                echo
                '
                <a class="navbar-brand pe-3" href="PatientDashboard.php">
                    <img src="img/logo1.png" alt="" width="275" height="70">
                </a>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <div class="navbar-nav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <form method="POST">
                                    <button class="btn mt-3" name="allRecords"><a class="nav-link active text-white h3" aria-current="page">Home</a></button>
                                </form>
                
                        </ul>
                    </div>
                </div>
                ';
                break;
        }
        ?>
        <div class="pe-3">
            <?php
            if (isset($_SESSION['Name'])) {
                echo '<label for="floatingInput" style="font-size: 24px; color: white;">Welcome, ' . $_SESSION['Name'] . '</label>';
            }
            ?>
        </div>
        <div class="logoutBtn">
            <button class="btn btn-secondary" type="submit" name="logout" onclick="location.href = 'Logout.php';">Logout!</button>
        </div>
    </div>
</nav>