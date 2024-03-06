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
                  <h1 class="sub-heading text-center">Edit Carousel Images</h1>

                  <center class="edit-image-section">

                        <!-- // # Error And Success Notifications -->
                        <?php
                        if (isset($_GET["error"])) {
                              $error = $_GET["error"];

                              if ($error === "no_img") {
                                    $message = "Please Upload A Image";
                              } elseif ($error === "no_upload") {
                                    $message = "No Image Uploaded, Please Try Again";
                              } elseif ($error === "no_img_num") {
                                    $message = "Error Getting Image Number, Please Try Again";
                              } elseif ($error === "uploading_img") {
                                    $message = "Error Uploading The Image, Please Try Again";
                              } elseif ($error === "file_type") {
                                    $message = "Incorrect File Type, Please Upload An Image Type File.";
                              } elseif ($error === "img_size") {
                                    $message = "Image Size Too Large. Please Chose Smaller Image";
                              } elseif ($error === "moving_file") {
                                    $message = "Error Saving Image. Please Try Again";
                              } elseif ($error === "prepared_statement") {
                                    $message = "Server Error Uploading The Image. Please Try Again";
                              } elseif ($error === "execute") {
                                    $message = "Server Error Saving The Image. Please Try Again";
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

                              if ($success === "uploaded_img") {
                                    $message = "Successfully Uploaded Image";
                              }

                              ?>
                              <div class="alert alert-success"
                                   role="alert">
                                    <?php echo $message ?>
                              </div>
                        <?php } ?>

                        <!-- // % Image 1 -->
                        <button class="button collapse-btn"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapse-image-1"
                                aria-expanded="false"
                                aria-controls="collapse-image-1">
                              Image 1
                        </button>
                        <button class="button collapse-btn"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapse-image-2"
                                aria-expanded="false"
                                aria-controls="collapse-image-2">
                              Image 2
                        </button>
                        <button class="button collapse-btn"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapse-image-3"
                                aria-expanded="false"
                                aria-controls="collapse-image-3">
                              Image 3
                        </button>
                        <button class="button collapse-btn"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapse-image-4"
                                aria-expanded="false"
                                aria-controls="collapse-image-4">
                              Image 4
                        </button>

                        <div class="collapse"
                             id="collapse-image-1">
                              <div class="card card-body">
                                    <form id="edit-image-1-container"
                                          method="post"
                                          action="../includes/update-carousel-img.inc.php?img_num=1"
                                          class="edit-img-form active"
                                          enctype="multipart/form-data">
                                          <img id="1"
                                               src="../assets/images/<?php echo $image_1 ?>"
                                               alt=""
                                               class="m-2"
                                               width="80%"
                                               height="auto">
                                          <input type="file"
                                                 data-img-num="1"
                                                 class="form-control carousel-img m-2 m-2"
                                                 name="carousel-img"
                                                 accept="image/*">
                                          <button class="button submit-btn"
                                                  type="submit"
                                                  disabled>
                                                Upload
                                          </button>
                                    </form>
                              </div>
                        </div>

                        <div class="collapse"
                             id="collapse-image-2">
                              <div class="card card-body">
                                    <form id="edit-image-2-container"
                                          method="post"
                                          action="../includes/update-carousel-img.inc.php?img_num=2"
                                          class="edit-img-form active"
                                          enctype="multipart/form-data">
                                          <img id="2"
                                               src="../assets/images/<?php echo $image_2 ?>"
                                               alt=""
                                               class="m-2"
                                               width="80%"
                                               height="auto">
                                          <input type="file"
                                                 data-img-num="2"
                                                 class="form-control carousel-img m-2 m-2"
                                                 name="carousel-img"
                                                 accept="image/*">
                                          <button class="button submit-btn"
                                                  type="submit"
                                                  disabled>
                                                Upload
                                          </button>
                                    </form>
                              </div>
                        </div>

                        <div class="collapse"
                             id="collapse-image-3">
                              <div class="card card-body">
                                    <form id="edit-image-3-container"
                                          method="post"
                                          action="../includes/update-carousel-img.inc.php?img_num=3"
                                          class="edit-img-form active"
                                          enctype="multipart/form-data">
                                          <img id="3"
                                               src="../assets/images/<?php echo $image_3 ?>"
                                               alt=""
                                               class="m-2"
                                               width="80%"
                                               height="auto">
                                          <input type="file"
                                                 data-img-num="3"
                                                 class="form-control carousel-img m-2 m-2"
                                                 name="carousel-img"
                                                 accept="image/*">
                                          <button class="button submit-btn"
                                                  type="submit"
                                                  disabled>
                                                Upload
                                          </button>
                                    </form>
                              </div>
                        </div>

                        <div class="collapse"
                             id="collapse-image-4">
                              <div class="card card-body">
                                    <form id="edit-image-4-container"
                                          method="post"
                                          action="../includes/update-carousel-img.inc.php?img_num=4"
                                          class="edit-img-form active"
                                          enctype="multipart/form-data">
                                          <img id="4"
                                               src="../assets/images/<?php echo $image_4 ?>"
                                               alt=""
                                               class="m-2"
                                               width="80%"
                                               height="auto">
                                          <input type="file"
                                                 data-img-num="4"
                                                 class="form-control carousel-img m-2 m-2"
                                                 name="carousel-img"
                                                 accept="image/*">
                                          <button class="button submit-btn"
                                                  type="submit"
                                                  disabled>
                                                Upload
                                          </button>
                                    </form>
                              </div>
                        </div>
                  </center>
            </div>

            <div>
                  <iframe id="display-website"
                          class="website-container"
                          src="../index.php"
                          frameborder="0"></iframe>
            </div>
      </main>

      <script src="../assets/js/edit-carousel-images.js"></script>

</body>

</html>