<?php
session_start();
// Search
switch ($_SESSION['Role']) {
    case "System Admin":
        if (isset($_POST["searchBtn"])) {
            $empID = $_POST["searchEmpID"];
            $firstName = $_POST['searchFName'];
            $lastName = $_POST['searchLName'];
            $userName = $_POST['searchusername'];
            $nric = $_POST['searchNRIC'];
            $hpnum = $_POST['searchPhone'];
            $dob = $_POST['searchDOB'];
            $role = $_POST['searchRole'];
            $specialisation = $_POST['searchSpecial'];

            $filter = array();
            if($empID != '' || $firstName != '' ||  $lastName != '' || $userName != '' || $nric != '' || $hpnum != '' || $dob != '' || $role != '' || $specialisation !=''){
                if ($empID != '') {
                    $filter[] = 'Emp_ID = "' . $empID . '"';
                }
                if ($firstName != '') {
                    $filter[] = 'First_Name = "' . $firstName . '"';
                }
                if ($lastName != '') {
                    $filter[] = 'Last_Name = "' . $lastName . '"';
                }
                if ($userName != '') {
                    $filter[] = 'username = "' . $userName . '"';
                }
                if($nric != '') {
                    $filter[] = 'NRIC_PNum LIKE "' . $nric .'%"';
                }
                if($hpnum != '') {
                    $filter[] = 'Phone_Num LIKE "' . $hpnum .'%"';
                }
                if($dob != '') {
                    $filter[] = 'Birth_Date LIKE "' . $dob .'%"';
                }
                if($role != ''){
                    $filter[] = 'Role LIKE "' . $role . '%"';
                }
                if($specialisation != ''){
                    $filter[] = 'Specialization LIKE "' . $specialisation . '%"';
                }
                $db = new DB_Connect();
                $stmt = $db->connect()->prepare("SELECT * from user_table where " . implode(" AND ", $filter));
                $stmt->execute();
                if($stmt->rowCount()==0){
                    $_SESSION['errorMsg'] = '<div class="d-block p-2 alert alert-danger bi-exclamation-triangle-fill text-center" role="alert"> No results found!</div>';
                    $_SESSION['temp'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $_SESSION['rowCount'] = 0;

                }
                else {
                    $_SESSION['temp'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $_SESSION['errorMsg'] = '';
                    $_SESSION['rowCount'] = $stmt->rowCount();
                    // print_r($rowCount); 
                }
            }
        }
        break;
    case "Dentist":
            if (isset($_POST["searchBtn"])) {
                $recID = $_POST["searchRecID"];
                $patID = $_POST["searchPatID"];
                $firstName = $_POST["searchFName"];
                $lastName = $_POST["searchLName"];
                $visit = $_POST["searchDOV"];
                $services = $_POST["searchService"];
                $materials = $_POST["searchMaterials"];
                $allergies = $_POST["searchAllergies"];
                $patID1 = $_POST['searchPatID1'];
                $firstName1 = $_POST["searchFName1"];
                $lastName1 = $_POST["searchLName1"];

                $filter = array();

                
                if($recID != '' || $patID != '' || $firstName != '' ||  $lastName != '' || $visit != '' || $services != '' || $materials != ''){
                    if($recID != ''){
                        $filter[] = 'patient_record.Record_ID = "' . $recID . '"';
                    }
                    if($patID != ''){
                        $filter[] = 'patient_record.Patient_ID = "' . $patID . '"';
                    }
                    if($firstName != ''){
                        $filter[] = 'patient_profile.First_Name = "' . $firstName . '"';
                    }
                    if($lastName != ''){
                        $filter[] = 'patient_profile.Last_Name = "' . $lastName . '"';
                    }
                    if($visit != ''){
                        $filter[] = 'patient_record.Treatment_Date = "' . $visit . '"';
                    }
                    if($services != ''){
                        $filter[] = 'patient_record.Treatment_type LIKE "' .'%' . $services . '%"';
                    }
                    if($materials !=''){
                        $filter[] = 'patient_record.Material_used LIKE "' . '%' . $materials . '%"';
                    }
                    $db = new DB_Connect();
                    $stmt = $db->connect()->prepare("SELECT patient_profile.First_Name, patient_profile.Last_Name, patient_record.* FROM `patient_record` right join patient_profile on patient_record.Patient_ID = patient_profile.Patient_ID
                    where " . implode(" AND ", $filter) . "order by patient_record.Treatment_Date DESC");
                    $stmt->execute();
                    if($stmt->rowCount()==0){
                        $_SESSION['errorMsg'] = '<div class="d-block p-2 alert alert-danger bi-exclamation-triangle-fill text-center" role="alert"> No results found!</div>';
                        $_SESSION['patientrecords'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        $_SESSION['rowCount'] = 0;
        
                    }
                    else {
                        $_SESSION['patientrecords'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        $_SESSION['errorMsg'] = '';
                        $_SESSION['rowCount'] = $stmt->rowCount();
                    }
                }
                else if ($patID1 != '' || $firstName1 != '' ||  $lastName1 != '' || $allergies != '')
                { 
                    if($patID1 != ''){
                        $filter[] = 'patient_profile.Patient_ID = "' . $patID1 . '"';
                    }
                    if($firstName1 != ''){
                        $filter[] = 'patient_profile.First_Name = "' . $firstName1 . '"';
                    }
                    if($lastName1 != ''){
                        $filter[] = 'patient_profile.Last_Name = "' . $lastName1 . '"';
                    }
                    if($allergies != ''){
                        $filter[] = 'patient_profile.Allergies = "'. $allergies . '"';
                    }
                    $db = new DB_Connect();
                    $stmt1 = $db->connect()->prepare("SELECT Patient_ID, First_Name, Last_Name, NRIC_PNum, Gender, Allergies from patient_profile where " . implode(" AND ", $filter));
                    $stmt1->execute();

                    if($stmt1->rowCount()==0){
                        $_SESSION['errorMsg'] = '<div class="d-block p-2 alert alert-danger bi-exclamation-triangle-fill text-center" role="alert"> No results found!</div>';
                        $_SESSION['patients'] = $stmt1->fetchAll(PDO::FETCH_ASSOC);
                        $_SESSION['rowCount'] = 0;
        
                    }
                    else {
                        $_SESSION['patients'] = $stmt1->fetchAll(PDO::FETCH_ASSOC);
                        $_SESSION['errorMsg'] = '';
                        $_SESSION['rowCount'] = $stmt1->rowCount();
                    }
                }
            }
                
            break;
    case "Receptionist":
        if (isset($_POST["searchBtn"])) {
            $patientID = $_POST["searchPatID"];
            $firstName = $_POST['searchFName'];
            $lastName = $_POST['searchLName'];
            $nric = $_POST['searchNRIC'];
            $hpnum = $_POST['searchPhone'];
            $dob = $_POST['searchDOB'];
            $addr = $_POST['searchAddr'];
            $famid = $_POST['searchFam'];
            $filter = array();

            if($patientID != '' || $firstName != '' || $lastName != '' || $nric != '' || $hpnum != '' || $dob != '' ||  $addr != '' || $famid != '' ){
                if($patientID != ''){
                    $filter[] = 'Patient_ID = "' . $patientID . '"';
                }
                if ($firstName != '') {
                    $filter[] = 'First_Name = "' . $firstName . '"';
                }
                if ($lastName != '') {
                    $filter[] = 'Last_Name = "' . $lastName . '"';
                }
                if($nric != '') {
                    $filter[] = 'NRIC_PNum = "' . $nric .'"';
                }
                if($hpnum != '') {
                    $filter[] = 'Phone_Num = "' . $hpnum .'"';
                }
                if($dob != '') {
                    $filter[] = 'Birth_Date LIKE "' . $dob .'%"';
                }
                if($addr != '') {
                    $filter[] = 'Address LIKE "' . $addr .'%"';
                }
                if($famid != '') {
                    $filter[] = 'Family_ID = "' . $famid .'"';
                }
                $db = new DB_Connect();
                $stmt = $db->connect()->prepare("SELECT * from patient_profile where " . implode(" AND ", $filter));
                $stmt->execute();
                if($stmt->rowCount()==0){
                    $_SESSION['errorMsg'] = '<div class="d-block p-2 alert alert-danger bi-exclamation-triangle-fill text-center" role="alert"> No results found!</div>';
                    $_SESSION['patientprof'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $_SESSION['rowCount'] = 0;

                }
                else {
                    $_SESSION['patientprof'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $_SESSION['errorMsg'] = '';
                    $_SESSION['rowCount'] = $stmt->rowCount();
                }
            }
        }
        break;
    case "Dentist Assistant":
        if (isset($_POST["searchBtn"])) {
            $recordID = $_POST["searchRecID"];
            $firstName = $_POST['searchFName'];
            $lastName = $_POST['searchLName'];
            $nric = $_POST['searchNRIC'];
            $dob = $_POST['searchDOB'];
            $visit = $_POST['searchDOV'];

            $filter = array();
            if($recordID != '' || $firstName != '' || $lastName != '' || $nric != '' || $dob != '' || $visit != ''){

                if($recordID != ''){
                    $filter[] = 'r.Record_ID = "' . $recordID . '"';
                }
                if ($firstName != '') {
                    $filter[] = 'profile.First_Name LIKE "' . $firstName . '%"';
                }
                if ($lastName != '') {
                    $filter[] = 'profile.Last_Name LIKE "' . $lastName . '%"';
                }
                if($nric != '') {
                    $filter[] = 'profile.NRIC_PNum = "' . $nric .'"';
                }
                if($dob != '') {
                    $filter[] = 'profile.Birth_Date = "' . $dob .'"';
                }
                if($visit != '') {
                    $filter[] = 'r.Treatment_Date = "' . $visit .'"';
                }

                $db = new DB_Connect();
                $stmt = $db->connect()->prepare("SELECT r.Record_ID, profile.First_Name, profile.Last_Name, profile.NRIC_PNum, profile.Birth_Date, 
                r.Treatment_Date, r.Treatment_Type, r.Treatment_details, r.Material_used, `Doctor/Assistant 1`, `Doctor/Assistant 2` FROM `patient_record` as r INNER JOIN patient_profile as profile on profile.Patient_ID = r.Patient_ID
                where " . implode(" AND ", $filter) . "order by r.Treatment_Date DESC");
                $stmt->execute();
                if($stmt->rowCount()==0){
                    $_SESSION['errorMsg'] = '<div class="d-block p-2 alert alert-danger bi-exclamation-triangle-fill text-center" role="alert"> No such records found!</div>';
                    $_SESSION['patientprof'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $_SESSION['rowCount'] = 0;
                }
                else {
                    $_SESSION['patientprof'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $_SESSION['errorMsg'] = '';
                    $_SESSION['rowCount'] = $stmt->rowCount();
                }
            }
        }
        break;
}



?>


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
        switch ($_SESSION['Role']) {
            case "Dentist":
                echo
                '
                <a class="navbar-brand pe-3" href="DentistDashboard.php">
                    <img src="img/Logo1.png" alt="" width="275" height="70">
                </a>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <div class="navbar-nav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <button class="btn mt-3" name=""><a class="nav-link active text-white h3" href="DentistDashboard.php">Home</a></button>
                            </li>
                            <li class="nav-item">
                                <form method="POST">
                                    <button class="btn mt-3" name="allRecords"><a class="nav-link active text-white h3">View All</a></button>
                                </form>
                            </li>
                            <li class="nav-item">
                                <button class="btn mt-3" name="allPatients"><a class="nav-link active text-white h3" href="DentistPatient.php">View patient</a></button>
                            </li>
                            <li class="nav-item">
                                <button class="btn mt-3" name=""><a class="nav-link active text-white h3" data-bs-toggle="modal" data-bs-target="#searchUserBackDrop">Search <i class="bi bi-search"></i></a></button>
                            </li>
                        </ul>
                    </div>
                </div>
                ';
                break;
            case "Dentist Assistant":
                echo
                '
                <a class="navbar-brand pe-3" href="AssistantDashboard.php">
                    <img src="img/Logo1.png" alt="" width="275" height="70">
                </a>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <div class="navbar-nav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <form method="POST">
                                    <button class="btn mt-3" name="allPatients"><a class="nav-link active text-white h3">Home</a></button>
                                </form>
                            </li>
                            <li class="nav-item">
                                <button class="btn mt-3" name=""><a class="nav-link active text-white h3" aria-current="page" data-bs-toggle="modal" data-bs-target="#searchUserBackDrop">Search Records <i class="bi bi-search"></i></a></button>
                            </li>
                        </ul>
                    </div>
                </div>
                ';
                break;
            case "Receptionist":
                echo
                '
                <a class="navbar-brand pe-3" href="ReceptionistDashboard.php">
                    <img src="img/Logo1.png" alt="" width="275" height="70">
                </a>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <div class="navbar-nav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <button class="btn mt-3" name=""><a class="nav-link active text-white h3" href="ReceptionistDashboard.php">Home</a></button>
                            </li>
                            <li class="nav-item">
                                <form method="POST">
                                    <button class="btn mt-3" name="allPatients"><a class="nav-link active text-white h3">View all</a></button>
                                </form>
                            </li>
                            <li class="nav-item">
                                <button class="btn mt-3" name=""><a class="nav-link active text-white h3" aria-current="page" data-bs-toggle="modal" data-bs-target="#searchUserBackDrop">Search User <i class="bi bi-search"></i></a></button>
                            </li>
                        </ul>
                    </div>
                </div>
                ';
                break;
            case "System Admin":
                echo
                '
                <a class="navbar-brand pe-3" href="AdminDashBoard.php">
                    <img src="img/Logo1.png" alt="" width="275" height="70">
                </a>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <div class="navbar-nav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <button class="btn mt-3" name=""><a class="nav-link active text-white h3" href="AdminDashboard.php">Home</a></button>
                            </li>
                            <li class="nav-item">
                                <form method="POST">
                                    <button class="btn mt-3" name="allUsers"><a class="nav-link active text-white h3" aria-current="page">View all</a></button>
                                </form>
                            </li>
                            <li class="nav-item">
                                <button class="btn mt-3" name=""><a class="nav-link active text-white h3" aria-current="page" data-bs-toggle="modal" data-bs-target="#searchUserBackDrop">Search User <i class="bi bi-search"></i></a></button>
                            </li>
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
                echo '<label for="floatingInput" style="font-size: 24px; color: white;">Welcome, ' . $_SESSION['Name'] . ' (' . $_SESSION['Role'] . ')' . '</label>';
            }
            ?>
        </div>
        <div class="logoutBtn">
            <button class="btn btn-secondary" type="submit" name="logout" onclick="location.href = 'Logout.php';">Logout!</button>
        </div>
    </div>
</nav>
<!-- Search product -->
<div class="modal fade" id="searchUserBackDrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Search Details</h5>
                <div class="p-3" id = "searchrecorpat">
                    <select class="form-select" aria-label="Default select example" name="recorpat" id="recorpat" onchange="hideDiv(this)">
                        <option value="records">Search Records</option>
                        <option value="patients">Search Patients</option>
                    </select>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="mb-3" id="empID">
                        <label class="form-label">Employee ID</label>
                        <input type="text" class="form-control" name="searchEmpID" pattern="[0-9]{4}" title="4 digit ID [E.g. 1001]">
                    </div>
                    <div class="mb-3" id="recordID">
                        <label class="form-label">Record ID</label>
                        <input type="text" class="form-control" name="searchRecID" pattern="^-?\d+\.?\d*$" title="Numerics only">
                    </div>
                    <div class="mb-3" id="patientID">
                        <label class="form-label">Patient ID</label>
                        <input type="text" class="form-control" name="searchPatID" pattern="^-?\d+\.?\d*$" title="Numerics only">
                    </div>
                    <div class="mb-3" id="Fname">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" name="searchFName" pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$" title="Alphabet words only. [E.g. Tony]">
                    </div>
                    <div class="mb-3" id="Lname" >
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="searchLName" pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$" title="Alphabet words only. [E.g. Stark]">
                    </div>
                    <div class="mb-3" id="patientID1">
                        <label class="form-label">Patient ID</label>
                        <input type="text" class="form-control" name="searchPatID1" pattern="^-?\d+\.?\d*$" title="Numerics only">
                    </div>
                    <div class="mb-3" id="Fname1">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" name="searchFName1" pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$" title="Alphabet words only. [E.g. Tony]">
                    </div>
                    <div class="mb-3" id="Lname1">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="searchLName1" pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$" title="Alphabet words only. [E.g. Stark]">
                    </div>
                    <div class="mb-3" id="username">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="searchusername" pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$" title="Alphabet words only. [E.g. ironman95]">
                    </div>
                    <div class="mb-3" id="nric">
                        <label class="form-label">NRIC/Passport No.</label>
                        <input type="text" class="form-control" name="searchNRIC" pattern="[A-Za-z][0-9]{7}[A-Za-z]" title="NRIC/Passport No. [E.g. S0000001A]">
                    </div>
                    <div class="mb-3" id="hp">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="searchPhone" pattern="[8-9]{1}[0-9]{7}" title="SG phone number [E.g. 88889999]">
                    </div>
                    <div class="mb-3" id="dob">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" name="searchDOB">
                    </div>
                    <div class="mb-3" id="visitDate">
                        <label class="form-label">Date of Visit</label>
                        <input type="date" class="form-control" name="searchDOV">
                    </div>
                    <div class="mb-3" id="addr">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="searchAddr">
                    </div>
                    <div class="mb-3" id="role">
                        <label class="form-label">Role</label>
                        <input type="text" class="form-control" name="searchRole" pattern="^(([A-Za-z]+)(\s[A-Za-z]+)?)$" title="Alphabet words only. [E.g. Dentist]">
                    </div> 
                    <div class="mb-3" id="specialization">
                        <label class="form-label">Specialization</label>
                        <input type="text" class="form-control" name="searchSpecial" pattern="^(([A-Za-z]+)(\s[A-Za-z]+)?)$" title="Alphabet words only. [E.g. Orthodonist]">
                    </div>
                    <div class="mb-3" id="services">
                        <label class="form-label">Type of Service</label>
                        <input type="text" class="form-control" name="searchService" pattern="^(([A-Za-z]+)(\s[A-Za-z]+)?)$" title="Alphabet words only. [E.g. Scaling and Polishing]">
                    </div>
                    <div class="mb-3" id="materials">
                        <label class="form-label">Materials</label>
                        <input type="text" class="form-control" name="searchMaterials" pattern="^(([A-Za-z]+)(\s[A-Za-z]+)?)$" title="Alphabet words only. [E.g. Resin]">
                    </div>
                    <div class="mb-3" id="allergy">
                        <label class="form-label">Allergies</label>
                        <input type="text" class="form-control" name="searchAllergies" pattern="^(([A-Za-z]+)(\s[A-Za-z]+)?)$" title="Alphabet words only. [E.g. Dentist]">
                    </div>
                    <div class="mb-3" id="famid">
                        <label class="form-label">Family ID</label>
                        <input type="text" class="form-control" name="searchFam" pattern="[0-9]{3}" title="3 digit ID. [E.g. 123]">
                    </div>
                    <button type="submit" class="btn btn-primary" name="searchBtn">Search!</button>
                </form>
            </div>
        </div>
    </div>
</div>
</html>
<?php
// <Show/hide search features based on roles>
switch ($_SESSION['Role']) {
    case "System Admin":
        echo '<script>document.getElementById("recordID").style.display = "none";</script>';
        echo '<script>document.getElementById("patientID").style.display = "none";</script>';
        echo '<script>document.getElementById("services").style.display = "none";</script>';
        echo '<script>document.getElementById("addr").style.display = "none";</script>';
        echo '<script>document.getElementById("visitDate").style.display = "none";</script>';
        echo '<script>document.getElementById("materials").style.display = "none";</script>';
        echo '<script>document.getElementById("searchrecorpat").style.display = "none";</script>';
        echo '<script>document.getElementById("allergy").style.display = "none";</script>';
        echo '<script>document.getElementById("famid").style.display = "none";</script>';
        echo '<script>document.getElementById("patientID1").style.display = "none"</script>';
        echo '<script>document.getElementById("Fname1").style.display = "none"</script>';
        echo '<script>document.getElementById("Lname1").style.display = "none"</script>';

        break;


    case "Dentist":
        echo '<script>document.getElementById("empID").style.display = "none";</script>';
        echo '<script>document.getElementById("username").style.display = "none";</script>';
        echo '<script>document.getElementById("role").style.display = "none";</script>';
        echo '<script>document.getElementById("specialization").style.display = "none";</script>';
        echo '<script>document.getElementById("addr").style.display = "none";</script>';
        echo '<script>document.getElementById("dob").style.display = "none";</script>';
        echo '<script>document.getElementById("nric").style.display = "none";</script>';
        echo '<script>document.getElementById("hp").style.display = "none";</script>';
        echo '<script>document.getElementById("allergy").style.display = "none";</script>';
        echo '<script>document.getElementById("famid").style.display = "none";</script>';
        echo '<script>document.getElementById("patientID1").style.display = "none"</script>';
        echo '<script>document.getElementById("Fname1").style.display = "none"</script>';
        echo '<script>document.getElementById("Lname1").style.display = "none"</script>';

        echo '<script>document.querySelector("select[name=recorpat]").addEventListener("change", function(){
            if(this.value == "patients"){
                document.getElementById("recordID").style.display = "none";
                document.getElementById("visitDate").style.display = "none";
                document.getElementById("materials").style.display = "none";
                document.getElementById("services").style.display = "none";
                document.getElementById("allergy").style.display = "block";
                document.getElementById("patientID").style.display = "none";
                document.getElementById("Fname").style.display = "none";
                document.getElementById("Lname").style.display = "none";
                document.getElementById("patientID1").style.display = "block";
                document.getElementById("Fname1").style.display = "block";
                document.getElementById("Lname1").style.display = "block";
            }
            else{
                document.getElementById("recordID").style.display = "block";
                document.getElementById("visitDate").style.display = "block";
                document.getElementById("materials").style.display = "block";
                document.getElementById("services").style.display = "block";
                document.getElementById("allergy").style.display = "none";
                document.getElementById("patientID1").style.display = "none";
                document.getElementById("Fname1").style.display = "none";
                document.getElementById("Lname1").style.display = "none";
                document.getElementById("patientID").style.display = "block";
                document.getElementById("Fname").style.display = "block";
                document.getElementById("Lname").style.display = "block";

            }
        })
        </script>';
        break;

    case "Receptionist":
        echo '<script>document.getElementById("empID").style.display = "none";</script>';
        echo '<script>document.getElementById("recordID").style.display = "none";</script>';
        echo '<script>document.getElementById("username").style.display = "none";</script>';
        echo '<script>document.getElementById("services").style.display = "none";</script>';
        echo '<script>document.getElementById("role").style.display = "none";</script>';
        echo '<script>document.getElementById("specialization").style.display = "none";</script>';
        echo '<script>document.getElementById("visitDate").style.display = "none";</script>';
        echo '<script>document.getElementById("materials").style.display = "none";</script>';
        echo '<script>document.getElementById("searchrecorpat").style.display = "none";</script>';
        echo '<script>document.getElementById("allergy").style.display = "none";</script>';
        echo '<script>document.getElementById("patientID1").style.display = "none"</script>';
        echo '<script>document.getElementById("Fname1").style.display = "none"</script>';
        echo '<script>document.getElementById("Lname1").style.display = "none"</script>';

        break;

    case "Dentist Assistant":
        echo '<script>document.getElementById("empID").style.display = "none";</script>';
        echo '<script>document.getElementById("patientID").style.display = "none";</script>';
        echo '<script>document.getElementById("hp").style.display = "none";</script>';
        echo '<script>document.getElementById("username").style.display = "none";</script>';
        echo '<script>document.getElementById("services").style.display = "none";</script>';
        echo '<script>document.getElementById("role").style.display = "none";</script>';
        echo '<script>document.getElementById("specialization").style.display = "none";</script>';
        echo '<script>document.getElementById("addr").style.display = "none";</script>';
        echo '<script>document.getElementById("searchrecorpat").style.display = "none";</script>';
        echo '<script>document.getElementById("materials").style.display = "none";</script>';
        echo '<script>document.getElementById("allergy").style.display = "none";</script>';
        echo '<script>document.getElementById("famid").style.display = "none";</script>';
        echo '<script>document.getElementById("patientID1").style.display = "none"</script>';
        echo '<script>document.getElementById("Fname1").style.display = "none"</script>';
        echo '<script>document.getElementById("Lname1").style.display = "none"</script>';

        break;
    }
?>