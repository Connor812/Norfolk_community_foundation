<?php

require_once("../config-url.php");

$heading = $_POST["heading"];
$description = $_POST["description"];
$image = $_FILES["image"];
$old_image = $_POST["old-image"];

// Checks For Empty Variables
if (empty($heading) || empty($description)) {
    header("Location: " . ADMIN_URL . "projects.php?error=empty_input");
    exit;
}

if (!isset($_GET["project"])) {
    header("Location: " . ADMIN_URL . "projects.php?error=project_not_found");
    exit;
}

$project_num = $_GET["project"];

// Checks To See What Image To Use
if (empty($image["name"])) {
    $image = $old_image;
} else {
    require_once("../functions/move-image.php");

    $status = check_image($image, "../assets/images/");

    if ($status !== true) {
        header("Location: " . ADMIN_URL . "projects.php?error=$status");
        exit;
    }

    $image = $image["name"];

}

require_once("../db/db.php");

// ? Update statement
$sql = "UPDATE `projects` SET heading_$project_num = ?, description_$project_num = ?, image_$project_num = ?  WHERE id = 1;";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    header("Location: " . ADMIN_URL . "projects.php?error=prepare");
    $stmt->close();
    exit;
}

$stmt->bind_param("sss", $heading, $description, $image);

// ? This checks the execute statement
if ($stmt->execute()) {
    // ? Check the number of affected rows
    if ($stmt->affected_rows > 0) {
        // * Successful update
        header("Location: " . ADMIN_URL . "projects.php?success=update");
        $stmt->close();
        exit;
    } else {
        // ! No rows were updated
        header("Location: " . ADMIN_URL . "projects.php?error=no_update");
        $stmt->close();
        exit;
    }
} else {
    // ! Failed update
    header("Location: " . ADMIN_URL . "projects.php?error=execute");
    $stmt->close();
    exit;
}