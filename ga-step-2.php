<?php
require_once("config-url.php");
session_start();

if (!isset($_SESSION["ga_username"])) {
    $_SESSION["application_status"] = "not_logged_in";
    header("Location: " . BASE_URL . "login.php?error=not_logged_in");
    exit;
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
</head>

<body>
    <?php require_once("components/header.php"); ?>
    <main class="">

        <img class="side-images left"
             src="assets/images/donation-left.jpg"
             alt="Norfolk">

        <div class="content-container">
            <center>
                <h1 class="heading">Welcome to the grant generator,
                    <?php echo $_SESSION["ga_username"] ?>
                </h1>
                <hr>
                <p>General Introduction - ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                    doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                    architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit
                    aspernatur aut odit aut </p>
                <h1 class="sub-heading">Step 2: Organization Information</h1>
                <hr>

                <form id="application-form"
                      action="includes/ga-step-2.inc.php"
                      method="post"
                      class="signup-form">
                    <?php if (isset($_GET["error"])) {
                        $error = $_GET["error"];

                        if ($error == "empty_input") {
                            $message = "Cannot Leave Any Of The Spaces Blank";
                        } elseif ($error == "no_user_id") {
                            $message = "Server Error, Could Not Find User Id. Please Try Again.";
                        } elseif ($error == "failed_prepared_statement") {
                            $message = "Server Error, Could Not Process Form. Please Try Again.";
                        } elseif ($error == "execute_failed") {
                            $message = "Server Error, Could Not Execute Form. Please Try Again.";
                        } elseif ($error == "no_updates") {
                            $message = "No Updates Made. Please Try Again.";
                        }

                        ?>
                        <div class="alert alert-danger"
                             role="alert">
                            <?php echo $message ?>
                        </div>

                    <?php } ?>
                    <div class="input-field">
                        <label for="president">President or Manager:</label>
                        <input id="president"
                               name="president"
                               type="text"
                               class="form-control"
                               placeholder="Enter President/Manager Full Name"
                               required>
                    </div>

                    <div class="input-field">
                        <label for="years-in-business">Years in Business:</label>
                        <input id="years-in-business"
                               name="years-in-business"
                               type="number"
                               class="form-control"
                               placeholder="Enter Year"
                               required>
                    </div>

                    <div class="input-field">
                        <label for="company-phone-number">Company Phone:</label>
                        <input id="company-phone-number"
                               name="company-phone-number"
                               type="tel"
                               class="form-control"
                               placeholder="Enter Name Of Company Phone Number"
                               required>
                    </div>

                    <div class="input-field">
                        <label for="charity-number">Charity Registration Number:</label>
                        <input id="charity-number"
                               name="charity-number"
                               type="text"
                               class="form-control"
                               placeholder="Enter Charity Number"
                               required>
                    </div>

                    <div class="input-field">
                        <label for="number-fulltime-staff">Full Time Staff:</label>
                        <input id="number-fulltime-staff"
                               name="number-fulltime-staff"
                               type="text"
                               class="form-control"
                               placeholder="Enter Number Of Full Time Staff"
                               required>
                    </div>

                    <div class="input-field">
                        <label for="number-part-time-staff">Part Time Staff:</label>
                        <input id="number-part-time-staff"
                               name="number-part-time-staff"
                               type="text"
                               class="form-control"
                               placeholder="Enter Number Of Part Time Staff"
                               required>
                    </div>

                    <div class="input-field">
                        <label for="volunteers">Volunteers</label>
                        <input id="volunteers"
                               name="volunteers"
                               type="text"
                               class="form-control"
                               placeholder="Enter Number Of Volunteers"
                               required>
                    </div>

                    <div class="submit-container">

                        <img class="leaf-img"
                             src="assets/images/leafs.jpg"
                             alt="leafs"
                             width="100px"
                             height="100px">

                        <div class="next-btn-container">
                            <div class="d-flex align-items-center gap-1">
                                <div class="circle"></div>
                                <div class="circle active"></div>
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