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

    if (isset($_GET["read"])) {
        if ($_GET["read"] == "1") {

            // ? Update statement
            $sql = "UPDATE `grant_applications` SET `read_status` = 'read' WHERE id = ?;";

            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                display_error("Failed To Connect To Server And Mark As Read");
                $stmt->close();
                exit;
            }

            $stmt->bind_param("i", $id);

            // ? This checks the execute statement
            if ($stmt->execute()) {
                // ? Check the number of affected rows
                if ($stmt->affected_rows > 0) {
                    // * Successful update
                    $stmt->close();

                } else {
                    // ! No rows were updated
                    $stmt->close();

                }
            } else {
                // ! Failed update
                display_error("Failed To Mark As Read");
                $stmt->close();

            }
        }
    }

    $sql = "SELECT * FROM `grant_applications` WHERE id = ?;";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        // ! Handle the case where the prepared statement could not be created
        display_error("Failed To Connect To Server And Get Grant Application. Please Go Back And Try Again.");
        exit;
    }

    $stmt->bind_param("i", $id);

    // ? checks to see if the execute fails
    if (!$stmt->execute()) {
        display_error("Failed Get Grant Application. Please Go Back And Try Again.");
        $stmt->close();
        exit;
    }

    // * Gets the Result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // * Your Code here
            $id = $row['id'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $organization = $row['organization'];
            $address = $row['address'];
            $postal_code = $row['postal_code'];
            $phone = $row['phone'];
            $email = $row['email'];
            $password = $row['password'];
            $president = $row['president'];
            $years_in_business = $row['years_in_business'];
            $company_phone = $row['company_phone'];
            $charity_number = $row['charity_number'];
            $fulltime_staff = $row['fulltime_staff'];
            $part_time_staff = $row['part_time_staff'];
            $volunteers = $row['volunteers'];
            $read_status = $row['read_status'];
            $stage = $row['stage'];
            $total_budget = $row['total_budget'];
            $requested_amount = $row['requested_amount'];
            $expenditures = $row['expenditures'];
            $other_revenue = $row['other_revenue'];
            $comment = $row['comment'];
            $amount_granted = $row['amount_granted'];
            $date = $row['date'];
            $approved = $row['approved'];
            $project_name = $row['project_name'];
            $project_description = $row['project_description'];


            ?>

            <a href="<?php echo ADMIN_URL . "funding.php" ?>"
               class="button"
               style="text-decoration: none; color: white;">Back</a>
            <center>
                <div style="position: relative;">
                    <h1>
                        <?php echo empty($project_name) ? "No Name Yet" : $project_name ?>
                        <?php
                        if ($approved === "approved") {
                            ?>
                            <div style="position: absolute; right: 50px; top: 15px;"
                                 class="action-button fs-6">Approved</div>
                            <?php
                        } else {
                            ?>
                            <button style="position: absolute; right: 50px; top: 15px;"
                                    class="action-button fs-6 bg-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#approve">Not Approved</button>
                            <?php
                        }

                        ?>

                    </h1>
                </div>

                <div class="row fs-5 justify-content-center">

                    <div class="col-5 text-start p-5 m-4 border border-2">
                        <h3>Organization Information</h3>
                        <hr>
                        <p><b>Name: </b>
                            <?php echo "$first_name $last_name" ?>
                        </p>
                        <p><b>Date Filled Out The Form: </b>
                            <?php echo $date ?>
                        </p>
                        <p><b>Organization: </b>
                            <?php echo $organization ?>
                        </p>
                        <p><b>Address: </b>
                            <?php echo "$address, $postal_code" ?>
                        </p>
                        <p><b>Phone Number: </b>
                            <?php echo $phone ?>
                        </p>
                        <p><b>Company Phone Number: </b>
                            <?php echo $company_phone ?>
                        </p>
                        <p><b>Email: </b>
                            <?php echo $email ?>
                        </p>
                        <p><b>President: </b>
                            <?php echo $president ?>
                        </p>
                        <p><b>Charity Number: </b>
                            <?php echo $charity_number ?>
                        </p>
                        <p><b>Full Time Staff: </b>
                            <?php echo $fulltime_staff ?>
                        </p>
                        <p><b>Part Time Staff: </b>
                            <?php echo $part_time_staff ?>
                        </p>
                        <p><b>Volunteers: </b>
                            <?php echo $volunteers ?>
                        </p>

                    </div>

                    <div class="col-5 text-start p-5 m-4 border border-2">
                        <h3>Project Information</h3>
                        <hr>
                        <p><b>Project Name: </b>
                            <?php echo $project_name ?>
                        </p>
                        <p><b>Project Description: </b>
                            <?php echo $project_description ?>
                        </p>
                        <p><b>Total Budger: </b>
                            <?php echo "$$total_budget" ?>
                        </p>
                        <p><b>Requested Amount: </b>
                            <?php echo "$$requested_amount" ?>
                        </p>
                        <p><b>Expenditures: </b>
                            <?php echo $expenditures ?>
                        </p>
                        <p><b>Other Revenue: </b>
                            <?php echo $other_revenue ?>
                        </p>
                        <p><b>Comment: </b>
                            <?php echo $comment ?>
                        </p>

                    </div>

                </div>

            </center>

            <?php
        }
    } else {
        // ! No data found
        echo "No Grant Application Found";
    }
    ?>

    <!-- Modal -->
    <div class="modal fade"
         id="approve"
         tabindex="-1"
         aria-labelledby="approveLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="approveLabel">Approve
                        <?php echo $project_name ?>
                    </h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2>Are you sure you want to approve this grant application?</h2>
                </div>
                <div class="modal-footer">
                    <center style="width: 100%;">

                        <form action="../includes/approve-grant.inc.php"
                              method="post">
                            <input type="hidden"
                                   name="id"
                                   value="<?php echo $id ?>">
                            <input type="hidden"
                                   name="email"
                                   value="<?php echo $email ?>">
                            <input type="hidden"
                                   name="name"
                                   value="<?php echo "$first_name $last_name" ?>">
                            <div for="email-message"
                                 class="text-start"
                                 style="width: 100%'">Send A Message:</div>
                            <textarea name="message"
                                      class="form-control mb-3"
                                      id="email-message"
                                      placeholder="Enter your message here..."
                                      rows="5"></textarea>
                            <button type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal">No</button>
                            <button type="submit"
                                    class="btn btn-primary">Yes</button>
                        </form>
                    </center>
                </div>
            </div>
        </div>
    </div>

</body>

</html>