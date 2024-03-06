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
          href="<?php echo BASE_URL ?>assets/css/admin-projects.css">
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

    $sql = "SELECT * FROM `carousel_images` WHERE id = 1;";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $image_1 = $row["image_1"];
            $image_2 = $row["image_2"];
            $image_3 = $row["image_3"];
            $image_4 = $row["image_4"];
        }
    } else {
        // ! No data found
    }
    ?>

    <main>
        <div class="edit-section">
            <h1 class="sub-heading text-center">Edit Projects</h1>

            <center class="edit-image-section">

                <!-- // # Error And Success Notifications -->
                <?php
                if (isset($_GET["error"])) {
                    $error = $_GET["error"];

                    if ($error === "no_img") {
                        $message = "Please Upload A Image";
                    } elseif ($error === "no_upload") {
                        $message = "No Image Uploaded, Please Try Again";
                    } elseif ($error === "project_not_found") {
                        $message = "Error Getting Project Number, Please Try Again";
                    } elseif ($error === "uploading_img") {
                        $message = "Error Uploading The Image, Please Try Again";
                    } elseif ($error === "file_type") {
                        $message = "Incorrect File Type, Please Upload An Image Type File.";
                    } elseif ($error === "img_size") {
                        $message = "Image Size Too Large. Please Chose Smaller Image";
                    } elseif ($error === "moving_file") {
                        $message = "Error Saving Image. Please Try Again";
                    } elseif ($error === "prepare") {
                        $message = "Server Error Couldn't Connect To Database. Please Try Again";
                    } elseif ($error === "execute") {
                        $message = "Server Error Couldn't Save Data To Database. Please Try Again";
                    } elseif ($error === "empty_input") {
                        $message = "Cannot Leave Any Input Blank. Please Try Again";
                    } elseif ($error === "no_update") {
                        $message = "Nothing Updated. Please Try Again";
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

                    if ($success === "update") {
                        $message = "Successfully Updated Project";
                    }

                    ?>
                    <div class="alert alert-success"
                         role="alert">
                        <?php echo $message ?>
                    </div>
                <?php } ?>

                <!-- // % Project 1 -->
                <button class="button collapse-btn"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#project-1"
                        aria-expanded="false"
                        aria-controls="project-1">
                    Project 1
                </button>

                <!-- // % Project 2 -->
                <button class="button collapse-btn"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#project-2"
                        aria-expanded="false"
                        aria-controls="project-2">
                    Project 2
                </button>

                <!-- // % Project 3 -->
                <button class="button collapse-btn"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#project-3"
                        aria-expanded="false"
                        aria-controls="project-3">
                    Project 3
                </button>

                <?php

                $sql = "SELECT * FROM `projects` WHERE id = 1;";

                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        // * Your Code here
                        $heading_1 = $row["heading_1"];
                        $description_1 = $row["description_1"];
                        $image_1 = $row["image_1"];
                        $heading_2 = $row["heading_2"];
                        $description_2 = $row["description_2"];
                        $image_2 = $row["image_2"];
                        $heading_3 = $row["heading_3"];
                        $description_3 = $row["description_3"];
                        $image_3 = $row["image_3"];
                    }
                } else {
                    // ! No data found
                    echo "No Data Found";
                }
                ?>

                <!-- // & Project 1 Drop Down -->
                <div class="collapse"
                     id="project-1">
                    <div class="card card-body">
                        <form id="project-1-form"
                              method="post"
                              action="../includes/edit-projects.inc.php?project=1"
                              class="active"
                              enctype="multipart/form-data">

                            <div class="text-start"
                                 style="color: var(--black);">

                                <h3 class="sub-heading">Project Heading</h3>
                                <input type="text"
                                       name="heading"
                                       class="form-control my-2"
                                       required
                                       value="<?php echo $heading_1 ?>">

                                <h3 class="sub-heading">Project Description</h3>
                                <textarea type="text"
                                          name="description"
                                          class="form-control my-2"
                                          rows="5"
                                          required><?php echo $description_1 ?></textarea>

                                <h3 class="sub-heading">Project Image</h3>
                                <center>
                                    <img id="project-1-image"
                                         src="../assets/images/<?php echo $image_1 ?>"
                                         alt="">
                                </center>

                                <input type="file"
                                       name="image"
                                       class="form-control my-2"
                                       id="project-1-image-upload"
                                       onchange="updateImagePreview('project-1-image-upload', 'project-1-image')">
                                <input type="hidden"
                                       name="old-image"
                                       value="<?php echo $image_1 ?>">
                            </div>
                            <button class="button"
                                    type="submit">
                                Update
                            </button>
                        </form>
                    </div>
                </div>

                <!-- // & Project 2 Drop Down -->
                <div class="collapse"
                     id="project-2">
                    <div class="card card-body">
                        <form id="project-2-form"
                              method="post"
                              action="../includes/edit-projects.inc.php?project=2"
                              class="active"
                              enctype="multipart/form-data">

                            <div class="text-start"
                                 style="color: var(--black);">

                                <h3 class="sub-heading">Project Heading</h3>
                                <input type="text"
                                       name="heading"
                                       class="form-control my-2"
                                       required
                                       value="<?php echo $heading_2 ?>">

                                <h3 class="sub-heading">Project Description</h3>
                                <textarea type="text"
                                          name="description"
                                          class="form-control my-2"
                                          rows="5"
                                          required><?php echo $description_2 ?></textarea>

                                <h3 class="sub-heading">Project Image</h3>
                                <center>
                                    <img id="project-2-image"
                                         src="../assets/images/<?php echo $image_2 ?>"
                                         alt="">
                                </center>

                                <input type="file"
                                       name="image"
                                       class="form-control my-2"
                                       id="project-2-image-upload"
                                       onchange="updateImagePreview('project-2-image-upload', 'project-2-image')">
                                <input type="hidden"
                                       name="old-image"
                                       value="<?php echo $image_2 ?>">
                            </div>
                            <button class="button"
                                    type="submit">
                                Update
                            </button>
                        </form>
                    </div>
                </div>

                <!-- // & Project 3 Drop Down -->
                <div class="collapse"
                     id="project-3">
                    <div class="card card-body">
                        <form id="project-3-form"
                              method="post"
                              action="../includes/edit-projects.inc.php?project=3"
                              class="active"
                              enctype="multipart/form-data">

                            <div class="text-start"
                                 style="color: var(--black);">

                                <h3 class="sub-heading">Project Heading</h3>
                                <input type="text"
                                       name="heading"
                                       class="form-control my-2"
                                       required
                                       value="<?php echo $heading_3 ?>">

                                <h3 class="sub-heading">Project Description</h3>
                                <textarea type="text"
                                          name="description"
                                          class="form-control my-2"
                                          rows="5"
                                          required><?php echo $description_3 ?></textarea>

                                <h3 class="sub-heading">Project Image</h3>
                                <center>
                                    <img id="project-3-image"
                                         src="../assets/images/<?php echo $image_3 ?>"
                                         alt="">
                                </center>

                                <input type="file"
                                       name="image"
                                       class="form-control my-2"
                                       id="project-3-image-upload"
                                       onchange="updateImagePreview('project-3-image-upload', 'project-3-image')">
                                <input type="hidden"
                                       name="old-image"
                                       value="<?php echo $image_3 ?>">
                            </div>
                            <button class="button"
                                    type="submit">
                                Update
                            </button>
                        </form>
                    </div>
                </div>



            </center>
        </div>

        <div>
            <iframe id="display-website"
                    class="website-container"
                    src="../projects.php"
                    frameborder="0"></iframe>
        </div>
    </main>

    <script src="../assets/js/admin-projects.js"></script>

</body>

</html>