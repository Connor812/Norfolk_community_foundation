<?php

require_once("../config-url.php");

if (empty($_POST["project-name"]) || empty($_POST["project-description"]) || empty($_POST["total-budget"]) || empty($_POST["requested-grant"]) || empty($_POST["expenditures"]) || empty($_POST["other-revenue"]) || empty($_POST["comment"])) {
    header("Location: " . BASE_URL . "ga-step-3.php?error=empty_input");
    exit;
}

session_start();

$project_name = $_POST["project-name"];
$project_description = $_POST["project-description"];
$total_budget = $_POST["total-budget"];
$requested_grant = $_POST["requested-grant"];
$expenditures = $_POST["expenditures"];
$other_revenue = $_POST["other-revenue"];
$comment = $_POST["comment"];
if (!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])) {
    header("Location: " . BASE_URL . "ga-step-3.php?error=no_user_id");
    exit;
}
$user_id = $_SESSION["user_id"];

require_once("../db/db.php");

// ? Update statement
$sql = "UPDATE `grant_applications` SET `stage` = 4, `project_name` = ?, `project_description` = ? , `total_budget` = ?, `requested_amount` = ?, `expenditures` = ?, `other_revenue` = ?, `comment` = ?, `read_status` = 'un-read' WHERE id = ?;";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    header("Location: " . BASE_URL . "ga-step-3.php?failed_prepared_statement");
    $stmt->close();
    exit;
}

$stmt->bind_param("sssssssi", $project_name, $project_description, $total_budget, $requested_grant, $expenditures, $other_revenue, $comment, $user_id);

// ? This checks the execute statement
if ($stmt->execute()) {

    // ? Check the number of affected rows
    if ($stmt->affected_rows > 0) {
        // # Successful update
        $_SESSION["stage"] = 4;
        header("Location: " . BASE_URL . "ga-step-4.php?success=updated_user");
        $stmt->close();
        exit;
    } else {
        // & No rows were updated
        header("Location: " . BASE_URL . "ga-step-3.php?error=no_updates");
        $stmt->close();
        exit;
    }
} else {
    // ! Failed update
    header("Location: " . BASE_URL . "ga-step-3.php?error=execute_failed");
    $stmt->close();
    exit;
}