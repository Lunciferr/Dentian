<?php
include 'db_connection.php';

$db = new DB_Connect();
if (isset($_POST["find"])) {
    $email = $_POST["email"];

    $stmt = $db->connect()->prepare("SELECT * FROM `user_table` where `Email` = '$email'");
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $user = $result[0]["First_Name"];
        $password = $result[0]["password"];
        $email = $result[0]["Email"];
        $subject = "Dentian: Forget your password";
        $body = "Dear $user, \r\n \r\nYour password is: $password \r\n\r\nYours Sincerely, \r\nDentian";
        $sender = "From:sender email address here";
        if (mail($email, $subject, $body, $sender)) {
            echo '<meta http-equiv="refresh" content="1">';
            echo "<span class='d-block p-2 bg-success text-white text-center'>Your credentials has been sent to your email!</span>";
        } else {
            echo "<span class='d-block p-2 bg-danger text-white text-center'>Sorry, Please enter a valid email associated with Dentian</span>";
        }
    }
}
if (isset($_POST["find"])) {
    $email = $_POST["email"];

    $stmt = $db->connect()->prepare("SELECT * FROM `patient_profile` where `Email` = '$email'");
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $user = $result[0]["First_Name"];
        $NRIC = $result[0]["NRIC_PNum"];
        $email = $result[0]["Email"];
        $subject = "Dentian: Forget your password";
        $body = "Dear $user, \r\n \r\nYour password is: $NRIC \r\n\r\nYours Sincerely, \r\nDentian";
        $sender = "From:sender email address here";
        if (mail($email, $subject, $body, $sender)) {
            echo '<meta http-equiv="refresh" content="1">';
            
        } else {

        }
    }
}
?>
<style>
    .bd-example {
        position: relative;
        padding: 1rem;
        margin: 1rem -5rem 0;

    }

    .bd-example {
        padding: 1.5rem;
        margin-right: 0;
        margin-left: 0;
        border-width: 5px;

    }

    body {
        background-image: url('img/AdminBackground.png');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #464545;">
    <div class="container-fluid">
                <a class="navbar-brand pe-3" href="index.php">
                    <img src="img/Logo1.png" alt="" width="275" height="70">
                </a>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <div class="navbar-nav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <form method="POST">
                                </form>
                
                        </ul>
                    </div>
                </div>
        <div class="pe-3">
            <?php
            if (isset($_SESSION['Name'])) {
                echo '<label for="floatingInput" style="font-size: 24px; color: white;">Welcome, ' . $_SESSION['Name'] . '</label>';
            }
            ?>
        </div>
    </div>
</nav>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

<html>

<body>
    <div class="bd-example">
        <form method="POST">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Find your password</h3>
                            <p class="card-text">Please enter your email address</p>
                            <div class="col-md-6">
                                <input type="email" required class="form-control" id="email" name="email">
                            </div>
                            <br>
                            <div class="col-6">
                                <button type="submit" name="find" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
<script>
    function showError() {
        if (email.validity.valueMissing) {
            // If the field is empty,
            // display the following error message.
            emailError.textContent = 'You need to enter an e-mail address.';
        } else if (email.validity.typeMismatch) {
            // If the field doesn't contain an email address,
            // display the following error message.
            emailError.textContent = 'Entered value needs to be an e-mail address.';
        } else if (email.validity.tooShort) {
            // If the data is too short,
            // display the following error message.
            emailError.textContent = `Email should be at least ${ email.minLength } characters; you entered ${ email.value.length }.`;
        }

        // Set the styling appropriately
        emailError.className = 'error active';
    }
</script>