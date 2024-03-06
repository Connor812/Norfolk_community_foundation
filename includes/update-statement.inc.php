<?php

require_once("../config-url.php");
require_once("../functions/move-pdf.php");

if (empty($_FILES["recent-statement"]["name"])) {
    header("Location: " . ADMIN_URL . "aboutus.php?error=no_video");
    exit;
}

print_r($_FILES["recent-statement"]);

$status = check_pdf($_FILES["recent-statement"], "../assets/pdf/");


echo $status;

if ($status) {

    require_once("../db/db.php");

    // ? Update statement
    $sql = "UPDATE `recent_statement` SET `pdf` = ? WHERE id = 1;";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        header("Location: " . ADMIN_URL . "aboutus.php?error=prepare");
        $stmt->close();
        exit;
    }

    $stmt->bind_param("s", $_FILES["recent-statement"]["name"]);

    // ? This checks the execute statement
    if ($stmt->execute()) {
        // ? Check the number of affected rows
        if ($stmt->affected_rows > 0) {
            // * Successful update
            header("Location: " . ADMIN_URL . "aboutus.php?success=updated_pdf");
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