<?php
include 'db_connection.php';
require_once('Navbar.php');
//$connect = new PDO("mysql:host=localhost;dbname=fyp", "root", "");
//Calling of dentist and dentist assistant
$db = new DB_Connect();
$stmt1 = $db->connect()->prepare("SELECT First_Name FROM user_table where Role = 'Dentist' or Role = 'Dentist Assistant'");
$stmt1->execute();
//$query = "SELECT First_Name FROM user_table where Role = 'Dentist' or Role = 'Dentist Assistant'";
$resultforDA1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
//$resultforDA2 = $connect->query($query);
//$resultforcDA1 = $connect->query($query);
//$resultforcDA2 = $connect->query($query);
if (!isset($_SESSION['Role']) && empty($_SESSION['Role'])) {
    header("Location: index.php");
} else {
	if (!isset($_SESSION['patientrecords']) && empty($_SESSION['patientrecords'])){
        
        $stmt = $db->connect()->prepare("SELECT patient_profile.First_Name, patient_profile.Last_Name, patient_record.* FROM `patient_record` right join patient_profile on patient_record.Patient_ID = patient_profile.Patient_ID order by patient_record.Treatment_Date DESC");
        
        $stmt->execute();
        $errormsg = '';
        $rowCount = '';
        if ($stmt->rowCount() > 0) {
            $patient_records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    } else {
		$patient_records = $_SESSION['patientrecords'];
        $errormsg = $_SESSION['errorMsg'];
		$rowCount = $_SESSION['rowCount'];
    }
}



if (isset($_POST["editBtn"])) {
    $rID = $_POST['rID'];
    $TDate = $_POST['Date'];
    $serviceType = $_POST['serviceType'];
    $Mat = $_POST['mat'];
    $DA1 = $_POST['DA1'];
    $DA2 = $_POST['DA2'];
    $cDescription = $_POST['description'];

    $stmt = $db->connect()->prepare("UPDATE `patient_record` set `Treatment_Date` = '$TDate', `Treatment_type` = '$serviceType', `Treatment_details` = '$cDescription',
     `Material_used` = '$Mat', `Doctor/Assistant 1` = '$DA1', `Doctor/Assistant 2` = '$DA2' where `Record_ID` = $rID ");
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
		echo '<meta http-equiv="refresh" content="1">';
		echo "<span class='d-block p-2 bg-success text-white text-center'>Record successfully updated!</span>";
		return true;
	} else {
		return false;
    }
}

if (isset($_POST["allRecords"])) {
	unset($_SESSION['patientrecords']);
	$db = new DB_Connect();

	$stmt = $db->connect()->prepare("SELECT patient_profile.First_Name, patient_profile.Last_Name, patient_record.* FROM `patient_record` right join patient_profile on patient_record.Patient_ID = patient_profile.Patient_ID order by patient_record.Treatment_Date DESC");
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
    <title> Dentist Page </title>
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
                <form class="d-flex">
                </form>
            </div>
        </nav>
        <table class="table table-hover ps-1">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Record ID</th>
                    <th scope="col">Patient ID</th>
                    <th scope="col">Name of Patient</th>
                    <th scope="col">Date of treatment</th>
                    <th scope="col">Type of service</th>
                    <th scope="col">Description</th>
                    <th scope="col">Materials</th>
                    <th scope="col">Doctors/Assistants 1</th>
                    <th scope="col">Doctors/Assistants 2</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($patient_records as $record) {
                    echo
                    '<tr>' .
                        '<td>' . $record['Record_ID'] . '</td>' .
                        '<td>' . $record['Patient_ID'] . '</td>' .
                        '<td>' . $record['First_Name'] . ' ' . $record['Last_Name'] . '</td>' .
                        '<td>' . $record['Treatment_Date'] . '</td>' .
                        '<td>' . $record['Treatment_type'] . '</td>' .
                        '<td>' . $record['Treatment_details'] . '</td>' .
                        '<td>' . $record['Material_used'] . '</td>' .
                        '<td>' . $record['Doctor/Assistant 1'] . '</td>' .
                        '<td>' . $record['Doctor/Assistant 2'] . '</td>' .
                        '<td><button type="button" class="btn btn-secondary editBtn" data-bs-toggle="modal" data-bs-target="#editAcc">View/Edit <i class="bi bi-pencil-square"></i></button></td>' .
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

    <!-- Edit Form Modal (create) -->
    <div class="modal fade" id="editAcc" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Treatment details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" method="POST" novalidate>
                        <div class="mb-3">
                            <label hidden class="form-label">Patient ID</label>
                            <input hidden type="text" class="form-control" name="rID" id="rID" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name of patient</label>
                            <input type="text" class="form-control" name="name" id="name" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"> Date</label>
                            <input type="date" class="form-control" name="Date" id="Date" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Type of service</label>
                            <select class="form-select" aria-label="Default select example" name="serviceType" id="serviceType" required>
                                <option selected>Type of service</option>
                                <option value="Dental Check ups">Dental Check ups</option>
                                <option value="Restoration of teeth">Restoration of teeth</option>
                                <option value="Professional Teeth Cleaning">Professional Teeth Cleaning</option>
                                <option value="Dental Implants">Dental Implants</option>
                            </select>
                            <div class="invalid-feedback">
								Please select a type of service.
							</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Doctor/Assistant 1</label>
                            <select name="DA1" class="form-select" id="DA1" name = "DA1" required>
                                <option value="Nil">Nil</option>
                                <?php
                                foreach ($resultforDA1 as $row) {
                                    echo '<option value="' . $row["First_Name"] . '">' . $row["First_Name"] . '</option>';
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">
								Please choose a Doctor/Assistant.
							</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Doctor/Assistant associated with treatment 2 (Write "Nil" if none)</label>
                            <select name="DA2" class="form-select" id="DA2" name = "DA2" required>
                                <option value="Nil">Nil</option>
                                <?php
                                foreach ($resultforDA1 as $row) {
                                    echo '<option value="' . $row["First_Name"] . '">' . $row["First_Name"] . '</option>';
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">
								Please choose a Doctor/Assistant.
							</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Material used</label>
                            <textarea type="text" class="form-control" name="mat" id=mat pattern="^([A-Za-z]+[,.]?[ ]?|[A-Za-z]+['-]?)+$" required></textarea>
                            <div class="invalid-feedback">
								Please enter material used.
							</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea type="text" class="form-control" name="description" id=description required></textarea>
                            <div class="invalid-feedback">
								Please enter description.
							</div>
                        </div>
                        <button type="submit" class="btn btn-primary float-end" name="editBtn">Edit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

<script>
    $('document').ready(function() {
        $('.editBtn').click(function() {
            $rID = $(this).closest('tr').find('td:nth-child(1)').text().trim();
            $name = $(this).closest('tr').find('td:nth-child(3)').text().trim();
            $splitName = $name.split(" ");
            $('#rID').val($rID);
            $('#name').val($name);
            $Date = $(this).closest('tr').find('td:nth-child(4)').text().trim();
            $service = $(this).closest('tr').find('td:nth-child(5)').text().trim();
            $DA1 = $(this).closest('tr').find('td:nth-child(8)').text().trim();
            $DA2 = $(this).closest('tr').find('td:nth-child(9)').text().trim();
            $mat = $(this).closest('tr').find('td:nth-child(7)').text().trim();
            $description = $(this).closest('tr').find('td:nth-child(6)').text().trim();
            $('#Date').val($Date);
            $('#serviceType').val($service);
            $('#DA1').val($DA1);
            $('#DA2').val($DA2);
            $('#mat').val($mat);
            $('#description').val($description);
            //$("#radio_1").prop("checked", true);
            //alert("You want to edit: Category with ID " + $('.category-id', $tr).text() + " & Name: " + $('.category-name', $tr).text());
            //You can use this info and set it to the inputs with javascript: $("edit_category_modal input[type='text']").val($('.category-name', $tr).text()) for example;
        });
    });
</script>
<script>
    /*
    var select_box_element = document.querySelector('#DA1');

    dselect(select_box_element, {
        search: true
    });
    var select_box_element = document.querySelector('#DA2');

    dselect(select_box_element, {
        search: true
    });
    */
</script>
<script>
   function refreshPage(){
    window.location.reload();
	}
    (function() {
		'use strict'

		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		var forms = document.querySelectorAll('.needs-validation')

		// Loop over them and prevent submission
		Array.prototype.slice.call(forms)
			.forEach(function(form) {
				form.addEventListener('submit', function(event) {
					if (!form.checkValidity()) {
						event.preventDefault()
						event.stopPropagation()
					}

					form.classList.add('was-validated')
				}, false)
			})
	})();
</script>


</html>