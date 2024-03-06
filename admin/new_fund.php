<!DOCTYPE html>
<html lang="en">
<?php require_once("../config-url.php"); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Admin - Donations</title>
    <!-- Custom Styles -->
    <link rel="stylesheet"
          href="<?php echo BASE_URL ?>assets/css/admin-general.css">
    <link rel="stylesheet"
          href="<?php echo BASE_URL ?>assets/css/admin-donations.css">
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

    <div class="d-flex justify-content-center align-items-center gap-5 my-4">
        <img src="../assets/images/leafs.jpg"
             alt="leafs"
             width="120px"
             height="120px">
        <h1 class="heading text-center my-3">Create New Fund</h1>
        <img src="../assets/images/leafs.jpg"
             alt="leafs"
             width="120px"
             height="120px">
    </div>

    <form action="../includes/new-fund.inc.php"
          id="new-fund-form"
          class="container-fluid p-4"
          method="post"
          enctype="multipart/form-data">

        <?php

        if (isset($_GET["error"])) {
            $error = $_GET["error"];
            if ($error === "empty_input") {
                $message = "Cannot Leave Input Empty";
            } elseif ($error === "empty_category") {
                $message = "Cannot Leave Leave Category Empty";
            } elseif ($error === "uploading_img") {
                $message = "Error Uploading Image. Please Try Again";
            } elseif ($error === "file_type") {
                $message = "Invalid File Type. Please Upload An Image";
            } elseif ($error === "img_size") {
                $message = "Image Size To Large. Please Upload An Image Under 50mb";
            } elseif ($error === "moving_file") {
                $message = "Error Saving Image To Files. Please Try Again";
            } elseif ($error === "prepare") {
                $message = "Error Connecting To Server. Please Try Again";
            } elseif ($error === "inserted_fund") {
                $message = "Error Adding New Fund. Please Try Again";
            } elseif ($error === "insertion_failed") {
                $message = "Error Adding New Fund. Please Try Again";
            } else {
                $message = $error;
            }

            ?>
            <div class="alert alert-danger"
                 role="alert">
                <?php echo $message ?>
            </div>
            <?php
        }

        if (isset($_GET["success"])) {
            $success = $_GET["success"];
            if ($success === "inserted_fund") {
                $message = "Created A New Fund Successfully";
            }
            ?>
            <div class="alert alert-success"
                 role="alert">
                <?php echo $message ?>
            </div>
            <?php
        }
        ?>
        <center>
            <div class="action-button bg-danger"
                 style="width: 230px; margin: 20px 50px;">
                <div class="form-check form-switch">
                    <input class="form-check-input"
                           type="checkbox"
                           id="flexSwitchCheckDefault"
                           name="featured">
                    <label class="form-check-label"
                           for="flexSwitchCheckDefault">Featured</label>
                </div>
            </div>
        </center>

        <div class="row justify-content-center">
            <div class="col-5">

                <div class="mb-3">
                    <label for="name"
                           class="form-label">Name Of Recipient
                    </label>
                    <input type="text"
                           class="form-control"
                           id="name"
                           name="name"
                           placeholder="Please Enter Full Name Of The Recipient"
                           required>
                </div>

                <div class="mb-3">
                    <label for="description"
                           class="form-label">Description Of Recipient</label>
                    <textarea type="text"
                              class="form-control"
                              id="description"
                              rows="5"
                              name="description"
                              placeholder="Please Write A Description Of The Recipient. ** This Will Be Displayed On The Donation. **"
                              required></textarea>
                </div>

                <h2>Contact Info:</h2>

                <div class="mb-3">
                    <label for="phone"
                           class="form-label">Phone Number</label>
                    <input type="text"
                           class="form-control"
                           id="phone"
                           name="phone"
                           placeholder="Please Enter Phone Number Of The Recipient"
                           required>
                </div>

                <div class="mb-3">
                    <label for="email"
                           class="form-label">Email</label>
                    <input type="text"
                           class="form-control"
                           id="email"
                           name="email"
                           placeholder="Please Enter Email Of The Recipient"
                           required>
                </div>

                <div class="mb-3 d-flex justify-content-between">
                    <div id="category-container">
                        <select id="category-select"
                                class="action-button"
                                style="width: 100%;"
                                aria-label=".form-select-lg example"
                                name="category"
                                required>
                            <option selected
                                    disabled>Select A Category</option>
                            <?php
                            $sql = "SELECT * FROM `recipient_category`;";

                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // * Your Code here
                                    $category = $row["category"];
                                    ?>
                                    <option value="<?php echo $category ?>">
                                        <?php echo $category ?>
                                    </option>
                                    <?php

                                }
                            } else {
                                // ! No data found
                            }
                            ?>
                        </select>

                        <input id="category-input"
                               name="new-category"
                               type="text"
                               style="display: none;"
                               class="form-control"
                               placeholder="Enter New Category">

                    </div>

                    <button class="action-button"
                            id="new-category"
                            type="button"
                            name="new-category">New Category</button>


                </div>

                <div id="category-description-container"
                     style="display: none;">
                    <label for="category-description">Category Description:</label>
                    <textarea class="form-control"
                              name="category-description"
                              id="category-description"
                              rows="5"
                              style="width: 100%;"
                              placeholder="Enter Category Description"></textarea>
                </div>
            </div>
            <div class="col-5 d-flex flex-column justify-content-center">

                <center>
                    <img src="../assets/images/upload_video.jpg"
                         alt="upload an image here"
                         style="max-width: 100%"
                         class="border border-3"
                         id="preview-img">
                </center>

                <label for="input-img"
                       class="mt-3">Upload An Image</label>
                <input type='file'
                       class='form-control'
                       name='image'
                       accept='image/*'
                       id="input-img"
                       onchange="updateImagePreview('input-img', 'preview-img')">

            </div>
        </div>

        <center>
            <button class="button my-5"
                    type="submit">Add New Fund</button>
        </center>


    </form>

    <script src="../assets/js/new-fund.js"></script>

</body>

</html>