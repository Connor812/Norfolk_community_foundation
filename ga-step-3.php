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
                <h1 class="sub-heading">Step 3: Project Information</h1>
                <hr>

                <form id="application-form"
                      action="includes/ga-step-3.inc.php"
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

                    <?php if (isset($_GET["success"])) {
                        $success = $_GET["success"];

                        if ($success == "updated_user") {
                            $message = "Successfully Completed Step 2!";
                        }

                        ?>
                        <div class="alert alert-success"
                             role="alert">
                            <?php echo $message ?>
                        </div>

                    <?php } ?>
                    <div class="input-field">
                        <label for="project-name">Project Name:</label>
                        <input id="project-name"
                               name="project-name"
                               type="text"
                               class="form-control"
                               placeholder="Enter Project Name"
                               required>
                    </div>
                    <div class="input-field">
                        <label for="project-description">Project Description:</label>
                        <textarea id="project-description"
                                  rows="5"
                                  name="project-description"
                                  type="tel"
                                  class="form-control"
                                  placeholder="Please Explain The Project You Wish To Receive A Grant For"
                                  required></textarea>
                    </div>
                    <div class="input-field">
                        <label for="total-budget">Total Project Budget:</label>
                        <input id="total-budget"
                               name="total-budget"
                               type="text"
                               class="form-control"
                               placeholder="Enter The Total Budget For The Project"
                               required>
                    </div>

                    <div class="input-field">
                        <label for="requested-grant">Amount Of Grant Requested:</label>
                        <input id="requested-grant"
                               name="requested-grant"
                               type="text"
                               class="form-control"
                               placeholder="Enter The Requested Grant Amount"
                               required>
                    </div>

                    <div class="input-field">
                        <label for="expenditures">Budget Expenditures:</label>
                        <textarea id="expenditures"
                                  rows="5"
                                  name="expenditures"
                                  type="tel"
                                  class="form-control"
                                  placeholder="Make a list (example): 1. Name of Expenditure / Amount / Explanation"
                                  required></textarea>
                    </div>

                    <div class="input-field">
                        <label for="other-revenue">Other Budget Revenue:</label>
                        <textarea id="other-revenue"
                                  rows="5"
                                  name="other-revenue"
                                  type="text"
                                  class="form-control"
                                  placeholder="Make a list (example): 1. Revenue Partner / Amount / Explanation"
                                  required></textarea>
                    </div>

                    <div class="input-field">
                        <label for="comment">Comments:</label>
                        <textarea id="comment"
                                  rows="5"
                                  name="comment"
                                  type="text"
                                  class="form-control"
                                  placeholder="If You Have Any More Comments About The Project, Please Leave Them Here"
                                  required></textarea>
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
                                <div class="circle"></div>
                                <div class="circle active"></div>
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