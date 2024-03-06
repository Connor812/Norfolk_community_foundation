<?php

function check_pdf($pdf, $uploadDirectory)
{

    // Check for errors during file upload
    if ($pdf['error'] > 0) {
        return "uploading_pdf";
    }

    // Check file type
    $allowedTypes = ['application/pdf'];
    if (!in_array($pdf['type'], $allowedTypes)) {
        return "file_type";
    }

    // Check file size
    $maxFileSize = 50 * 1024 * 1024; // 50 MB in bytes
    if ($pdf['size'] > $maxFileSize) {
        return "pdf_size";
        // header("Location: " . ADMIN_URL . "home.php?error=pdf_size");
    }

    // Check if the file already exists in the directory
    $pdfPathName = $uploadDirectory . $pdf['name'];

    if (!file_exists($pdfPathName)) {
        // Move the file to the upload directory
        if (move_uploaded_file($pdf['tmp_name'], $pdfPathName)) {
            return true;
        } else {
            return "moving_file";
        }
    } else {
        return true;
    }
}