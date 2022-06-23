<?php 
require_once('Navbar.php');

if($_SESSION['Role'] != "Dentist Assistant")
{
    header("Location: index.php");
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
    </style>
</head>
<body>
    <div class="w-100 p-3"> 
        <a href="AssistantDashboard.php" class="btn btn-primary mb-3" role="button">View Records</a>
        <table class="table table-hover ps-1">  
            <thead class="table-dark">
                <tr>
                    <th scope="col">Patient ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Treatment</th>
                    <th scope="col">Date of Visit</th>
                    <th scope="col">Materials needed</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Ian Neo</td>
                    <td>Wisdom Tooth Extraction</td>
                    <td>16/06/2022</td>
                    <td><ul>
                        <li>Anesthetic</li>
                        <li>Gauze</li>
                        <li>Topical numbing agent</li>
                    </ul></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Neo Wei Lun</td>
                    <td>Polishing and Scaling</td>
                    <td>24/07/2022</td>
                    <td><ul>
                        <li>Dental Probes</li>
                        <li>Mouth Mirror</li>
                        <li>Anesthetic</li>
                        <li>Dental Syringe</li>
                        <li>Rubber Polisher</li>
                        <li>Scaler</li>
                        <li>Suction Device</li>
                        <li>Rubber Polisher</li>
                    </ul></td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Izabel</td>
                    <td>Dental Filling</td>
                    <td>04/08/2022</td>
                    <td><ul>
                        <li>Gold</li>
                        <li>Anesthetic</li>
                        <li>Glass ionomer</li>
                    </ul></td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>Dominic</td>
                    <td>Root Canal Treatment</td>
                    <td>09/09/2022</td>
                    <td><ul>
                        <li>Endodontic Probe</li>
                        <li>Thermoplastics (Gutta-Percha)</li>
                    </ul></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</html>