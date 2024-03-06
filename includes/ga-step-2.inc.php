<?php

require_once("../config-url.php");

if (empty($_POST["president"]) || empty($_POST["years-in-business"]) || empty($_POST["company-phone-number"]) || empty($_POST["charity-number"]) || empty($_POST["number-fulltime-staff"]) || empty($_POST["number-part-time-staff"]) || empty($_POST["volunteers"])) {
    header("Location: " . BASE_URL . "ga-step-2.php?error=empty_input");
    exit;
}

session_start();

$president = $_POST["president"];
$years_in_business = $_POST["years-in-business"];
$company_phone_number = $_POST["company-phone-number"];
$charity_number = $_POST["charity-number"];
$number_fulltime_staff = $_POST["number-fulltime-staff"];
$number_part_time_staff = $_POST["number-part-time-staff"];
$number_volunteers = $_POST["volunteers"];
if (!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])) {
    header("Location: " . BASE_URL . "ga-step-2.php?error=no_user_id");
    exit;
}
$user_id = $_SESSION["user_id"];

require_once("../db/db.php");

// ? Update statement
$sql = "UPDATE `grant_applications` SET `stage` = 3, `president` = ?, `years_in_business` = ?, `company_phone` = ?, `charity_number` = ?, `fulltime_staff` = ?, `part_time_staff` = ?, `volunteers` = ?, `read_status` = 'un-read' WHERE id = ?;";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    header("Location: " . BASE_URL . "ga-step-2.php?failed_prepared_statement");
    $stmt->close();
    exit;
}

$stmt->bind_param("sssssssi", $president, $years_in_business, $company_phone_number, $charity_number, $number_fulltime_staff, $number_part_time_staff, $number_volunteers, $user_id);

// ? This checks the execute statement
if ($stmt->execute()) {

    // ? Check the number of affected rows
    if ($stmt->affected_rows > 0) {
        // # Successful update
        $_SESSION["stage"] = 3;
        header("Location: " . BASE_URL . "ga-step-3.php?success=updated_user");
        $stmt->close();
        exit;
    } else {
        // & No rows were updated
        header("Location: " . BASE_URL . "ga-step-2.php?error=no_updates");
        $stmt->close();
        exit;
    }
} else {
    // ! Failed update
    header("Location: " . BASE_URL . "ga-step-2.php?error=execute_failed");
    $stmt->close();
    exit;
}