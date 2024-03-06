<!DOCTYPE html>
<html lang="en">

<head>

    <?php require_once("config-url.php"); ?>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Norfolk Community Foundation - About Us</title>
    <link rel="stylesheet"
          href="<?php echo BASE_URL ?>assets/css/general.css">
    <link rel="stylesheet"
          href="<?php echo BASE_URL ?>assets/css/aboutus.css">
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
    require_once("components/header.php");
    require_once("db/db.php");

    $sql = "SELECT * FROM `board_of_directors`;";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        // $data now contains the entire mysqli response as an array
    } else {
        // ! No data found
    }

    ?>


    <main class="">

        <img class="side-images left"
             src="assets/images/donation-left.jpg"
             alt="Norfolk">

        <div class="content-container">
            <center>
                <h1 class="heading">About Us</h1>
                <hr>

                <!-- // % Total Donations -->
                <div class="about-donations row">
                    <div class="col-12 col-sm-6">
                        <p>The foundation was formed in 1986 and has accumulated capital of:</p>
                        <span>$4.3 Million</span>
                    </div>
                    <div class="col-12 col-sm-6">
                        <p>Donations made to recipients in Norfolk County annually exceed:</p>
                        <span>$140,000</span>
                    </div>
                </div>

                <?php

                $sql = "SELECT * FROM `aboutus_video` WHERE id = 1;";

                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        // * Your Code here
                        $video = $row["video"];
                    }
                } else {
                    // ! No data found
                }
                ?>

                <video class="m-5"
                       width="80%"
                       height="auto"
                       controls
                       poster="assets/images/pasted-image copy.jpg">
                    <source src="assets/videos/<?php echo $video ?>"
                            type="video/mp4">
                    Your browser does not support the video tag.
                </video>

                <!-- // $ Board of directors upper part -->
                <h1 class="heading">Board Of Directors</h1>
                <hr>

                <div class="director-container row">
                    <div class="col-12 col-sm-6 justify-content-center">
                        <div class="director-item text-start">
                            <b>
                                <?php echo $data[0]["position"] ?>
                            </b><br>
                            <?php echo $data[0]["name"] ?> <br>
                            <?php echo $data[0]["roll"] ?> <br>
                            <?php echo $data[0]["company"] ?> <br>
                            <?php echo $data[0]["phone"] ?> <br>
                            <?php echo $data[0]["email"] ?> <br>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 justify-content-center">
                        <div class="director-item text-start">
                            <b>
                                <?php echo $data[1]["position"] ?>
                            </b><br>
                            <?php echo $data[1]["name"] ?> <br>
                            <?php echo $data[1]["roll"] ?> <br>
                            <?php echo $data[1]["company"] ?> <br>
                            <?php echo $data[1]["phone"] ?> <br>
                            <?php echo $data[1]["email"] ?> <br>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 justify-content-center">
                        <div class="director-item text-start">
                            <b>
                                <?php echo $data[2]["position"] ?>
                            </b><br>
                            <?php echo $data[2]["name"] ?> <br>
                            <?php echo $data[2]["roll"] ?> <br>
                            <?php echo $data[2]["company"] ?> <br>
                            <?php echo $data[2]["phone"] ?> <br>
                            <?php echo $data[2]["email"] ?> <br>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 justify-content-center">
                        <div class="director-item text-start">
                            <b>
                                <?php echo $data[3]["position"] ?>
                            </b><br>
                            <?php echo $data[3]["name"] ?> <br>
                            <?php echo $data[3]["roll"] ?> <br>
                            <?php echo $data[3]["company"] ?> <br>
                            <?php echo $data[3]["phone"] ?> <br>
                            <?php echo $data[3]["email"] ?> <br>
                        </div>
                    </div>
                </div>

                <hr>
                <!-- // @ Board of directors Lower part -->
                <div class="director-container row justify-content-center">
                    <div class="col-12 col-sm-4 justify-content-center">
                        <div class="director-item text-start">
                            <b>
                                <?php echo $data[4]["position"] ?>
                            </b><br>
                            <?php echo $data[4]["name"] ?> <br>
                            <?php echo $data[4]["roll"] ?> <br>
                            <?php echo $data[4]["company"] ?> <br>
                            <?php echo $data[4]["phone"] ?> <br>
                            <?php echo $data[4]["email"] ?> <br>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 justify-content-center">
                        <div class="director-item text-start">
                            <b>
                                <?php echo $data[5]["position"] ?>
                            </b><br>
                            <?php echo $data[5]["name"] ?> <br>
                            <?php echo $data[5]["roll"] ?> <br>
                            <?php echo $data[5]["company"] ?> <br>
                            <?php echo $data[5]["phone"] ?> <br>
                            <?php echo $data[5]["email"] ?> <br>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 justify-content-center">
                        <div class="director-item text-start">
                            <b>
                                <?php echo $data[6]["position"] ?>
                            </b><br>
                            <?php echo $data[6]["name"] ?> <br>
                            <?php echo $data[6]["roll"] ?> <br>
                            <?php echo $data[6]["company"] ?> <br>
                            <?php echo $data[6]["phone"] ?> <br>
                            <?php echo $data[6]["email"] ?> <br>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 justify-content-center">
                        <div class="director-item text-start">
                            <b>
                                <?php echo $data[7]["position"] ?>
                            </b><br>
                            <?php echo $data[7]["name"] ?> <br>
                            <?php echo $data[7]["roll"] ?> <br>
                            <?php echo $data[7]["company"] ?> <br>
                            <?php echo $data[7]["phone"] ?> <br>
                            <?php echo $data[7]["email"] ?> <br>
                        </div>
                    </div>
                </div>

            </center>
            <?php require_once("components/footer.php"); ?>
        </div>

        <img class="side-images right"
             src="assets/images/donation-right.jpg"
             alt="Norfolk">

    </main>



</body>

</html>