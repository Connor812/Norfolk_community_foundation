<?php

require_once("../config-url.php");

session_start();

if (empty($_POST["g-recaptcha-response"])) {
    $_SESSION["application_status"] = "recaptcha";
    header("Location: " . BASE_URL . "signup.php?error=recaptcha");
    exit;
}

$first_name = $_POST["first-name"];
$last_name = $_POST["last-name"];
$organization = $_POST["organization"];
$address = $_POST["address"];
$postal_code = $_POST["postal-code"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$pwd = $_POST["password"];
$re_pwd = $_POST["re-password"];

if (empty($first_name) || empty($last_name) || empty($organization) || empty($address) || empty($postal_code) || empty($phone) || empty($email) || empty($pwd) || empty($re_pwd)) {
    $_SESSION["application_status"] = "empty_input";
    header("Location: " . BASE_URL . "signup.php?error=empty_input");
    exit;
}

if ($pwd != $re_pwd) {
    $_SESSION["application_status"] = "pwd_doesnt_match";
    header("Location: " . BASE_URL . "signup.php?error=pwd_doesnt_match");
    exit;
}

// # Checks to see if the email Exists

require_once("../db/db.php");

$sql = "SELECT * FROM `grant_applications` WHERE email = ?;";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    // ! Handle the case where the prepared statement could not be created
    $_SESSION["application_status"] = "check_email";
    header("Location: " . BASE_URL . "signup.php?error=check_email");
    exit;
}

$stmt->bind_param("s", $email);

// ? checks to see if the execute fails
if (!$stmt->execute()) {
    $_SESSION["application_status"] = "check_email";
    header("Location: " . BASE_URL . "signup.php?error=check_email");
    exit;
}

// * Gets the Result
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION["application_status"] = "email_exists";
    header("Location: " . BASE_URL . "signup.php?error=email_exists");
    exit;
} else {

    // # -------------------------------> End of Email Check
    // Insert statement
    $sql = "INSERT INTO `grant_applications` (`first_name`, `last_name`, `organization`, `address`, `postal_code`, `phone`, `email`, `password`) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        $_SESSION["application_status"] = "failed_prepared_statement";
        header("Location: " . BASE_URL . "signup.php?error=failed_prepared_statement");
        exit;
    }

    // Bind parameters to the prepared statement

    $hashed_pwd = password_hash($pwd, PASSWORD_BCRYPT);
    $stmt->bind_param("ssssssss", $first_name, $last_name, $organization, $address, $postal_code, $phone, $email, $hashed_pwd);

    // Execute the statement
    if ($stmt->execute()) {
        // Insertion successful
        header("Location: " . BASE_URL . "login.php?redirect=ga-step-2");
        $stmt->close();
        exit;
    } else {
        // Insertion failed
        $_SESSION["application_status"] = "failed_upload_user";
        header("Location: " . BASE_URL . "signup.php?error=create_user");
        $stmt->close();
        exit;
    }
}