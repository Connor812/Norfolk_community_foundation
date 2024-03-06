<?php
function getDonations($category, $conn)
{
    $sql = "SELECT * FROM `recipients` WHERE category = ?;";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        // ! Handle the case where the prepared statement could not be created
        echo "No Donations Found";
    }

    $stmt->bind_param("s", $category);

    // ? checks to see if the execute fails
    if (!$stmt->execute()) {
        echo "No Donations Found";
        $stmt->close();
    }

    // * Gets the Result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // * Your Code here

            $name = $row["name"];
            $description = $row["description"];
            $category = $row["category"];
            $fund_name = $row["fund_name"];
            ?>

            <div class="scholarship-item">
                <div>
                    <h3>
                        <?php echo $name ?>
                    </h3>
                    <p>
                        <?php echo $description ?>
                    </p>
                </div>
                <div>
                    <button class="donate-button"
                            data-bs-toggle="modal"
                            data-bs-target="#donationModal"
                            value="<?php echo $fund_name ?>">Donate</button>
                </div>
            </div>
            <?php
        }
    } else {
        // ! No data found
        echo "No Donations Found";
    }
}
?>