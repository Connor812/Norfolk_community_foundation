<!DOCTYPE html>
<html lang="en">

<?php require_once("config-url.php") ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>
        Norfolk Community Foundation
    </title>
    <!-- Custom Styles -->
    <link rel="stylesheet"
          href="<?php echo BASE_URL ?>assets/css/index.css">
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

    <?php
    require_once("config-url.php");
    require_once("db/db.php");

    $sql = "SELECT * FROM `carousel_images` WHERE id = 1;";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // * Your Code here
    
            $image_1 = $row['image_1'];
            $image_2 = $row['image_2'];
            $image_3 = $row['image_3'];
            $image_4 = $row['image_4'];
        }
    } else {
        // ! No data found
    }


    ?>

    <center>
        <!-- // % Top Image -->
        <div class="border border-dark border-2"
             style="margin-top: 50px;">
            <img src="assets/images/norfolk logo.jpg"
                 alt=""
                 width="300px">
        </div>

        <!-- // # Carousel -->
        <div class="carousel-wrapper">
            <div id="carouselExampleFade"
                 class="carousel slide carousel-fade"
                 data-bs-ride="carousel"
                 data-bs-interval="5000">
                <div class="carousel-inner">
                    <div class="carousel-item active"
                         button-id="1">
                        <img src="assets/images/<?php echo $image_1 ?>"
                             class="d-block w-100"
                             alt="...">
                    </div>
                    <div class="carousel-item"
                         button-id="2">
                        <img src="assets/images/<?php echo $image_2 ?>"
                             class="d-block w-100"
                             alt="...">
                    </div>
                    <div class="carousel-item"
                         button-id="3">
                        <img src="assets/images/<?php echo $image_3 ?>"
                             class="d-block w-100"
                             alt="...">
                    </div>
                    <div class="carousel-item"
                         button-id="4">
                        <img src="assets/images/<?php echo $image_4 ?>"
                             class="d-block w-100"
                             alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev"
                        type="button"
                        data-bs-target="#carouselExampleFade"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"
                          aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next"
                        type="button"
                        data-bs-target="#carouselExampleFade"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon"
                          aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <!-- // @ Bottom Buttons -->
        <div class="index-button-container">
            <a id="button-1"
               class="carousel-index-button button-active"
               href="<?php echo BASE_URL . "donation.php" ?>">
                Donations
            </a>
            <?php
            session_start();
            if (isset($_SESSION["stage"])) {
                if ($_SESSION["stage"] === 2) {
                    $funding_link = "ga-step-2.php";
                } elseif ($_SESSION["stage"] === 3) {
                    $funding_link = "ga-step-3.php";
                } elseif ($_SESSION["stage"] === 4) {
                    $funding_link = "ga-step-4.php";
                }
            } else {
                $funding_link = "funding.php";
            }

            ?>
            <a id="button-2"
               class="carousel-index-button"
               href="<?php echo BASE_URL . $funding_link ?>">
                Funding
            </a>
            <a id="button-3"
               class="carousel-index-button"
               href="<?php echo BASE_URL . "aboutus.php" ?>">
                About Us
            </a>
            <a id="button-4"
               class="carousel-index-button"
               href="<?php echo BASE_URL . "projects.php" ?>">
                Projects
            </a>
        </div>
    </center>

    <script src="assets/js/index.js"></script>

</body>

</html>