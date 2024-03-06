<?php

require_once("../config-url.php");

// @ If sent here from the signup page after a user creates an account, they will have a redirect after logging in to go back to the step they were at the form
if (isset($_GET["redirect"])) {
    $location = "ga-step-2.php";
    $params = "&redirect=ga-step-2";
} else {
    $location = "donation.php";
    $params = "";
}


if (empty($_POST["email"]) || empty($_POST["password"])) {
    header("Location: " . BASE_URL . "login.php?error=empty_input$params");
    exit;
}

$email = $_POST["email"];
$pwd = $_POST["password"];

require_once("../db/db.php");

$sql = "SELECT `id`, `first_name`, `email`, `password`, `stage` FROM `grant_applications` WHERE email = ?;";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    // ! Handle the case where the prepared statement could not be created
    header("Location: " . BASE_URL . "login.php?error=failed_prepare_statement$params");
    exit;
}

$stmt->bind_param("s", $email);

// ? checks to see if the execute fails
if (!$stmt->execute()) {
    header("Location: " . BASE_URL . "login.php?error=execute_failed$params");
    $stmt->close();
    exit;
}

// * Gets the Result
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // * Your Code here
        $saved_password = $row["password"];
        $first_name = $row["first_name"];
        $stage = $row["stage"];
        $user_id = $row["id"];

        $checkPassword = password_verify($pwd, $saved_password);

        if ($checkPassword === true) {
            session_start();
            $_SESSION["user_id"] = $user_id;
            $_SESSION["ga_username"] = $first_name;
            $_SESSION["stage"] = $stage;
            $_SESSION["application_status"] = "logged in";

            header("Location: " . BASE_URL . "$location?success=logged_in");
            exit;
        } else {
            header("Location: " . BASE_URL . "login.php?error=incorrect_pwd$params");
            exit;
        }
    }
} else {
    // ! No data found
    header("Location: " . BASE_URL . "login.php?error=no_user$params");
    $stmt->close();
    exit;
}
