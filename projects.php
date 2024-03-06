<!DOCTYPE html>
<html lang="en">

<?php require_once("config-url.php") ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Norfolk Community Foundation - Projects</title>

    <link rel="stylesheet"
          href="<?php echo BASE_URL ?>assets/css/general.css">
    <link rel="stylesheet"
          href="<?php echo BASE_URL ?>assets/css/projects.css">
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
                <h1 class="heading">PROJECTS</h1>
                <hr>
                <p class="fs-4">The board is made up of people from all areas of Norfolk County.</p>
                <p class="fs-6">The organization is operated completely by a community-minded board of volunteers.</p>


                <!-- // & Projects container -->

                <?php
                require_once("db/db.php");

                $sql = "SELECT * FROM `projects` WHERE id = 1;";

                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        // * Your Code here
                
                        $heading_1 = $row['heading_1'];
                        $description_1 = $row['description_1'];
                        $image_1 = $row['image_1'];
                        $heading_2 = $row['heading_2'];
                        $description_2 = $row['description_2'];
                        $image_2 = $row['image_2'];
                        $heading_3 = $row['heading_3'];
                        $description_3 = $row['description_3'];
                        $image_3 = $row['image_3'];

                    }
                } else {
                    // ! No data found
                }


                ?>

                <div class="projects-container row justify-content-evenly">

                    <div class="col-4">
                        <span class="fs-2">
                            <?php echo $heading_1 ?>
                        </span>
                        <img src="assets/images/<?php echo $image_1 ?>"
                             alt="<?php echo $heading_1 ?>">
                        <p class="f-5">
                            <?php echo $description_1 ?>
                        </p>
                    </div>

                    <div class="col-4">
                        <span class="fs-2">
                            <?php echo $heading_1 ?>
                        </span>
                        <img src="assets/images/<?php echo $image_2 ?>"
                             alt="<?php echo $heading_1 ?>">
                        <p class="f-5">
                            <?php echo $description_2 ?>
                        </p>
                    </div>

                    <div class="col-4">
                        <span class="fs-2">
                            <?php echo $heading_1 ?>
                        </span>
                        <img src="assets/images/<?php echo $image_3 ?>"
                             alt="<?php echo $heading_3 ?>">
                        <p class="f-5">
                            <?php echo $description_3 ?>
                        </p>
                    </div>

                </div>

                <!-- // ! Carousel -->

                <div id="carousel"
                     class="carousel slide"
                     data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active"
                             data-bs-interval="5000">
                            <img src="assets/images/sunset-reflects-tranquil-scene-on-abandoned-fishing-boat-nautical-vessel-generated-by-ai-free-photo.jpg"
                                 class="d-block w-100"
                                 alt="...">
                        </div>
                        <div class="carousel-item"
                             data-bs-interval="5000">
                            <img src="assets/images/1920x1080-winter-background-4ntlcjwv63ornz4h.jpg"
                                 class="d-block w-100"
                                 alt="...">
                        </div>
                        <div class="carousel-item"
                             data-bs-interval="5000">
                            <img src="assets/images/sunset-reflects-tranquil-scene-on-abandoned-fishing-boat-nautical-vessel-generated-by-ai-free-photo.jpg"
                                 class="d-block w-100"
                                 alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev"
                            type="button"
                            data-bs-target="#carousel"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"
                              aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next"
                            type="button"
                            data-bs-target="#carousel"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon"
                              aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>


                <!-- // % PROJECTS WE HAVE DONE -->
                <h1 class="heading">PROJECTS WE HAVE DONE</h1>
                <hr>
                <p>Donations we have made to local clubs, associations and organizations</p>

                <div class="d-flex justify-content-evenly flex-wrap">
                    <div class="m-3">
                        Norfolk County Youth Soccer Park <br>
                        Port Dover Public Library <br>
                        Delhi Community Health Centre <br>
                        Norfolk General Hospital <br>
                        Port Dover Sports Park <br>
                        H-N Senior Support Services <br>
                        Norfolk General Hospital Foundation <br>
                        Port Rowan Heritage Association <br>
                        Kinsmen Club of Delhi - Quance Mill <br>
                        Norfolk Historical Society <br>
                        Port Rowan Waterfront Park <br>
                        SCS Rising From the Ashes Campaign <br>
                    </div>
                    <div class="m-3">
                        LaSalette Area Rural Roots Community Hall <br>
                        Norfolk Pregnancy Centre <br>
                        Simcoe Minor Baseball - Batting Cages <br>
                        Lighthouse Festival Theatre <br>
                        Norview Lodge Garden Project
                        Waterford Old Town Hall <br>
                        Long Point Conservation Authority <br>
                        Port Dover Elmer Lewis Parkette <br>
                        WDHS Score Board <br>
                        Lynn Valley Trail <br>
                        Port Dover Kinsmen Club Park Pavilion Renovations <br>
                        Norfolk County Sports Hall of Recognition <br>
                        Arcady Ensemble <br>
                        Long Point Basin Land Trust <br>
                        Norfolk Musical Arts Festival <br>
                    </div>
                    <div class="m-3">
                        South Coast Community Caring for Cancer <br>
                        Indwell Community Homes <br>
                        The Gathering Food Centre <br>
                        Simcoe Special Olympics <br>
                        Delhi Imperial Place Community Health <br>
                        Alzheimer Society of Haldimand Norfolk <br>
                        Girl Guides of Canada Delhi Unit <br>
                        Centre <br>
                        Old Town Hall Association Waterford <br>
                        Simcoe Little Theatre <br>
                        Friends of the Library <br>
                        Lynwood Arts Centre <br>
                        Norfolk Association for Community Living <br>
                    </div>
                </div>











            </center>


        </div>

        <img class="side-images right"
             src="assets/images/donation-right.jpg"
             alt="Norfolk">

    </main>


</body>

</html>