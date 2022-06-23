<?php
include 'db_connection.php';
require_once('Navbar.php');

if (!isset($_SESSION['Role']) && empty($_SESSION['Role'])) {
    header("Location: index.php");
} else {
    if (!isset($_SESSION['patients']) && empty($_SESSION['patients'])) {
        $db = new DB_Connect();
        $stmt = $db->connect()->prepare("SELECT * FROM patient_profile");
        $stmt->execute();
        $errormsg = '';
        $rowCount = '';
        if ($stmt->rowCount() > 0) {
            $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    } else {
        $patients = $_SESSION['patients'];
        $errormsg = $_SESSION['errorMsg'];
        $rowCount = $_SESSION['rowCount'];
    }
}
if (isset($_POST["allRecords"])) {
    unset($_SESSION['patients']);
    $db = new DB_Connect();

    $stmt = $db->connect()->prepare("SELECT * FROM patient_profile");
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $errormsg = '';
        $rowCount = '';
    }
}
if (!isset($_SESSION['Role']) && empty($_SESSION['Role'])) {
    header("Location: index.php");
} else {
    $connect1 = new PDO("mysql:host=localhost;dbname=fyp", "root", "");
    $db1 = new DB_Connect();
    $stmt1 = $db1->connect()->prepare("SELECT * FROM patient_record");
    $query = "SELECT First_Name FROM user_table where Role = 'Dentist' or Role = 'Dentist Assistant'";
    $resultforDA1 = $connect1->query($query);
    $resultforDA2 = $connect1->query($query);
    $resultforcDA1 = $connect1->query($query);
    $resultforcDA2 = $connect1->query($query);
    $stmt1->execute();

    if ($stmt1->rowCount() > 0) {
        $patient_records = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    } else {
    }
}
if (isset($_POST["createBtn"])) {

    $pID = $_POST['Patient_ID'];
    $TDate = $_POST['TDate'];
    $serviceType = $_POST['serviceType'];
    $cMat = $_POST['cMat'];
    $cDA1 = $_POST['cDA1'];
    $cDA2 = $_POST['cDA2'];
    $cDescription = $_POST['cDescription'];

    $stmt = $db->connect()->prepare("INSERT INTO `patient_record`(`Patient_ID`,`Treatment_Date`,`Treatment_type`,`Treatment_details`, `Material_used`, `Doctor/Assistant 1`, `Doctor/Assistant 2`) 
    VALUES ('$pID','$TDate','$serviceType', '$cDescription', '$cMat', '$cDA1', '$cDA2')");
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        echo '<meta http-equiv="refresh" content="1">';
        echo "<span class='d-block p-2 bg-success text-white text-center'>Record successfully created!</span>";
        return true;
    } else {
        return false;
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

        .imgMain {
            position: relative;
            z-index: 1;

        }


        .img1 {
            width: 50px;
            height: 90px;
            position: relative;
            z-index: 2;
            top: -350px;
            left: 45px;
        }

        .img2 {
            width: 50px;
            height: 90px;
            position: relative;
            z-index: 2;
            top: -350px;
            left: 45px;
        }

        .img3 {
            width: 50px;
            height: 90px;
            position: relative;
            z-index: 2;
            top: -350px;
            left: 40px;
        }

        .img4 {
            width: 40px;
            height: 90px;
            position: relative;
            z-index: 2;
            top: -350px;
            left: 28px;
        }

        .img5 {
            width: 40px;
            height: 90px;
            position: relative;
            z-index: 2;
            top: -350px;
            left: 18px;
        }

        .img6 {
            width: 40px;
            height: 100px;
            position: relative;
            z-index: 2;
            top: -350px;
            left: 10px;
        }

        .img7 {
            width: 40px;
            height: 90px;
            position: relative;
            z-index: 2;
            top: -350px;
            left: -2px;
        }

        .img8 {
            width: 40px;
            height: 90px;
            position: relative;
            z-index: 2;
            top: -350px;
            left: -12px;
        }

        .img9 {
            width: 40px;
            height: 90px;
            position: relative;
            z-index: 2;
            top: -350px;
            left: -18px;
        }

        .img10 {
            width: 40px;
            height: 90px;
            position: relative;
            z-index: 2;
            top: -350px;
            left: -30px;
        }

        .img11 {
            width: 40px;
            height: 90px;
            position: relative;
            z-index: 2;
            top: -355px;
            left: -42px;
        }

        .img12 {
            width: 40px;
            height: 90px;
            position: relative;
            z-index: 2;
            top: -355px;
            left: -52px;
        }

        .img13 {
            width: 40px;
            height: 90px;
            position: relative;
            z-index: 2;
            top: -355px;
            left: -62px;
        }

        .img14 {
            width: 45px;
            height: 90px;
            position: relative;
            z-index: 2;
            top: -355px;
            left: -68px;
        }

        .img15 {
            width: 45px;
            height: 90px;
            position: relative;
            z-index: 2;
            top: -355px;
            left: -68px;
        }

        .img16 {
            width: 45px;
            height: 90px;
            position: relative;
            z-index: 2;
            top: -355px;
            left: -75px;
        }

        .img17 {
            width: 45px;
            height: 60px;
            position: relative;
            z-index: 2;
            top: -320px;
            left: 50px;
        }

        .img18 {
            width: 55px;
            height: 70px;
            position: relative;
            z-index: 2;
            top: -315px;
            left: 40px;
        }

        .img19 {
            width: 55px;
            height: 70px;
            position: relative;
            z-index: 2;
            top: -315px;
            left: 40px;
        }

        .img20 {
            width: 35px;
            height: 70px;
            position: relative;
            z-index: 2;
            top: -315px;
            left: 35px;
        }

        .img21 {
            width: 35px;
            height: 70px;
            position: relative;
            z-index: 2;
            top: -315px;
            left: 30px;
        }

        .img22 {
            width: 35px;
            height: 90px;
            position: relative;
            z-index: 2;
            top: -308px;
            left: 25px;
        }

        .img23 {
            width: 35px;
            height: 90px;
            position: relative;
            z-index: 2;
            top: -308px;
            left: 20px;
        }

        .img24 {
            width: 35px;
            height: 90px;
            position: relative;
            z-index: 2;
            top: -308px;
            left: 12px;
        }

        .img25 {
            width: 35px;
            height: 90px;
            position: relative;
            z-index: 2;
            top: -308px;
            left: 0px;
        }

        .img26 {
            width: 35px;
            height: 90px;
            position: relative;
            z-index: 2;
            top: -308px;
            left: -5px;
        }

        .img27 {
            width: 35px;
            height: 90px;
            position: relative;
            z-index: 2;
            top: -308px;
            left: -10px;
        }

        .img28 {
            width: 35px;
            height: 90px;
            position: relative;
            z-index: 2;
            top: -308px;
            left: -15px;
        }

        .img29 {
            width: 35px;
            height: 90px;
            position: relative;
            z-index: 2;
            top: -308px;
            left: -22px;
        }

        .img30 {
            width: 50px;
            height: 75px;
            position: relative;
            z-index: 2;
            top: -315px;
            left: -28px;
        }

        .img31 {
            width: 50px;
            height: 70px;
            position: relative;
            z-index: 2;
            top: -315px;
            left: -30px;
        }

        .img32 {
            width: 50px;
            height: 65px;
            position: relative;
            z-index: 2;
            top: -315px;
            left: -38px;
        }
    </style>
</head>

<body>
    <div class="w-100 p-3">
        <nav class="navbar navbar-light bg-transparent">
            <div class="container-fluid mb-3">
                <form class="d-flex">
                </form>
            </div>
        </nav>
        <table class="table table-hover ps-1">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Patient ID</th>
                    <th scope="col">Name of Patient</th>
                    <th scope="col">NRIC</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Allergies</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($patients as $patients) {
                    echo
                    '<tr>' .
                        '<td>' . $patients['Patient_ID'] . '</td>' .
                        '<td class="firstName">' . $patients['First_Name'] . ' ' . $patients['Last_Name'] . '</td>' .
                        '<td>' . $patients['NRIC_PNum'] . '</td>' .
                        '<td>' . $patients['Gender'] . '</td>' .
                        '<td>' . $patients['Allergies'] . '</td>' .
                        '<td><button type="button" class="btn btn-success createBtn1" data-bs-toggle="modal" data-bs-target="#createBtn">Create <i class="bi bi-pencil-square"></i></button></td>' .
                        '</tr>';
                }
                ?>
            </tbody>
        </table>
        <?php
        echo "$errormsg";

        if ($rowCount == 1) {
            echo "<span class='d-block p-2 bg-success text-white text-center'>$rowCount result found!</span>";
        } else if ($rowCount > 1) {
            echo "<span class='d-block p-2 bg-success text-white text-center'>$rowCount results found!</span>";
        }
        ?>
    </div>
    <div class="modal fade " id="createBtn" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" method="POST" novalidate>
                        <div class="mb-3">
                            <label class="form-label">Name of patient</label>
                            <input type="text" class="form-control" name="PName" id="PName" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" hidden>Patient ID</label>
                            <input type="text" class="form-control" name="Patient_ID" id="Patient_ID" hidden>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Date of treatment</label>
                            <input type="date" class="form-control" name="TDate" required>
                            <div class="invalid-feedback">
								Please select a date.
							</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Type of service</label>
                            <select class="form-select" aria-label="Default select example" name="serviceType" id="serviceType" required>
                                <option selected value="">Type of service</option>
                                <option value="Dental Check ups">Dental Check ups</option>
                                <option value="Restoration of teeth">Restoration of teeth</option>
                                <option value="Professional Teeth Cleaning">Professional Teeth Cleaning</option>
                                <option value="Dental Implants">Dental Implants</option>
                            </select>
                            <div class="invalid-feedback">
								Please choose a type of service.
							</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Doctor/Assistant associated with treatment 1</label>
                            <select name="cDA1" class="form-select" id="cDA1" required>
                                <option value="">Nil</option>
                                <?php
                                foreach ($resultforcDA1 as $row) {
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
                            <select name="cDA2" class="form-select" id="cDA2" required>
                                <option value="">Nil</option>
                                <?php
                                foreach ($resultforcDA2 as $row) {
                                    echo '<option value="' . $row["First_Name"] . '">' . $row["First_Name"] . '</option>';
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">
								Please choose a Doctor/Assistant/NIL.
							</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Material used</label>
                            <textarea type="text" class="form-control" name="cMat" id="cMat" required></textarea>
                            <div class="invalid-feedback">
								Please enter material used.
							</div>
                        </div>
                        <div class="col-md-12 pt-3">
                            <div>
                                <a class="btn btn-primary" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Diagram</a>
                            </div>
                            <div class="collapse " id="multiCollapseExample1">
                                <img width="725" height="400" class="imgMain" src="img/Teeth/TeethDiagram.png" draggable="false" ondragstart="event.dataTransfer.setData('text/plain', 'hello')" />
                                <img class="img1" src="img/Teeth/UpperTeeth.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Right Molar 1')" />
                                <img class="img2" src="img/Teeth/UpperTeeth2.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Right Molar 2')" />
                                <img class="img3" src="img/Teeth/UpperTeeth3.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Right Molar 3')" />
                                <img class="img4" src="img/Teeth/UpperTeeth4.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Right Premolar 1')" />
                                <img class="img5" src="img/Teeth/UpperTeeth5.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Right Premolar 2')" />
                                <img class="img6" src="img/Teeth/UpperTeeth6.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Right Canine 1')" />
                                <img class="img7" src="img/Teeth/UpperTeeth7.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Incisors 1')" />
                                <img class="img8" src="img/Teeth/UpperTeeth8.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Incisors 2')" />
                                <img class="img9" src="img/Teeth/UpperTeeth9.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Incisors 3')" />
                                <img class="img10" src="img/Teeth/UpperTeeth10.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Incisors 4')" />
                                <img class="img11" src="img/Teeth/UpperTeeth11.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Left Canine 1')" />
                                <img class="img12" src="img/Teeth/UpperTeeth12.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Left Premolar 1')" />
                                <img class="img13" src="img/Teeth/UpperTeeth13.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Left Premolar 2')" />
                                <img class="img14" src="img/Teeth/UpperTeeth14.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Left Molar 1')" />
                                <img class="img15" src="img/Teeth/UpperTeeth15.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Left Molar 2')" />
                                <img class="img16" src="img/Teeth/UpperTeeth16.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Left Molar 3')" />
                                <img class="img17" src="img/Teeth/LowerTeeth1.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Lower Right Molar 1')" />
                                <img class="img18" src="img/Teeth/LowerTeeth2.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Lower Right Molar 2')" />
                                <img class="img19" src="img/Teeth/LowerTeeth3.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Lower Right Molar 3')" />
                                <img class="img20" src="img/Teeth/LowerTeeth4.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Lower Right Premolar 1')" />
                                <img class="img21" src="img/Teeth/LowerTeeth5.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Lower Right Premolar 2')" />
                                <img class="img22" src="img/Teeth/LowerTeeth6.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Lower Right Canine 1')" />
                                <img class="img23" src="img/Teeth/LowerTeeth7.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Lower Right Incisors 1')" />
                                <img class="img24" src="img/Teeth/LowerTeeth8.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Lower Right Incisors 2')" />
                                <img class="img25" src="img/Teeth/LowerTeeth9.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Lower Left Incisors 2')" />
                                <img class="img26" src="img/Teeth/LowerTeeth10.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Lower Left Incisors 1')" />
                                <img class="img27" src="img/Teeth/LowerTeeth11.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Lower Left Canine 1')" />
                                <img class="img28" src="img/Teeth/LowerTeeth12.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Lower Left Premolar 2')" />
                                <img class="img29" src="img/Teeth/LowerTeeth13.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Lower Left Premolar 1')" />
                                <img class="img30" src="img/Teeth/LowerTeeth14.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Lower Left Molar 3')" />
                                <img class="img31" src="img/Teeth/LowerTeeth15.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Lower Left Molar 2')" />
                                <img class="img32" src="img/Teeth/LowerTeeth16.png" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', 'Lower Left Molar 1')" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea rows="8" type="text" class="form-control" name="cDescription" id="cDescription" required></textarea>
                            <div class="invalid-feedback">
								Please enter description.
							</div>
                        </div>
                        <button type="submit" class="btn btn-primary" onclick="create()" name="createBtn">Create</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
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
        $('.createBtn1').click(function() {
            $pID = $(this).closest('tr').find('td:nth-child(1)').text().trim();
            $name = $(this).closest('tr').find('td:nth-child(2)').text().trim();
            $splitName = $name.split(" ");
            $first = $splitName[0];
            $last = $splitName[1];
            $('#PName').val($name);
            $('#Patient_ID').val($pID);
            $Date = $(this).closest('tr').find('td:nth-child(4)').text().trim();
            $service = $(this).closest('tr').find('td:nth-child(5)').text().trim();
            $DA = $(this).closest('tr').find('td:nth-child(8)').text().trim();
            $DA2 = $(this).closest('tr').find('td:nth-child(9)').text().trim();
            $mat = $(this).closest('tr').find('td:nth-child(7)').text().trim();
            $description = $(this).closest('tr').find('td:nth-child(6)').text().trim();
            $('#Date').val($Date);
            $('#service').val($service);
            $('#DA').val($DA);
            $('#DA2').val($DA2);
            $('#mat').val($mat);
            $('#description').val($description);
        });
    });
</script>
<script>
    var select_box_element = document.querySelector('#cDA1');

    dselect(select_box_element, {
        search: true
    });
    var select_box_element = document.querySelector('#cDA2');

    dselect(select_box_element, {
        search: true
    });
</script>
<script>
    function refreshPage() {
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