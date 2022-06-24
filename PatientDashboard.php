<?php
ob_start();
session_start();
include 'db_connection.php';
require_once('PNavBar.php');
$connect = new PDO("mysql:host=localhost;dbname=fyp", "root", "");
if (!isset($_SESSION['Patient_ID']) && empty($_SESSION['Patient_ID'])) {
    
    header("Location: index.php");
} else {
    if (!isset($_SESSION['patients']) && empty($_SESSION['patients'])) {
        $ID = $_SESSION['Patient_ID'];
        $db = new DB_Connect();
        $stmt = $db->connect()->prepare("SELECT * FROM patient_profile where Patient_ID = $ID");
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    } else {
        $patients = $_SESSION['patients'];
    }
}
if (isset($_POST["update"])) {
    $Email = $_POST['Email'];
    $PNum = $_POST['PNum'];
    $Address = $_POST['Address'];


    $stmt = $db->connect()->prepare("UPDATE `patient_profile` set `Email` = '$Email', `Phone_Num` = 
    '$PNum', `Address` = '$Address' where `Patient_ID` = $ID");
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        echo '<meta http-equiv="refresh" content="1">';
        echo "<span class='d-block p-2 bg-success text-white text-center'>Record successfully updated!</span>";
        return true;
    } else {
        return false;
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


        <h1> <b> My Information</b></h1>
        <?php
        foreach ($patients as $patients) {
        ?>
            <form class="row g-3" method="POST">
                <div class="col-md-3">
                    <label class="form-label">First Name</label>
                    <input type="email" readonly class="form-control" id="FName" value="<?php echo $patients['First_Name']; ?>">
                </div>
                <div class="col-3">
                    <label class="form-label">Last Name</label>
                    <input type="email" readonly class="form-control" id="LName" value="<?php echo $patients['Last_Name']; ?>">
                </div>
                <br><br>
                <div class="col-md-6">

                </div>
                <div class="col-md-3">
                    <label class="form-label">NRIC</label>
                    <input type="email" readonly class="form-control" id="NRIC" value="<?php echo $patients['NRIC_PNum']; ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Birth date</label>
                    <input type="date" readonly class="form-control" name="Date" id="Date" value="<?php echo $patients['Birth_Date']; ?>">
                </div>
                <div class="col-md-6">
                </div>
                <div class="col-3">
                    <label class="form-label">Nationality</label>
                    <input type="email" readonly class="form-control" id="Nationality" value="<?php echo $patients['Nationality']; ?>">
                </div>
                <div class="col-md-3">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control" Name="Email" id="Email" value="<?php echo $patients['Email']; ?>">
                </div>
                <div class="col-md-6">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Family ID</label>
                    <input type="text" readonly class="form-control" id="Password" value="<?php echo $patients['Family_ID']; ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Phone number</label>
                    <input type="text" class="form-control" name="PNum" id="PNum" value="<?php echo $patients['Phone_Num']; ?>">
                </div>
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control" name="Address" id="Address" value="<?php echo $patients['Address']; ?>">
                </div>
            <?php
        }
            ?>
            <button type="submit" onclick = 'refreshPage()' class="btn btn-primary" name="update">Edit</button>
            </form>


    </div>


</body>

</html>
<script>
    function refreshPage() {
        window.location.reload();
    }
</script>