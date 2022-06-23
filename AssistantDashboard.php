<?php 
include 'db_connection.php';
require_once('Navbar.php');

if(!isset($_SESSION['Role']) && empty($_SESSION['Role'])) {
	header("Location: index.php");
}else {
    if (!isset($_SESSION['patientprof']) && empty($_SESSION['patientprof'])) {
        $db = new DB_Connect();
        $stmt = $db->connect()->prepare("SELECT r.Record_ID, profile.First_Name, profile.Last_Name, profile.NRIC_PNum, profile.Birth_Date, 
        r.Treatment_Date, r.Treatment_Type, r.Treatment_details, r.Material_used, `Doctor/Assistant 1`, `Doctor/Assistant 2` FROM `patient_record` 
        as r INNER JOIN patient_profile as profile on profile.Patient_ID = r.Patient_ID order by r.Treatment_Date DESC");
        $stmt->execute();
        $errormsg = '';
        $rowCount = '';

        if ($stmt->rowCount() > 0) {
            $patient_records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    } else {
        $patient_records = $_SESSION['patientprof'];
        $errormsg = $_SESSION['errorMsg'];
        $rowCount = $_SESSION['rowCount'];
    }
}

if (isset($_POST["allPatients"])) {
	unset($_SESSION['patientprof']);
	$db = new DB_Connect();

	$stmt = $db->connect()->prepare("SELECT r.Record_ID, profile.First_Name, profile.Last_Name, profile.NRIC_PNum, profile.Birth_Date, 
    r.Treatment_Date, r.Treatment_Type, r.Treatment_details, r.Material_used, `Doctor/Assistant 1`, `Doctor/Assistant 2` FROM `patient_record` as
    r INNER JOIN patient_profile as profile on profile.Patient_ID = r.Patient_ID order by r.Treatment_Date DESC");
        $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $patient_records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $errormsg = '';
        $rowCount = '';
    }
}
?>

<html>
<head>
    <title>Dental Assistant Page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
        body {
            background-image: url('img/AdminBackground.png');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>
</head>
<body>
    <div class="w-100 p-3"> 
        <table class="table table-hover ps-1">
            <thead class="table-dark">
            <tr>
                    <th scope="col">Record ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">NRIC</th>
                    <!-- <th scope="col" style="display:none">Phone Number</th> -->
                    <th scope="col">Date of Birth</th>
                    <th scope="col">Date of Visit</th>
                    <th scope="col">Treatment Type</th>
                    <th scope="col" style="display:none">Treatment Details</th>
                    <th scope="col" style="display:none">Materials used</th>
                    <th scope="col" style="display:none">Dentists involved</th>
					<th scope="col" style="display:none">Assistants involved</th>
					<th scope="col" style="width: 100px">View</th>
                </tr>
            </thead>
            <tbody>
               <?php
                foreach ($patient_records as $record) {
                    // $patient_id = $record['Patient_ID'];
                    // $stmt = $db->connect()->prepare("SELECT  FROM patient_profile where Patient_ID = $patient_id");
                    // $stmt->execute();
                    // $patient = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    echo
                    '<tr>' .
                    '<th scope="row">' . $record['Record_ID'] . '</th>' .
                    '<td>' . $record['First_Name'] . ' ' . $record['Last_Name'] . '</td>' .
                    '<td>' . $record['NRIC_PNum'] . '</td>' .
                    // '<td style="display:none">' . $record['Phone_Num'] . '</td>' .
                    '<td>' . $record['Birth_Date'] . '</td>' .

                    '<td>' . $record['Treatment_Date'] . '</td>' .
                    '<td>' . $record['Treatment_Type'] . '</td>' .
                    '<td style="display:none">' . $record['Treatment_details'] . '</td>' .
                    '<td style="display:none">' . $record['Material_used'] . '</td>' .
                    '<td style="display:none">' . $record['Doctor/Assistant 1'] . '</td>' .
                    '<td style="display:none">' . $record['Doctor/Assistant 2'] . '</td>' .
                    '<td><button type="button" class="btn btn-secondary viewBtn" data-bs-toggle="modal" data-bs-target="#viewAcc">View  <i class="bi bi-eye"></i></button></td>' .
                    '</tr>';
                }
               ?>
            </tbody>
        </table>
        <?php
        echo "$errormsg";
        if ($rowCount == 1){
			echo "<span class='d-block p-2 bg-success text-white text-center'>$rowCount result found!</span>";
		}
		else if ($rowCount > 1) {
			echo "<span class='d-block p-2 bg-success text-white text-center'>$rowCount results found!</span>";
		}

        ?>
    </div>
    <!-- View Treatment Modal -->
    <div class="modal fade" id="viewAcc" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">View Treatment details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- <form class="needs-validation" method="POST" novalidate> -->
                        <div class="mb-3">
                            <label class="form-label">Record ID</label>
                                <input type="text" class="form-control" name="recID" id="recID" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                                <input type="text" class="form-control" name="fname" id="fname" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="lname" id="lname"  readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NRIC/Passport No.</label>
                            <input type="text" class="form-control" name="view_nric" id="view_nric" readonly>
                        </div>
                        <!-- <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" class="form-control" pattern="[8-9]{1}[0-9]{7}" name="view_mobileNum" id="view_mobileNum" readonly>
                        </div> -->
                        <div class="mb-3">
                            <label class="form-label">Visit date</label>
                            <input type="date" class="form-control" name="visit_date" id="visit_date" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Treatment Type</label>
                            <input type="text" class="form-control" name="Treatment_type" id="Treatment_type" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Treatment Details</label>
                            <input type="text" class="form-control" name="Treatment_details" id="Treatment_details" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Materials Used</label>
                            <input type="text" class="form-control" name="view_Materials" id="view_Materials" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Dentist Involved</label>
                            <input type="text" class="form-control" name="view_Den" id="view_Den" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Dentist Assistant Involved</label>
                            <input type="text" class="form-control" name="view_Ass" id="view_Ass" readonly>
                        </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
<script>
    $('document').ready(function() {
		$('.viewBtn').click(function() {
            $rID =  $(this).closest('tr').find('th:nth-child(1)').text().trim();
            $name = $(this).closest('tr').find('td:nth-child(2)').text().trim();
			$splitName = $name.split(" ");
			$first = $splitName[0];
			$last = $splitName[1];
            $nric = $(this).closest('tr').find('td:nth-child(3)').text().trim();
            // $hp = $(this).closest('tr').find('td:nth-child(5)').text().trim();
            $dov = $(this).closest('tr').find('td:nth-child(5)').text().trim();
            $treat_type = $(this).closest('tr').find('td:nth-child(6)').text().trim();
            $treat_dets = $(this).closest('tr').find('td:nth-child(7)').text().trim();
            $materials = $(this).closest('tr').find('td:nth-child(8)').text().trim();
            $dentists = $(this).closest('tr').find('td:nth-child(9)').text().trim();
            $assists = $(this).closest('tr').find('td:nth-child(10)').text().trim();

            
			$('#recID').val($rID);
            $('#fname').val($first);
			$('#lname').val($last);
			$('#view_nric').val($nric);
			// $('#view_mobileNum').val($hp);
			$('#visit_date').val($dov);
			$('#Treatment_type').val($treat_type);
			$('#Treatment_details').val($treat_dets);
			$('#view_Materials').val($materials);
			$('#view_Den').val($dentists);
			$('#view_Ass').val($assists);
		});
    });
</script>
</html>