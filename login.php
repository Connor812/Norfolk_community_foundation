<!DOCTYPE html>
<html lang="en">

<?php require_once("config-url.php") ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Norfolk Community Foundation - Donations</title>
    <link rel="stylesheet"
          href="<?php echo BASE_URL ?>assets/css/general.css">
    <link rel="stylesheet"
          href="<?php echo BASE_URL ?>assets/css/login.css">
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
                <?php
                // @ If you regularly login, it will take you to your profile, if you are directed to the log in after you sign up for an account, it will redirect you back to the grant application form
                if (isset($_GET["redirect"])) {
                    $action = "includes/login.inc.php?redirect=ga-step-2";
                } else {
                    $action = "includes/login.inc.php";
                }
                ?>
                <form id="login-form"
                      class="login-form"
                      action="<?php echo $action ?>"
                      method="post">
                    <h2 class="fs-1">NORFOLK COMMUNITY FOUNDATION</h2>
                    <h2 class="fs-1">LOGIN</h2>

                    <?php
                    if (isset($_GET["error"])) {
                        $error = $_GET["error"];

                        if ($error == "no_user") {
                            $message = "No User Exists With That Email. Please Try Again.";
                        } elseif ($error == "incorrect_pwd") {
                            $message = "Incorrect Password. Please Try Again.";
                        } elseif ($error == "empty_input") {
                            $message = "Cannot Leave Input Blank. Please Try Again.";
                        } elseif ($error == "failed_prepare_statement") {
                            $message = "Failed Connecting To The Server. Please Try Again.";
                        } elseif ($error == "execute_failed") {
                            $message = "Failed Searching For User. Please Try Again.";
                        } elseif ($error == "not_logged_in") {
                            $message = "Not Logged In. Please Login Before Continuing.";
                        }
                        ?>
                        <div class="alert alert-danger"
                             role="alert">
                            <?php echo $message ?>
                        </div>
                    <?php } ?>

                    <?php
                    if (isset($_GET["success"])) {
                        $success = $_GET["success"];

                        if ($success === "created_new_user") {
                            $message = "You Have Successfully Created A New Account. Please Login To Continue To The Grant Application";
                        }
                        ?>
                        <div class="alert alert-primary"
                             role="alert">
                            <?php echo $message ?>
                        </div>
                    <?php } ?>




                    <div class="input-container">
                        <img class="leaf-img"
                             src="assets/images/leafs.jpg"
                             alt="leafs"
                             width="100px"
                             height="100px">
                        <div>

                            <label for="email">Email</label>
                            <input type="text"
                                   class="form-control"
                                   placeholder="Enter Email"
                                   name="email">
                            <label for="email">Password</label>
                            <input type="password"
                                   class="form-control"
                                   placeholder="Enter Password"
                                   name="password">
                        </div>
                        <img class="leaf-img"
                             src="assets/images/leafs.jpg"
                             alt="leafs"
                             width="100px"
                             height="100px">
                    </div>
                    <button class="button">Login</button>


                </form>
            </center>
        </div>

        <img class="side-images right"
             src="assets/images/donation-right.jpg"
             alt="Norfolk">
    </main>
</body>

</html>