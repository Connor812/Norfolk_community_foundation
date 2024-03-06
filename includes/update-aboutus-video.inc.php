<?php

require_once("../config-url.php");
require_once("../functions/move-video.php");

if (empty($_FILES["aboutus-video"]["name"])) {
    header("Location: " . ADMIN_URL . "aboutus.php?error=no_video");
    exit;
}

print_r($_FILES["aboutus-video"]);

$status = check_video($_FILES["aboutus-video"], "../assets/videos/");


if ($status) {

    require_once("../db/db.php");

    // ? Update statement
    $sql = "UPDATE `aboutus_video` SET `video` = ? WHERE id = 1;";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        header("Location: " . ADMIN_URL . "aboutus.php?error=prepare");
        $stmt->close();
        exit;
    }

    $stmt->bind_param("s", $_FILES["aboutus-video"]["name"]);

    // ? This checks the execute statement
    if ($stmt->execute()) {
        // ? Check the number of affected rows
        if ($stmt->affected_rows > 0) {
            // * Successful update
            header("Location: " . ADMIN_URL . "aboutus.php?success=updated_video");
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

} else {
    header("Location: " . ADMIN_URL . "aboutus.php?error=$status");
    exit;
}