<?php

require_once("config-url.php");
session_start();

if (!isset($_SESSION["stage"])) {

    if (empty(isset($_POST["check1"])) || empty(isset($_POST["check2"])) || empty(isset($_POST["check3"])) || empty(isset($_POST["check4"]))) {
        session_destroy();
        header("Location: " . BASE_URL . "funding.php?error=checklist");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Norfolk Community Foundation - Sign Up</title>

    <link rel="stylesheet"
          href="<?php echo BASE_URL ?>assets/css/general.css">
    <link rel="stylesheet"
          href="<?php echo BASE_URL ?>assets/css/grand-application.css">
    <!-- Boostrap Links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <!-- recaptcha API for the I'm not a robot -->
    <script src="https://www.google.com/recaptcha/api.js"
            async
            defer></script>

</head>

<body>

    <?php require_once("components/header.php"); ?>
    <main class="">

        <img class="side-images left"
             src="assets/images/donation-left.jpg"
             alt="Norfolk">

        <div class="content-container">
            <center>
                <h1 class="heading">Welcome to the grant generator</h1>
                <hr>
                <p>General Introduction - ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                    doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                    architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit
                    aspernatur aut odit aut </p>
                <p class="blue">
                    Applications are kept confidential - All rights reserved - Norfolk Community Foundation
                </p>
                <h1 class="sub-heading">Step 1: Create An Account</h1>
                <hr>

                <form id="application-form"
                      action="includes/signup.inc.php"
                      method="post"
                      class="signup-form">
                    <?php if (isset($_GET["error"])) {
                        $error = $_GET["error"];

                        if ($error == "recaptcha") {
                            $message = "Please Solve I'm Not A Robot Test";
                        } elseif ($error == "empty_input") {
                            $message = "Cannot Leave Any Of The Spaces Blank";
                        } elseif ($error == "pwd_doesnt_match") {
                            $message = "Password Doesn't Match";
                        } elseif ($error == "create_user") {
                            $message = "Failed To Register New User. Please Try Again.";
                        } elseif ($error == "failed_prepared_statement") {
                            $message = "Failed Connection To Server. Please Try Again.";
                        } elseif ($error == "check_email") {
                            $message = "Failed Connection To Server When Looking For Email. Please Try Again.";
                        } elseif ($error == "email_exists") {
                            $message = "Email Already Exists. Please Try Again.";
                        }

                        ?>
                        <div class="alert alert-danger"
                             role="alert">
                            <?php echo $message ?>
                        </div>

                    <?php } ?>

                    <div class="input-field">
                        <label for="first-name">First Name:</label>
                        <input id="first-name"
                               name="first-name"
                               type="text"
                               class="form-control"
                               placeholder="Enter First Name"
                               required>
                    </div>

                    <div class="input-field">
                        <label for="last-name">Last Name:</label>
                        <input id="last-name"
                               name="last-name"
                               type="text"
                               class="form-control"
                               placeholder="Enter Last Name"
                               required>
                    </div>

                    <div class="input-field">
                        <label for="organization">Name Of Organization:</label>
                        <input id="organization"
                               name="organization"
                               type="text"
                               class="form-control"
                               placeholder="Enter Name Of Organization"
                               required>
                    </div>

                    <div class="input-field">
                        <label for="address">Address:</label>
                        <input id="address"
                               name="address"
                               type="text"
                               class="form-control"
                               placeholder="Enter Address"
                               required>
                    </div>

                    <div class="input-field">
                        <label for="postal-code">Postal Code:</label>
                        <input id="postal-code"
                               name="postal-code"
                               type="text"
                               class="form-control"
                               placeholder="Enter Postal Code"
                               required>
                    </div>

                    <div class="input-field">
                        <label for="phone">Phone:</label>
                        <input id="phone"
                               name="phone"
                               type="text"
                               class="form-control"
                               placeholder="Enter Phone Number"
                               required>
                    </div>

                    <div class="input-field">
                        <label for="email">Email:</label>
                        <input id="email"
                               name="email"
                               type="email"
                               class="form-control"
                               placeholder="Enter Email"
                               required>
                    </div>

                    <div class="input-field">
                        <label for="password">Password:</label>
                        <input id="password"
                               name="password"
                               type="password"
                               class="form-control"
                               placeholder="Enter Password"
                               required>
                    </div>
                    <div class="input-field">
                        <label for="re-password">Repeat Enter Password:</label>
                        <input id="re-password"
                               name="re-password"
                               type="password"
                               class="form-control"
                               placeholder="Repeat Enter Password"
                               required>
                    </div>

                    <div class="submit-container">

                        <img class="leaf-img"
                             src="assets/images/leafs.jpg"
                             alt="leafs"
                             width="100px"
                             height="100px">

                        <div class="next-btn-container">
                            <div>
                                <div class="g-recaptcha"
                                     data-sitekey="6Lf7mHQpAAAAADW7S_6v5ffOVPAb_iOF7RqGeYhU"></div>
                            </div>
                            <div class="d-flex align-items-center gap-1">
                                <div class="circle active"></div>
                                <div class="circle"></div>
                                <div class="circle"></div>
                                <div class="circle"></div>
                                <button id="submit"
                                        type="submit"
                                        style="background: none; border: none;">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="50"
                                         height="50"
                                         fill="currentColor"
                                         class="next-arrow"
                                         viewBox="0 0 16 16">
                                        <path
                                              d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <img class="leaf-img"
                             src="assets/images/leafs.jpg"
                             alt="leafs"
                             width="100px"
                             height="100px">
                    </div>

                </form>

            </center>

        </div>

        <img class="side-images right"
             src="assets/images/donation-right.jpg"
             alt="Norfolk">
    </main>

    <script src="assets/js/application.js"></script>

</body>

</html>