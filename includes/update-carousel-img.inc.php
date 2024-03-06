<?php

require_once("../config-url.php");

// Check if a file was submitted
if (!isset($_FILES["carousel-img"])) {
    header("Location: " . ADMIN_URL . "home.php?error=no_img");
    exit;
}

if (!isset($_GET["img_num"])) {
    header("Location: " . ADMIN_URL . "home.php?error=no_img_num");
    exit;
}

$image = $_FILES["carousel-img"];
$image_num = $_GET["img_num"];

require_once("../functions/move-image.php");

$status = check_image($image, "../assets/images/");

if ($status === "uploading_img") {
    header("Location: " . ADMIN_URL . "home.php?error=uploading_img");
    exit;
} elseif ($status === "file_type") {
    header("Location: " . ADMIN_URL . "home.php?error=file_type");
    exit;
} elseif ($status === "img_size") {
    header("Location: " . ADMIN_URL . "home.php?error=img_size");
    exit;
} elseif ($status === "moving_file") {
    header("Location: " . ADMIN_URL . "home.php?error=moving_file");
    exit;
}

require_once("../db/db.php");

// ? Update statement
$sql = "UPDATE `carousel_images` SET `image_$image_num` = ? WHERE id = 1;";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    header("Location: " . ADMIN_URL . "home.php?error=prepared_statement");
    $stmt->close();
    exit;
}

$stmt->bind_param("s", $image["name"]);

// ? This checks the execute statement
if ($stmt->execute()) {
    // ? Check the number of affected rows
    if ($stmt->affected_rows > 0) {
        // * Successful update
        header("Location: " . ADMIN_URL . "home.php?success=uploaded_img");
        $stmt->close();
        exit;
    } else {
        // ! No rows were updated
        header("Location: " . ADMIN_URL . "home.php?error=no_upload");
        $stmt->close();
        exit;
    }
} else {
    // ! Failed update
    header("Location: " . ADMIN_URL . "home.php?error=execute");
    $stmt->close();
    exit;
}
