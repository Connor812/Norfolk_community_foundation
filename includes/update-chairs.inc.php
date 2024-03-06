<?php

require_once("../config-url.php");

$position = $_POST["position"];
$name = $_POST["name"];
$roll = $_POST["roll"];
$company = $_POST["company"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$id = $_POST["director-num"];

if (empty($_POST["position"]) || empty($_POST["name"]) || empty($_POST["roll"]) || empty($_POST["company"]) || empty($_POST["phone"]) || empty($_POST["email"]) || empty($_POST["director-num"])) {
    header("Location: " . ADMIN_URL . "aboutus.php?error=empty_input");
    exit;
}

require_once("../db/db.php");

// ? Update statement
$sql = "UPDATE `board_of_directors` SET `position` = ?, `name` = ?, `roll` = ?, `company` = ?, `phone` = ?, `email` = ? WHERE id = ?;";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    header("Location: " . ADMIN_URL . "aboutus.php?error=prepare");
    $stmt->close();
    exit;
}

$stmt->bind_param("ssssssi", $position, $name, $roll, $company, $phone, $email, $id);

// ? This checks the execute statement
if ($stmt->execute()) {
    // ? Check the number of affected rows
    if ($stmt->affected_rows > 0) {
        // * Successful update
        header("Location: " . ADMIN_URL . "aboutus.php?success=updated");
        $stmt->close();
        exit;
    } else {
        // ! No rows were updated
        header("Location: " . ADMIN_URL . "aboutus.php?error=no_update");
        $stmt->close();
        exit;
    }
} else {
    // ! Failed update
    header("Location: " . ADMIN_URL . "aboutus.php?error=execute");
    $stmt->close();
    exit;
}
