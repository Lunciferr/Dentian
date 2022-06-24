<?php
include 'db_connection.php';
include 'Navbar.php';

if (!isset($_SESSION['Role']) && empty($_SESSION['Role'])) {
    header("Location: index.php");
    exit();
} else {
    if (!isset($_SESSION['patientprof']) && empty($_SESSION['patientprof']) ) {
        $db = new DB_Connect();
        $stmt = $db->connect()->prepare("SELECT * FROM patient_profile");
        $stmt->execute();
        $errormsg = '';
        $rowCount = '';
        $addSuccess = '';
        if ($stmt->rowCount() > 0) {
            $patients_profile = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!isset($_SESSION['successAdd']) && empty($_SESSION['successAdd'])){
                $addSuccess = '';
            }
            else {
                $addSuccess = $_SESSION['successAdd'];
            }
        }
    } else {
        $addSuccess = '';
        $patients_profile =  $_SESSION['patientprof'];
        $errormsg = $_SESSION['errorMsg'];
		$rowCount = $_SESSION['rowCount'];
    }
}

if (isset($_POST["allPatients"])) {
	unset($_SESSION['patientprof']);
	$db = new DB_Connect();

	$stmt = $db->connect()->prepare("SELECT * FROM patient_profile");
        $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $patients_profile = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $errormsg = '';
        $rowCount = '';
        $addSuccess = '';
    }
}
?>

<html>

<head>
    <title> Receptionist Page </title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        p,
        td {
            font-family: garamond;
            font-size: 14pt;
        }

        td,
        th {
            border: 1px solid #ddd;
        }

        table {
            width: 50%;
            background-color: white;
            text-align: left;
        }

        .center {
            text-align: center;
        }

        .errorMsg {
            color: red;
        }

        .button {
            position: absolute;
            left: 100px;
            top: 100px;
            background-color: #9E989B;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .button {
            border-radius: 12px;
        }

        body {
            background-image: url('img/AdminBackground.png');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }

        .form-outline {
            background-color: white;

        }

        .topnav input[type=text] {
            border: 5px solid #ccc;
        }
    </style>
</head>

<body>
    <div class="w-100 p-3">
        <nav class="navbar navbar-light bg-transparent">
            <div class="container-fluid mb-3">
                <!-- Create Account Button -->
                <button class="btn btn-primary" type="submit" name="logout" onclick="location.href = 'CreatePatientProfile.php';">Create New Patient Profile <i class="bi bi-plus-square"></i></button>
                <!-- <form class="d-flex">
                    <input class="form-control me-1" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                </form> -->
            </div>
        </nav>
        <table class="table table-hover ps-1">
            <thead class="table-dark">
                <tr>
                    <th scope="col" style="width: 100px">Patient ID</th>
                    <th scope="col">Name</th>
                    <th scope="col" style="width: 400px">Email</th>
                    <th scope="col" style="width: 180px">NRIC/Passport No.</th>
                    <th scope="col" style="width: 100px">Gender</th>
                    <th scope="col" style="width: 180px">Phone Number</th>
                    <th scope="col">Address</th>
                    <th scope="col" style="width: 180px">Family ID</th>
                    <th scope="col" style="width: 180px">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($patients_profile as $patients) {
                    echo
                    '<tr>' .
                        '<td scope="row">' . $patients['Patient_ID'] . '</td>' .
                        '<td>' . $patients['First_Name'] . ' ' . $patients['Last_Name'] . '</td>' .
                        '<td>' . $patients['Email'] . '</td>' .
                        '<td>' . $patients['NRIC_PNum'] . '</td>' .
                        '<td>' . $patients['Gender'] . '</td>' .
                        '<td>' . $patients['Phone_Num'] . '</td>' .
                        '<td>' . $patients['Address'] . '</td>' .
                        '<td>' . $patients['Family_ID'] . '</td>' .
                        '<td><button type="button" class="btn btn-secondary editBtn">View/Edit <i class="bi bi-pencil-square"></i></button></td>' .
                        //'<td><a class="btn btn-link" href="" role="button"><i class="bi bi-pencil-square"></i></a></td>' .
                        '</tr>';
                }
                ?>
            </tbody>
        </table>
        <?php	
		echo "$errormsg";
        echo "$addSuccess";
		if ($rowCount == 1){
			echo "<span class='d-block p-2 bg-success text-white text-center'>$rowCount result found!</span>";
		}
		else if ($rowCount > 1) {
			echo "<span class='d-block p-2 bg-success text-white text-center'>$rowCount results found!</span>";
		}
        unset($_SESSION['successAdd']);
		?>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>
    $('document').ready(function() {
        $('.editBtn').click(function() {
            $patient_id = $(this).closest('tr').find('td:nth-child(1)').text();
            window.location = 'PatientProfile.php?PatientID=' + $patient_id;
        });
	});
</script>
</html>