<!DOCTYPE html>
<html lang="en">

<?php
require_once("config-url.php");


?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Norfolk Community Foundation - Donations</title>
    <link rel="stylesheet"
          href="<?php echo BASE_URL ?>assets/css/general.css">
    <link rel="stylesheet"
          href="<?php echo BASE_URL ?>assets/css/funding.css">
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
                <h1 class="heading">APPLY FOR FUNDING</h1>
                <hr>

                <p>We supply financial support for worthwhile projects that help your community
                    We want to help make Norfolk a better place to live and play
                    by giving back to the community.</p>

                <p>
                    <b>
                        When you have read the below application criteria and you want to apply for a grant please fill
                        out our guided application to start the process.
                    </b>
                </p>

                <h1 class="sub-heading blue">
                    Submission Deadlines May 31st and October 31st
                </h1>
                <p>Consideration outside of these dates on an exceptional basis.</p>
                <h3>- PLEASE READ THE APPLICATION INFO BEFORE STARTING THE GRANT GENERATOR -</h3>

                <!-- // $ Button trigger Application Information modal -->
                <button type="button"
                        class="button"
                        data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                    Information
                </button>

                <!-- // $ Information Application Modal -->
                <div class="modal fade"
                     id="exampleModal"
                     tabindex="-1"
                     aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header info-application-heading">
                                <h5 class="modal-title text-center fs-3"
                                    id="exampleModalLabel">APPLICATION INFORMATION</h5>
                            </div>
                            <div class="modal-body">
                                <p class="green">IF YOU HAVE QUESTIONS ABOUT THIS INFORMATION PLEASE
                                    CONTACT US</p>
                                <hr>

                                <div class="info">
                                    <p>The Foundation supports charitable organizations concerned with education of the
                                        public, health, arts and culture, recreation and social services that operate
                                        for
                                        the citizens of Norfolk County.</p>

                                    <p>Grants are made only to registered charitable organizations or not for profit
                                        groups
                                        (or to endeavours sponsored by an organization with charitable registration)
                                        serving
                                        the residents of Norfolk County.</p>
                                    <p>Grants are awarded to educational institutions on the basis that the project
                                        encourages more efficient use of community resources.</p>
                                    <p>Requests from local chapters of organizations existing primarily to raise funds
                                        for
                                        health-related projects will be considered only if the project provides
                                        service/support for patients or care givers, or specific health promotion
                                        initiatives and medical professional recruitment in this community.</p>
                                    <p>Grants are awarded for definite purposes, and for projects covering a specified
                                        period of time. Multi-year grants are subject to periodic performance reviews.
                                        Preference is given to capital projects which:</p>
                                    <ul>
                                        <li>Encourage more efficient use of community resources</li>
                                        <li>Address the underlying causes of problems in our society rather then dealing
                                            only with
                                            symptoms</li>
                                        <li>Is developed in consultation with other agencies and planning groups and
                                            those
                                            which
                                            promote co-ordination, co-operation and sharing among organizations, and the
                                            elimination
                                            of duplicated services</li>
                                        <li>Promote volunteer participation and citizen involvement in the community
                                            Bursaries and scholarships are awarded to educational institutions and not
                                            to
                                            individuals as per our endowment fund guidelines.</li>
                                    </ul>

                                    <p>Pilot or demonstration projects must include provision for an evaluation, and a
                                        realistic plan for financial viability beyond the pilot stage.</p>

                                    <p class="blue">Grants are not considered in support of operating
                                        expenses
                                        or capital deficits.
                                        Grants are not made to establish or add to endowment funds.
                                        Grants are not made to religious/political organizations for direct
                                        religious/political activities.</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button"
                                        class="info-application-close-btn"
                                        data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="<?php echo BASE_URL . "signup.php" ?>"
                      method="post">

                    <?php if (isset($_GET["error"])) {
                        ?>
                        <div class="alert alert-danger mt-4"
                             role="alert"
                             style="width: 800px;">
                            Please Check All Boxes Before Continuing!
                        </div>
                        <?php
                    } ?>

                    <div class="application-check-list">
                        <div class="form-check">
                            <input class="form-check-input"
                                   type="checkbox"
                                   value=""
                                   id="flexCheckDefault"
                                   name="check1">
                            <label class="form-check-label"
                                   for="flexCheckDefault">
                                We have read and understand Application Info
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input"
                                   type="checkbox"
                                   value=""
                                   id="flexCheckDefault"
                                   name="check2">
                            <label class="form-check-label"
                                   for="flexCheckDefault">
                                We are a registered charity or non-profit
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input"
                                   type="checkbox"
                                   value=""
                                   id="flexCheckDefault"
                                   name="check3">
                            <label class="form-check-label"
                                   for="flexCheckDefault">
                                Funds for capital projects
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input"
                                   type="checkbox"
                                   value=""
                                   id="flexCheckDefault"
                                   name="check4">
                            <label class="form-check-label"
                                   for="flexCheckDefault">
                                Funds not for day to day operations
                            </label>
                        </div>
                    </div>

                    <button id="application-start"
                            type="submit"
                            class="button"
                            disabled>
                        Application
                    </button>
                </form>

            </center>
        </div>

        <img class="side-images right"
             src="assets/images/donation-right.jpg"
             alt="Norfolk">
    </main>

    <script src="assets/js/funding.js"></script>

</body>

</html>