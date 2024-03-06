<?php
require_once("../config-url.php");
if (!isset($_GET["query"])) {
    header("Location: " . ADMIN_URL . "donations.php?error=no_fund");
    exit;
}

if (empty($_GET["query"])) {
    header("Location: " . ADMIN_URL . "donations.php?error=no_fund");
    exit;
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Admin - Display Fund</title>
    <!-- Custom Styles -->
    <link rel="stylesheet"
          href="<?php echo BASE_URL ?>assets/css/admin-general.css">
    <link rel="stylesheet"
          href="<?php echo BASE_URL ?>assets/css/admin-display.css">
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
    require_once("../components/display-error.php");

    $id = urldecode($_GET["query"]);

    $sql = "SELECT * FROM `recipients` WHERE id = ?;";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        // ! Handle the case where the prepared statement could not be created
        display_error("Failed To Connect To Server. Please Go Back And Try Again.");
        exit;
    }

    $stmt->bind_param("i", $id);

    // ? checks to see if the execute fails
    if (!$stmt->execute()) {
        display_error("Failed To Get Information From Server. Please Go Back And Try Again.");
        $stmt->close();
        exit;
    }

    // * Gets the Result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // * Your Code here
            $name = $row["name"];
            $fund_name = $row["fund_name"];
            $description = $row["description"];
            $image = $row["image"];
            $category = empty($row["category"]) ? "No Category" : $row["category"];
            $featured = ($row["featured"] === 1) ? "Yes" : "No";
            $start_date = $row["start_date"];

            ?>
            <a href="donations.php"
               class="button text-starts m-4"
               style="text-decoration: none; color: white;">
                Back</a>
            <center class="my-4">
                <div class="display-container">
                    <h2>
                        <?php echo $fund_name ?>
                    </h2>
                    <?php
                    if (empty($image)) {
                        echo "<h3>No Image</h3>";
                    } else {
                        ?>
                        <img src="../assets/images/<?php echo $image ?>"
                             width="20%"
                             height="auto">
                    <?php } ?>


                    <div class="text-start fs-5 display-content">
                        <div>
                            <b>Name:</b>
                            <?php echo $name ?>
                        </div>
                        <div>
                            <b>Description:</b>
                            <?php echo $description ?>
                        </div>
                        <div>
                            <b>Category:</b>
                            <?php echo $category ?>
                        </div>
                        <div>
                            <b>Featured:</b>
                            <?php echo $featured ?>
                        </div>
                        <div>
                            <b>Start Date:</b>
                            <?php echo $start_date ?>
                        </div>
                    </div>
                </div>
            </center>
            <?php
        }
    } else {
        // ! No data found
        echo "No Recipient Found";
    }



    ?>

    <h1 class="sub-heading text-center">Donations</h1>
    <hr>
    <table>
        <thead>
            <tr>
                <th>Donors Name</th>
                <th>Donation Date</th>
                <th>Donation Amount</th>
            </tr>
        </thead>
        <tbody class="donation-table">
            <?php

            $sql = "SELECT `donor_full_name`, `donation_amount`, `donation_date` FROM `ncf_donations` WHERE fund_name = ?;";
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                // ! Handle the case where the prepared statement could not be created
                display_error("Failed To Connect To Server. Please Go Back And Try Again.");
                exit;
            }

            $stmt->bind_param("s", $fund_name);

            // ? checks to see if the execute fails
            if (!$stmt->execute()) {
                display_error("Failed To Get Information From Server. Please Go Back And Try Again.");
                $stmt->close();
                exit;
            }

            // * Gets the Result
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // * Your Code here
                    $donor_name = $row["donor_full_name"];
                    $donation_date = $row["donation_date"];
                    $donation_amount = $row["donation_amount"];
                    ?>
                    <tr>
                        <td class="text-center">
                            <?php echo $donor_name ?>
                        </td>
                        <td class="text-center">
                            <?php echo $donation_date ?>
                        </td>
                        <td class="text-center">
                            <?php echo $donation_amount ?>
                        </td>
                    </tr>

                    <?php
                }
            } else {
                // ! No data found
                echo "<tr>No Donations Found</tr>";
            }
            ?>
        </tbody>
    </table>

</body>

</html>