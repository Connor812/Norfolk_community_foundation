<?php

require_once("../config-url.php");


$featured = $_POST["featured"] ? 1 : 0;
$name = $_POST["name"];
$fund_name = "$name fund";
$description = $_POST["description"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$category = $_POST["category"];
$image = $_FILES["image"];
$new_category = $_POST["new-category"];
$category_description = $_POST["category-description"];

// Check if any of the variables are empty and echo them out
if (empty($name) || empty($description) || empty($phone) || empty($email)) {
    header("Location: " . ADMIN_URL . "new-fund.php?error=empty_input");
    exit;
}

if (empty($new_category) && empty($category)) {
    header("Location: " . ADMIN_URL . "new-fund.php?error=empty_category");
    exit;
}

// Check if there is an image uploaded
if (!empty($_FILES["image"]["name"])) {
    // Image is uploaded
    require_once("../functions/move-image.php");

    $status = check_image($image, "../assets/images/");

    if ($status === true) {
        // Image is uploaded successfully
        $image = $image['name'];
    } else {
        // Image is not uploaded
        header("Location: " . ADMIN_URL . "new-fund.php?error=$status");
        exit;
    }
} else {
    // Image is not uploaded
    $image = NULL;
}

require_once("../db/db.php");

// Start transaction
$conn->begin_transaction();

try {

    // if category is empty then add new category
    if (empty($category)) {
        try {
            $sql = "INSERT INTO recipient_category (category, description) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $conn->error);
            }
            $stmt->bind_param("ss", $new_category, $category_description);
            if (!$stmt->execute()) {
                throw new Exception("Error executing statement: " . $stmt->error);
            }
            $category = $new_category;
        } catch (Exception $e) {
            // Handle the exception
            header("Location: " . ADMIN_URL . "new_fund.php?error=" . urlencode($e->getMessage()));
            exit;
        }
    }

    // Insert statement
    $sql = "INSERT INTO `recipients` (`name`, `description`, `image`, `category`, `featured`, `fund_name`, `phone`, `email`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        header("Location: " . ADMIN_URL . "new_fund.php?error=prepare");
        $stmt = $conn->prepare($sql);
        exit;
    }

    // Bind parameters to the prepared statement
    $stmt->bind_param("ssssssss", $name, $description, $image, $category, $featured, $fund_name, $phone, $email);

    // Execute the statement
    if ($stmt->execute()) {
        // Insertion successful
        header("Location: " . ADMIN_URL . "new_fund.php?success=inserted_fund");
        $conn->commit();
        exit;
    } else {
        // Insertion failed
        header("Location: " . ADMIN_URL . "new_fund.php?error=insertion_failed");
        $stmt->close();
        $conn->rollback();
        exit;
    }
} catch (mysqli_sql_exception $exception) {

    $conn->rollback();
}

$conn->close();

