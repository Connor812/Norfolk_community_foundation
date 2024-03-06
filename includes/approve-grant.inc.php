<?php

require_once("../config-url.php");

if (!isset($_POST['id'])) {
    header("Location: " . ADMIN_URL . "funding.php?error=no_id");
    exit;
}

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

require_once("../db/db.php");

// ? Update statement
$sql = "UPDATE `grant_applications` SET `approved` = 'approved' WHERE id = ?;";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    header("Location: " . ADMIN_URL . "display-grant.php?error=prepare&query=$id");
    $stmt->close();
    exit;
}

$stmt->bind_param("i", $id);

// ? This checks the execute statement
if ($stmt->execute()) {
    // ? Check the number of affected rows
    if ($stmt->affected_rows > 0) {
        // * Successful update
        header("Location: " . ADMIN_URL . "display-grant.php?success=approved&query=$id");
        $stmt->close();
        mail($email, "Grant Approved", $message);
        exit;
    } else {
        // ! No rows were updated
        header("Location: " . ADMIN_URL . "display-grant.php?error=no_update&query=$id");
        $stmt->close();
        exit;
    }
} else {
    // ! Failed update
    header("Location: " . ADMIN_URL . "display-grant.php?error=execute&query=$id");
    $stmt->close();
    exit;
}

