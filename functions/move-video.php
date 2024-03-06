<?php

function check_video($video, $uploadDirectory)
{

    // Check for errors during file upload
    if ($video['error'] > 0) {
        return "uploading_video";
    }

    // Check file type
    $allowedTypes = ['video/mp4', 'video/mpeg', 'video/quicktime']; // Add more if needed
    if (!in_array($video['type'], $allowedTypes)) {
        return "file_type";
    }

    // Check file size
    $maxFileSize = 100 * 1024 * 1024; // 100 MB in bytes
    if ($video['size'] > $maxFileSize) {
        return "video_size";
    }

    // Check if the file already exists in the directory
    $videoPathName = $uploadDirectory . $video['name'];

    if (!file_exists($videoPathName)) {
        // Move the file to the upload directory
        if (move_uploaded_file($video['tmp_name'], $videoPathName)) {
            return true;
        } else {
            return "moving_file";
        }
    } else {
        return true;
    }
}