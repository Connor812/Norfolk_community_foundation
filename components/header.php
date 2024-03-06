<?php
session_start();
?>

<style>
    nav {
        z-index: 1;
        width: 100%;
        position: fixed !important;
    }

    .nav-link {
        color: white !important;
        transition: 300ms;
    }

    .nav-link:hover {
        color: rgb(206, 206, 206) !important;
        transform: translateY(-5px);
    }

    .active {
        color: rgb(206, 206, 206) !important;
    }
</style>

<?php
// # This gets the current page and sets active the to the current
$currentUri = $_SERVER['REQUEST_URI'];
$path = parse_url($currentUri, PHP_URL_PATH);
$filename = pathinfo($path, PATHINFO_BASENAME);
?>

<nav class="navbar navbar-expand-lg navbar-light bg-primary border border-dark">
    <div class="container-fluid">
        <a class="navbar-brand"
           href="#">
            <img src="assets/images/norfolk logo.jpg"
                 alt=""
                 width="100px">
        </a>
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse"
             id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link"
                       aria-current="page"
                       href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($filename == 'donation.php') ? 'active' : ''; ?>"
                       href="donation.php">Donations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($filename == 'aboutus.php') ? 'active' : ''; ?>"
                       href="aboutus.php">About Us</a>
                </li>
                <li class="nav-item">
                    <?php

                    if (isset($_SESSION["stage"])) {
                        if ($_SESSION["stage"] === 2) {
                            $funding_link = "ga-step-2.php";
                        } elseif ($_SESSION["stage"] === 3) {
                            $funding_link = "ga-step-3.php";
                        } elseif ($_SESSION["stage"] === 4) {
                            $funding_link = "ga-step-4.php";
                        }
                    } else {
                        $funding_link = "funding.php";
                    }

                    ?>
                    <a class="nav-link <?php echo ($filename == 'funding.php') ? 'active' : ''; ?>"
                       href="<?php echo $funding_link ?>">Funding</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($filename == 'projects.php') ? 'active' : ''; ?>"
                       href="projects.php">Projects</a>
                </li>
            </ul>
            <?php

            if (isset($_SESSION["ga_username"])) {
                ?>
                <a class="nav-link <?php echo ($filename == 'login.php') ? 'active' : ''; ?>"
                   href="includes/logout.inc.php">
                    Logout
                </a>
                <?php
            } else {
                ?>
                <a class="nav-link <?php echo ($filename == 'login.php') ? 'active' : ''; ?>"
                   href="login.php">
                    Login
                </a>
                <?php
            }

            ?>




        </div>
    </div>
</nav>