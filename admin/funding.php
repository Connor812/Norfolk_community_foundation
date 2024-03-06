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

    <main class="row justify-content-center">
        <div class="col-5">
            <center>
                <h2 class="sub-heading">Grants Not Approved</h2>
                <div class="action-btn-container">
                    <button type="button"
                            class="action-button"
                            data-bs-toggle="modal"
                            data-bs-target="#unapproved-grant-search">SEARCH</button>
                    <?php
                    if (isset($_POST["unapproved-grant-search"]) || isset($_GET["unapproved_grant_query"])) {
                        ?>
                        <a class="action-button"
                           href="<?php echo ADMIN_URL . "funding.php" ?>">RESET</a>
                        <?php
                    }
                    ?>
                </div>

                <!-- // @ Search For Fund Modal -->
                <div class="modal fade"
                     id="unapproved-grant-search"
                     tabindex="-1"
                     aria-labelledby="unapproved-grant-search-Label"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"
                                    id="unapproved-grant-search-Label">Search For Unapproved Grant</h5>
                                <button type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="d-flex justify-content-around">
                                    <img src="../assets/images/leafs.jpg"
                                         alt=""
                                         width="70px"
                                         height="70px">
                                    <h2>Search For Unapproved Grant:</h2>
                                    <img src="../assets/images/leafs.jpg"
                                         alt=""
                                         width="70px"
                                         height="70px">
                                </div>
                                <form action=""
                                      method="post">
                                    <input list="unapproved-grants"
                                           id="searchBar"
                                           class="form-control my-4"
                                           name="unapproved-grant-search"
                                           placeholder="Start typing...">
                                    <datalist id="unapproved-grants">
                                        <?php
                                        $sql = "SELECT `organization` FROM `grant_applications` WHERE approved = 'unapproved';";

                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                // * Your Code here
                                                $organization = $row["organization"];
                                                ?>
                                                <option value="<?php echo $organization ?>">
                                                    <?php
                                            }
                                        } else {
                                            // ! No data found
                                            ?>
                                            <option value="No Funds Found">
                                                <?php
                                        }
                                        ?>
                                    </datalist>
                                    <button type="submit"
                                            class="button">Search</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>
                                <a class="circle"
                                   href="?unapproved_grant_query=<?php echo ($_GET['unapproved_grant_query'] === 'name') ? 'name_rev' : 'name'; ?>"></a>
                                Organization
                            </th>
                            <th>
                                <a class="circle"
                                   href="?unapproved_grant_query=<?php echo ($_GET['unapproved_grant_query'] === 'date') ? 'date_rev' : 'date'; ?>"></a>
                                Date
                            </th>
                            <th>
                                <a class="circle"
                                   href="?unapproved_grant_query=<?php echo ($_GET['unapproved_grant_query'] === 'total') ? 'total_rev' : 'total'; ?>"></a>
                                Amount Requested
                            </th>
                            <th>
                                <a class="circle"
                                   href="?unapproved_grant_query=<?php echo ($_GET['unapproved_grant_query'] === 'read') ? 'un_read' : 'read'; ?>"></a>
                                Read
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once("../sql/unapproved-grant-queries.php");
                        require_once("../components/grant-table-rows.php");
                        require_once("../components/display-error.php");

                        // $ If there is a search then Execute the search
                        if (isset($_POST["unapproved-grant-search"])) {

                            if (empty($_POST["unapproved-grant-search"])) {
                                display_error("Search Is Empty, Please Try Again");
                            }

                            $sql = $unapproved_grant_search;
                            $stmt = $conn->prepare($sql);

                            if (!$stmt) {
                                // ! Handle the case where the prepared statement could not be created
                                display_error("Failed To Connect To Server, Please Try Again");
                            }

                            $stmt->bind_param("s", $_POST["unapproved-grant-search"]);

                            // ? checks to see if the execute fails
                            if (!$stmt->execute()) {
                                display_error("Failed To Search For Fund, Please Try Again");
                                $stmt->close();
                                exit;
                            }

                            // * Gets the Result
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    // * Your Code here
                                    $id = $row["id"];
                                    $organization = $row["organization"];
                                    $date = $row["date"];
                                    $requested_amount = "$" . $row["requested_amount"];
                                    $read_status = ($row["read_status"] === "un-read") ? true : false;

                                    grant_table_rows($id, $organization, $date, $requested_amount, $read_status);

                                }
                            } else {
                                // ! No data found
                                ?>
                                <tr>No Data Found</tr>
                                <?php
                            }
                        }

                        // $ If There is no search then it will do this
                        else {
                            if (isset($_GET["unapproved_grant_query"])) {
                                $query = $_GET["unapproved_grant_query"];

                                if ($query === "name") {
                                    $sql = $name_order;
                                } elseif ($query === "name_rev") {
                                    $sql = $name_order_rev;
                                } elseif ($query === "date") {
                                    $sql = $earliest_date;
                                } elseif ($query === "date_rev") {
                                    $sql = $latest_date;
                                } elseif ($query === "total") {
                                    $sql = $highest_total;
                                } elseif ($query === "total_rev") {
                                    $sql = $lowest_total;
                                } elseif ($query === "read") {
                                    $sql = $read;
                                } elseif ($query === "un_read") {
                                    $sql = $un_read;
                                }
                            } else {
                                $sql = $plain;
                            }

                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // * Your Code here
                                    $id = $row["id"];
                                    $organization = $row["organization"];
                                    $date = $row["date"];
                                    $requested_amount = "$" . $row["requested_amount"];
                                    $read_status = ($row["read_status"] === "un-read") ? true : false;

                                    grant_table_rows($id, $organization, $date, $requested_amount, $read_status);
                                }
                            } else {
                                // ! No data found
                                ?>
                                <tr>No Data Found</tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>

            </center>
        </div>
        <div class="col-5">
            <center>
                <h2 class="sub-heading">Approved Grants</h2>
                <div class="action-btn-container">
                    <button type="button"
                            class="action-button"
                            data-bs-toggle="modal"
                            data-bs-target="#grant-search">SEARCH</button>
                    <?php
                    if (isset($_POST["grant-search"]) || isset($_GET["grant_query"])) {
                        ?>
                        <a class="action-button"
                           href="<?php echo ADMIN_URL . "funding.php" ?>">RESET</a>
                        <?php
                    }
                    ?>
                </div>

                <!-- // @ Search For Fund Modal -->
                <div class="modal fade"
                     id="grant-search"
                     tabindex="-1"
                     aria-labelledby="grant-search-Label"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"
                                    id="grant-search-Label">Search For Fund</h5>
                                <button type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="d-flex justify-content-around">
                                    <img src="../assets/images/leafs.jpg"
                                         alt=""
                                         width="70px"
                                         height="70px">
                                    <h2>Search For Grant:</h2>
                                    <img src="../assets/images/leafs.jpg"
                                         alt=""
                                         width="70px"
                                         height="70px">
                                </div>
                                <form action=""
                                      method="post">
                                    <input list="grants"
                                           id="searchBar"
                                           class="form-control my-4"
                                           name="grant-search"
                                           placeholder="Start typing...">
                                    <datalist id="grants">
                                        <?php
                                        $sql = "SELECT `organization` FROM `grant_applications`;";

                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                // * Your Code here
                                                $organization = $row["organization"];
                                                ?>
                                                <option value="<?php echo $organization ?>">
                                                    <?php
                                            }
                                        } else {
                                            // ! No data found
                                            ?>
                                            <option value="No Funds Found">
                                                <?php
                                        }
                                        ?>
                                    </datalist>
                                    <button type="submit"
                                            class="button">Search</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>
                                <a class="circle"
                                   href="?grant_query=<?php echo ($_GET['grant_query'] === 'name') ? 'name_rev' : 'name'; ?>"></a>
                                Organization
                            </th>
                            <th>
                                <a class="circle"
                                   href="?grant_query=<?php echo ($_GET['grant_query'] === 'date') ? 'date_rev' : 'date'; ?>"></a>
                                Date
                            </th>
                            <th>
                                <a class="circle"
                                   href="?grant_query=<?php echo ($_GET['grant_query'] === 'total') ? 'total_rev' : 'total'; ?>"></a>
                                Amount Granted
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once("../sql/approved-grant-queries.php");
                        require_once("../components/display-table-rows.php");

                        // $ If there is a search then Execute the search
                        if (isset($_POST["grant-search"])) {

                            if (empty($_POST["grant-search"])) {
                                display_error("Search Is Empty, Please Try Again");
                            }

                            $sql = $approved_grant_search;
                            $stmt = $conn->prepare($sql);

                            if (!$stmt) {
                                // ! Handle the case where the prepared statement could not be created
                                display_error("Failed To Connect To Server, Please Try Again");
                            }

                            $stmt->bind_param("s", $_POST["grant-search"]);

                            // ? checks to see if the execute fails
                            if (!$stmt->execute()) {
                                display_error("Failed To Search For Grant, Please Try Again");
                                $stmt->close();
                                exit;
                            }

                            // * Gets the Result
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                while ($grant_row = $result->fetch_assoc()) {
                                    // * Your Code here
                                    $id = $row["id"];
                                    $organization = $grant_row["organization"];
                                    $date = $grant_row["date"];
                                    $amount_granted = (empty($grant_row["amount_granted"])) ? "No Grant" : "$" . $grant_row["amount_granted"];

                                    display_table_rows($id, $organization, $date, $amount_granted, "grant");
                                }
                            } else {
                                // ! No data found
                                ?>
                                <tr>No Data Found</tr>
                                <?php
                            }
                        } else {

                            if (isset($_GET["grant_query"])) {
                                $query = $_GET["grant_query"];

                                if ($query === "name") {
                                    $sql = $name_order;
                                } elseif ($query === "name_rev") {
                                    $sql = $name_order_rev;
                                } elseif ($query === "date") {
                                    $sql = $earliest_date;
                                } elseif ($query === "date_rev") {
                                    $sql = $latest_date;
                                } elseif ($query === "total") {
                                    $sql = $highest_total;
                                } elseif ($query === "total_rev") {
                                    $sql = $lowest_total;
                                }
                            } else {
                                $sql = $plain;
                            }

                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while ($grant_row = mysqli_fetch_assoc($result)) {
                                    // * Your Code here
                                    $id = $grant_row["id"];
                                    $organization = $grant_row["organization"];
                                    $date = $grant_row["date"];
                                    $amount_granted = (empty($grant_row["amount_granted"])) ? "No Grant" : "$" . $grant_row["amount_granted"];

                                    display_table_rows($id, $organization, $date, $amount_granted, "grant");

                                }
                            } else {
                                // ! No data found
                                ?>
                                <tr>No Data Found</tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>

            </center>
        </div>
    </main>




</body>

</html>