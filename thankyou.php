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
          href="<?php echo BASE_URL ?>assets/css/thankyou.css">
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

        <div class="content-container d-flex align-items-center justify-content-center">
            <center>
                <div id="loading"
                     class="spinner-border text-success"
                     role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>

                <div class="hide"
                     id="thank-you">

                    <img id="logo"
                         src="assets/images/norfolk logo.jpg"
                         alt="">
                    <div class="d-flex align-items-center">
                        <img src="assets/images/leafs.jpg"
                             alt=""
                             width="100px"
                             height="100px">
                        <div>

                            <h1 class="green sub-heading mx-4">Thank you for your donation!</h1>

                        </div>
                        <img src="assets/images/leafs.jpg"
                             alt=""
                             width="100px"
                             height="100px">
                    </div>
                    <a class="button"
                       href="<?php echo BASE_URL ?>">Return To Site</a>
                </div>

                <div class="hide"
                     id="error">
                    <img id="logo"
                         src="assets/images/norfolk logo.jpg"
                         alt="">
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="assets/images/leafs.jpg"
                             alt=""
                             width="100px"
                             height="100px">
                        <div>

                            <h1 class="green sub-heading mx-4">Payment Declined.</h1>

                        </div>
                        <img src="assets/images/leafs.jpg"
                             alt=""
                             width="100px"
                             height="100px">
                    </div>
                    <p>There was an issue with connecting to paypal and the payment was decline. Please go back and try
                        again.</p>
                    <a class="button"
                       href="<?php echo BASE_URL ?>">Return To Site</a>
                </div>
            </center>
        </div>

        <img class="side-images right"
             src="assets/images/donation-right.jpg"
             alt="Norfolk">
    </main>

    <script type="module"
            src="assets/js/thankyou.js"></script>

</body>

</html>