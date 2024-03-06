<!DOCTYPE html>
<html lang="en">

<?php require_once("config-url.php") ?>

<head>
      <meta charset="UTF-8">
      <meta name="viewport"
            content="width=device-width, initial-scale=1.0">
      <title>Norfolk Community Foundation - Donations</title>
      <link rel="stylesheet"
            href="<?php echo BASE_URL ?>assets/css/general.css">
      <link rel="stylesheet"
            href="<?php echo BASE_URL ?>assets/css/donation.css">
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

      <!-- // ^ Donation Modal ---------------------------------------- -->
      <div class="modal fade"
           id="donationModal"
           donation-name=""
           data-bs-backdrop="static"
           data-bs-keyboard="false"
           tabindex="-1"
           aria-labelledby="donationModalLabel"
           aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                        <div class="modal-header">
                              <h5 class="modal-title green fs-3"
                                  id="donationModalLabel">Your Tax Deductible Donation</h5>
                              <button type="button"
                                      class="btn-close"
                                      data-bs-dismiss="modal"
                                      aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                              <center>

                                    Canada Revenue Agency requires a tax reciept that has your name and mailing address.
                                    Your
                                    information will always be private and confidential. For more information contact:
                                    <a href="https://www.canada.ca/en/revenue-agency.html"
                                       target="_blank">
                                          Canada Revenue Agency
                                    </a>
                              </center>
                              <br>
                              Please fill in all of the following information:
                              <hr>
                              <div id="error-message"
                                   class="alert alert-danger hide"
                                   role="alert">
                                    Cannot Leave Input Blank
                              </div>
                              <label for="name">Name:</label>
                              <input id="name"
                                     type="text"
                                     class="form-control"
                                     placeholder="Enter Your Name">

                              <label for="address">Address:</label>
                              <input id="address"
                                     type="text"
                                     class="form-control"
                                     placeholder="Enter Your Name">
                              <div class="row">
                                    <div class="col-6">
                                          <label for="city">City/Town:</label>
                                          <input id="city"
                                                 type="text"
                                                 class="form-control"
                                                 placeholder="Enter City/Town">
                                    </div>
                                    <div class="col-6">
                                          <label for="province">Province/State</label>
                                          <input id="province"
                                                 type="text"
                                                 class="form-control"
                                                 placeholder="Enter Province/State">
                                    </div>
                              </div>
                              <div class="row">
                                    <div class="col-6">
                                          <label for="country">Country</label>
                                          <input id="country"
                                                 type="text"
                                                 class="form-control"
                                                 placeholder="Enter Country">
                                    </div>
                                    <div class="col-6">
                                          <label for="postal-code">Postal Code</label>
                                          <input id="postal-code"
                                                 type="text"
                                                 class="form-control"
                                                 placeholder="Enter Postal Code">
                                    </div>
                              </div>

                              <center>
                                    <h5>Donation Amount:</h5>
                                    <div class="d-flex fs-1 justify-content-center">
                                          $
                                          <input id="donation-amount"
                                                 type="text"
                                                 class="form-control fs-1 m-0 p-0"
                                                 style="border: none; background: none; width: 100%"
                                                 placeholder="0"
                                                 pattern="\d+"
                                                 title="Please enter a positive number">
                                          <script>
                                                // Get the input element
                                                const numericInput = document.getElementById("donation-amount");

                                                // Add an input event listener
                                                numericInput.addEventListener("input", function () {
                                                      // Allow only numbers
                                                      this.value = this.value.replace(/[^0-9]/g, '');
                                                });
                                          </script>
                                    </div>
                              </center>
                              <hr>
                              <center>
                                    <div id="loading"
                                         class="spinner-border text-success hide"
                                         role="status">
                                          <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <button id="donation-submit"
                                            class="button fs-4 my-4">Continue With Donation</button>
                              </center>

                        </div>
                  </div>
            </div>
      </div>
      <!-- // ^ Donation Modal ---------------------------------------- -->

      <?php require_once("components/header.php"); ?>
      <main class="">

            <img class="side-images left"
                 src="assets/images/donation-left.jpg"
                 alt="Norfolk">

            <div class="content-container">
                  <center>
                        <h1 class="heading">Donate Online</h1>
                        <hr>
                        <p>
                              The objectives of the Norfolk Community Foundation are to receive, maintain, manage,
                              control and
                              use donations for the following: <br>
                              <b>
                                    The advancement of education <br>
                                    The relief of poverty<br>
                                    Capital projects<br>
                              </b>
                              For other purposes beneficial to the communities of Norfolk County
                        </p>

                        <!-- // $ Bullets For Objectives -->
                        <ul class="objectives">
                              <li>

                                    Donate stocks with capital gains
                              </li>
                              <li>

                                    Life insurance policy naming NCF as beneficiary
                              </li>
                              <li>

                                    NCF recognized in personal wills
                              </li>
                              <li>

                                    Disposition of estates over a number of years
                              </li>
                              <li>

                                    Create a named or family fund
                              </li>
                              <li>

                                    Create a corporate endowment
                              </li>
                        </ul>

                        <!-- // % 3 Donation Cards -->
                        <section class="row justify-content-evenly">
                              <div class="col-xsm-12 col-sm-12 col-md-3
                               col-md-3 donation-card m-2">
                                    <div>

                                          <h1>
                                                GENERAL FUND DONATIONS
                                          </h1>
                                          <hr>
                                          <p>
                                                If you would like to donate to our "General Funds" account that is
                                                managed by
                                                our
                                                Board of Directors please click the icon below and follow the
                                                instructions.
                                                Your donation will join hundreds of others that help our community in so
                                                many
                                                ways.
                                          </p>
                                    </div>
                                    <button class="donate-button button"
                                            value="General Fund"
                                            data-bs-toggle="modal"
                                            data-bs-target="#donationModal">Donate</button>
                              </div>
                              <div class="col-xsm-12 col-sm-12 col-md-3
                               donation-card m-2">
                                    <div>

                                          <h1>
                                                GENERAL FUND DONATIONS
                                          </h1>
                                          <hr>
                                          <p>
                                                If you would like to donate to our "General Funds" account that is
                                                managed by
                                                our
                                                Board of Directors please click the icon below and follow the
                                                instructions.
                                                Your donation will join hundreds of others that help our community in so
                                                many
                                                ways.
                                          </p>
                                    </div>
                                    <button class="button"
                                            data-bs-toggle="modal"
                                            data-bs-target="#donationModal"
                                            value="General Fund">Donate</button>
                              </div>
                              <div class="col-xsm-12 col-sm-12 col-md-3
                               donation-card m-2">
                                    <div>

                                          <h1>
                                                GENERAL FUND DONATIONS
                                          </h1>
                                          <hr>
                                          <p>
                                                If you would like to donate to our "General Funds" account that is
                                                managed by
                                                our
                                                Board of Directors please click the icon below and follow the
                                                instructions.
                                                Your donation will join hundreds of others that help our community in so
                                                many
                                                ways.
                                          </p>
                                    </div>
                                    <button class="button"
                                            data-bs-toggle="modal"
                                            data-bs-target="#donationModal"
                                            value="General Fund">Donate</button>
                              </div>
                        </section>

                        <!-- // @ Working to help our community through your donation. -->
                        <section class="helping-community">
                              <div class="helping-community-heading d-flex align-items-center">
                                    <img src="assets/images/leafs.jpg"
                                         alt="leafs"
                                         width="100px"
                                         height="100px">
                                    <h1 class="heading">
                                          Working to help our community through your donation.
                                    </h1>
                                    <img src="assets/images/leafs.jpg"
                                         alt="leafs"
                                         width="100px"
                                         height="100px">
                              </div>

                              <hr>
                              <div class="reasons-to-donate">
                                    <div class="reasons-to-donate-container">
                                          <div>
                                                <b>Permanence</b>
                                                <p>Your donation is permanent and will continue to give to the community
                                                      for
                                                      generation.</p>
                                          </div>
                                          <div>
                                                <b>Simplicity</b>
                                                <p>You can help one charity or a number of charities with your gift to
                                                      thefoundation... <b>it is your choice.</b></p>
                                          </div>
                                          <div>
                                                <b>Flexibility</b>
                                                <p>You choose how you want to give based on your financial and
                                                      charitable
                                                      goals.</p>
                                          </div>
                                          <div>
                                                <b>Relevance</b>
                                                <p>Your gift stays in our community and helps where you want it to or
                                                      where
                                                      it's
                                                      needed most.</p>
                                          </div>
                                          <div>
                                                <b>Comfort</b>
                                                <p>Knowing your gift will make a difference in our community for
                                                      generations
                                                      to
                                                      come makes us an easy choice.</p>
                                          </div>
                                    </div>
                                    <div class="reasons-to-donate-container">


                                          <div>
                                                <b>Fiscal Responsibility</b>
                                                <p>The funds are professionally managed to ensure good return at minimal
                                                      cost,
                                                      subjected to an annual audit and public AGM.</p>
                                          </div>
                                          <div>
                                                <b>Accountability</b>
                                                <p>
                                                      Community leaders serve on the volunteer Board of Directors, which
                                                      oversees
                                                      the activities of the Foundation
                                                </p>
                                          </div>
                                          <div>
                                                <b>Tax Advantages</b>

                                                <p>Your gift results in tax savings for you and your estate.</p>
                                          </div>
                                          <div>
                                                <b>Recognition</b>
                                                <p>You can be recognized as a donor or remain anonymous.</p>
                                          </div>
                                    </div>
                              </div>
                        </section>

                        <!-- // ^ Featured Donations -->
                        <section>
                              <h1 class="heading">Featured Funds</h1>
                              <hr>

                              <?php
                              require_once("db/db.php");
                              $sql = "SELECT * FROM `recipients` WHERE featured = 1;";

                              $result = mysqli_query($conn, $sql);

                              if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                          $name = $row["name"];
                                          $description = $row["description"];
                                          $image = $row["image"];
                                          $fund_name = $row["fund_name"]
                                                ?>

                                          <div class="fund-container">
                                                <div class="image-fund-container">
                                                      <img src="assets/images/<?php echo $image ?>"
                                                           alt="<?php echo $name ?>">
                                                      <button class="donate-btn donate-button"
                                                              data-bs-toggle="modal"
                                                              data-bs-target="#donationModal"
                                                              value="<?php echo $fund_name ?>">Donate</button>
                                                </div>
                                                <div class="description-fund-container">
                                                      <div class="description-fund-heading">
                                                            <h1 class="sub-heading">
                                                                  <?php echo $name ?>
                                                            </h1>
                                                            <img src="assets/images/leafs.jpg"
                                                                 alt="leafs"
                                                                 width="100px"
                                                                 height="100px"
                                                                 class="leaf-img">
                                                      </div>
                                                      <hr>

                                                      <p class="text-start">
                                                            <?php echo $description ?>
                                                      </p>
                                                </div>
                                          </div>
                                          <?php
                                    }
                              } else {
                                    // ! No data found
                                    echo "No Featured Donations";
                              } ?>
                        </section>

                        <?php
                        require_once("functions/get-donations.php");

                        // # Get the Recipient Categories
                        $sql = "SELECT * FROM `recipient_category`;";

                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                              while ($row = mysqli_fetch_assoc($result)) {
                                    // * Your Code here
                                    $category = $row["category"];
                                    $description = $row["description"];

                                    ?>

                                    <section>
                                          <h1 class="heading">
                                                <?php echo $category ?>
                                          </h1>
                                          <hr>
                                          <p>
                                                <?php echo $description ?>
                                          </p>

                                          <div class="donations-recipients-container">
                                                <?php getDonations($category, $conn); ?>
                                          </div>
                                    </section>
                                    <?php
                              }
                        } else {
                              // ! No data found
                        }
                        ?>
                  </center>
            </div>

            <img class="side-images right"
                 src="assets/images/donation-right.jpg"
                 alt="Norfolk">
      </main>

      <script type="module"
              src="assets/js/paypal.js"></script>

</body>

</html>