<?php

function check_image($image, $uploadDirectory)
{

    // Check for errors during file upload
    if ($image['error'] > 0) {
        return "uploading_img";
    }

    // Check file type
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif']; // Add more if needed
    if (!in_array($image['type'], $allowedTypes)) {
        return "file_type";
    }

    // Check file size
    $maxFileSize = 50 * 1024 * 1024; // 50 MB in bytes
    if ($image['size'] > $maxFileSize) {
        return "img_size";
        // header("Location: " . ADMIN_URL . "home.php?error=img_size");
    }

    // Check if the file already exists in the directory
    $imagePathName = $uploadDirectory . $image['name'];

    if (!file_exists($imagePathName)) {
        // Move the file to the upload directory
        if (move_uploaded_file($image['tmp_name'], $imagePathName)) {
            return true;
        } else {
            return "moving_file";
        }
    } else {
        return true;
    }
}