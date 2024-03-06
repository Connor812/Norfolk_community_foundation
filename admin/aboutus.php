<!DOCTYPE html>
<html lang="en">
<?php require_once("../config-url.php"); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Admin - Home</title>
    <!-- Custom Styles -->
    <link rel="stylesheet"
          href="<?php echo BASE_URL ?>assets/css/admin-general.css">
    <link rel="stylesheet"
          href="<?php echo BASE_URL ?>assets/css/admin-home.css">
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
    require_once("../db/db.php");
    require_once("../components/admin-header.php");
    // @ Navigation Buttons
    require_once("../components/admin-navigation-btns.php");


    ?>
    <main>
        <div class="edit-section">
            <h1 class="sub-heading text-center">Edit About Us Page</h1>

            <center class="edit-image-section">

                <?php
                // ! Error Handlers
                if (isset($_GET["error"])) {
                    $error = $_GET["error"];

                    if ($error === "empty_input") {
                        $message = "You Can't Leave Any Spaces Back, Please Try Again";
                    } elseif ($error === "prepare") {
                        $message = "Error Connecting To The Server. Could Not Update. Please Try Again";
                    } elseif ($error === "no_update") {
                        $message = "No Changes Made. Please Try Again";
                    } elseif ($error === "execute") {
                        $message = "Could Not Update. Please Try Again";
                    } elseif ($error === "uploading_video") {
                        $message = "Error Uploading Video. Please Try Again";
                    } elseif ($error === "file_type") {
                        $message = "Wrong File Type. Please Use A Correct Type File.";
                    } elseif ($error === "video_size") {
                        $message = "Video To Large. Please Use A Smaller Video.";
                    } elseif ($error === "moving_file") {
                        $message = "Error Moving File To Folder. Please Try Again.";
                    } elseif ($error === "uploading_pdf") {
                        $message = "Error Moving File To Folder. Please Try Again.";
                    } elseif ($error === "pdf_size") {
                        $message = "Error File Size To Large. Please Chose A Smaller File.";
                    }

                    ?>
                    <div class="alert alert-danger"
                         role="alert">
                        <?php echo $message ?>
                    </div>
                <?php } ?>

                <?php
                // # Success Handlers
                if (isset($_GET["success"])) {
                    $success = $_GET["success"];

                    if ($success === "updated") {
                        $message = "Successfully Updated Director";
                    } elseif ($success === "updated_video") {
                        $message = "Successfully Updated Video";
                    } elseif ($success === "updated_pdf") {
                        $message = "Successfully Updated Recent Statement";
                    }
                    ?>
                    <div class="alert alert-success"
                         role="alert">
                        <?php echo $message ?>
                    </div>
                <?php } ?>

                <!-- // % Edit Directors -->
                <button class="button collapse-btn"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#chairs"
                        aria-expanded="false"
                        aria-controls="chairs">
                    Update Directors
                </button>

                <!-- // & Edit Video -->
                <button class="button collapse-btn"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#edit-video"
                        aria-expanded="false"
                        aria-controls="edit-video">
                    Update Video
                </button>


                <!-- // $ Edit Most Recent Statement -->
                <button class="button collapse-btn"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#edit-pdf"
                        aria-expanded="false"
                        aria-controls="edit-pdf">
                    Update Recent Statement
                </button>

                <!-- // $ Edit Most Recent Statement Drop Down -->
                <div class="collapse"
                     id="edit-pdf">
                    <div class="card card-body">
                        <form action="../includes/update-statement.inc.php"
                              method="post"
                              enctype="multipart/form-data">

                            <h2>Upload Most Recent Statement</h2>
                            <?php
                            $sql = "SELECT * FROM `recent_statement`;";

                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // * Your Code here
                            
                                    $statement = $row["pdf"];
                                    ?>
                                    <p><b>Current Statement: </b><a href="../assets/pdf/<?php echo $statement ?>"
                                           target="_blank">
                                            <?php echo $statement ?>
                                        </a></p>
                                    <?php

                                }
                            } else {
                                // ! No data found
                            }

                            ?>
                            <input type='file'
                                   class='form-control my-3'
                                   name='`recent-statement`'
                                   accept='application/pdf'
                                   required>
                            <button class="button my-3"
                                    type="submit">Update</button>
                        </form>
                    </div>
                </div>


                <!-- // & Edit Video Drop Down -->
                <div class="collapse"
                     id="edit-video">
                    <div class="card card-body">
                        <?php
                        $sql = "SELECT * FROM `aboutus_video` WHERE id = 1;";

                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                // * Your Code here
                                $video = $row["video"];

                                ?>

                                <form action="../includes/update-aboutus-video.inc.php"
                                      method="post"
                                      enctype="multipart/form-data">

                                    <video width="100%"
                                           height="auto"
                                           controls
                                           id="aboutus-video-preview">
                                        <source src="<?php echo BASE_URL . "assets/videos/$video" ?>"
                                                type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>

                                    <input type='file'
                                           id="aboutus-video-input"
                                           class='form-control my-3'
                                           name='aboutus-video'
                                           accept='video/*'
                                           required
                                           onchange="updateVideoPreview('aboutus-video-input', 'aboutus-video-preview')">

                                    <button class="button m-3"
                                            type="submit">Update</button>

                                </form>
                                <?php
                            }
                        } else {
                            // ! No data found
                            echo "Could Not find Video";
                        }
                        ?>
                    </div>
                </div>

                <!-- // % Edit Directors Drop Down -->
                <div class="collapse <?php echo (isset($_GET["director"])) ? "show" : "" ?>"
                     id="chairs">
                    <div class="card card-body">
                        <form action="../includes/update-chairs.inc.php"
                              method="post">

                            <div class="dropdown m-2">
                                <button class="btn btn-primary dropdown-toggle"
                                        type="button"
                                        id="dropdownMenuButton1"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                    Select Director
                                </button>
                                <ul class="dropdown-menu"
                                    aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item"
                                           href="?director=1">One</a></li>
                                    <li><a class="dropdown-item"
                                           href="?director=2">Two</a></li>
                                    <li><a class="dropdown-item"
                                           href="?director=3">Three</a></li>
                                    <li><a class="dropdown-item"
                                           href="?director=4">Four</a></li>
                                    <li><a class="dropdown-item"
                                           href="?director=5">Five</a></li>
                                    <li><a class="dropdown-item"
                                           href="?director=6">Six</a></li>
                                    <li><a class="dropdown-item"
                                           href="?director=7">Seven</a></li>
                                    <li><a class="dropdown-item"
                                           href="?director=8">Eight</a></li>
                                </ul>
                            </div>

                            <?php
                            require_once("../components/display-error.php");

                            if (isset($_GET["director"])) {

                                $id = $_GET["director"];

                                $sql = "SELECT * FROM `board_of_directors` WHERE id = ?;";
                                $stmt = $conn->prepare($sql);

                                if (!$stmt) {
                                    // ! Handle the case where the prepared statement could not be created
                                    display_error("Error Connecting To Server Getting Director Information");
                                    exit;
                                }

                                $stmt->bind_param("i", $id);

                                // ? checks to see if the execute fails
                                if (!$stmt->execute()) {
                                    display_error("Error Getting Director Information");
                                    $stmt->close();
                                    exit;
                                }

                                // * Gets the Result
                                $result = $stmt->get_result();

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        // * Your Code here
                                        $position = $row["position"];
                                        $name = $row["name"];
                                        $roll = $row["roll"];
                                        $company = $row["company"];
                                        $phone = $row["phone"];
                                        $email = $row["email"];
                                        ?>
                                        <input type="hidden"
                                               name="director-num"
                                               value="<?php echo $_GET["director"] ?>">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"
                                                      id="inputGroup-sizing-default">Director Position</span>
                                                <input type="text"
                                                       class="form-control"
                                                       name="position"
                                                       aria-label="Sizing example input"
                                                       placeholder="Please Enter Director Position"
                                                       aria-describedby="inputGroup-sizing-default"
                                                       value="<?php echo $position ?>">
                                            </div>
                                        </div>

                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"
                                                      id="inputGroup-sizing-default">Director Name</span>
                                                <input type="text"
                                                       class="form-control"
                                                       name="name"
                                                       aria-label="Sizing example input"
                                                       placeholder="Please Enter Director Name"
                                                       aria-describedby="inputGroup-sizing-default"
                                                       value="<?php echo $name ?>">
                                            </div>
                                        </div>

                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"
                                                      id="inputGroup-sizing-default">Director Roll</span>
                                                <input type="text"
                                                       class="form-control"
                                                       name="roll"
                                                       aria-label="Sizing example input"
                                                       placeholder="Please Enter The Directors Roll"
                                                       aria-describedby="inputGroup-sizing-default"
                                                       value="<?php echo $roll ?>">
                                            </div>
                                        </div>


                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"
                                                      id="inputGroup-sizing-default">Director Company</span>
                                                <input type="text"
                                                       class="form-control"
                                                       name="company"
                                                       aria-label="Sizing example input"
                                                       placeholder="Please Enter Directors Company"
                                                       aria-describedby="inputGroup-sizing-default"
                                                       value="<?php echo $company ?>">
                                            </div>
                                        </div>

                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"
                                                      id="inputGroup-sizing-default">Director Phone Number</span>
                                                <input type="text"
                                                       class="form-control"
                                                       name="phone"
                                                       aria-label="Sizing example input"
                                                       placeholder="Please Enter Directors Phone Number"
                                                       aria-describedby="inputGroup-sizing-default"
                                                       value="<?php echo $phone ?>">
                                            </div>
                                        </div>

                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"
                                                      id="inputGroup-sizing-default">Director Email</span>
                                                <input type="text"
                                                       class="form-control"
                                                       name="email"
                                                       aria-label="Sizing example input"
                                                       placeholder="Please Enter Directors Email"
                                                       aria-describedby="inputGroup-sizing-default"
                                                       value="<?php echo $email ?>">
                                            </div>
                                        </div>

                                        <button class="button"
                                                type="submit">Update</button>
                                        <?php
                                    }
                                } else {
                                    // ! No data found
                                    echo "No Data Found";
                                }

                            }

                            ?>
                        </form>
                    </div>
                </div>


            </center>
        </div>

        <div>
            <iframe id="display-website"
                    class="website-container"
                    src="../aboutus.php"
                    frameborder="0"></iframe>
        </div>
    </main>

    <script src="../assets/js/aboutus.js"></script>

</body>

</html>