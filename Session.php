<?php
session_start();
if (isset($_SESSION['Role']) && !empty($_SESSION['Role'])) {
    switch ($_SESSION['Role']) {
        case "Dentist":
            header("Location: DentistDashboard.php");
            break;
        case "Dentist Assistant":
            header("Location: AssistantDashboard.php");
            break;
        case "Receptionist":
            header("Location: ReceptionistDashboard.php");
            break;
        case "System Admin":
            header("Location: AdminDashboard.php");
            break;
    }
} else 
    if (isset($_SESSION['Status']) && !empty($_SESSION['Status'])) 
        switch ($_SESSION['Status']) {
            case "Active";
            header("Location: PatientDashboard.php");
    break;
}
else{
    header("Location: index.php");
}
