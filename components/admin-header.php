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
            <img src="../assets/images/norfolk logo.jpg"
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
                    <a class="nav-link"
                       href="donations.php">Donations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="aboutus.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="funding.php">Funding</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       href="projects.php">Projects</a>
                </li>
            </ul>
            <a class="nav-link"
               href="login.php">

            </a>
        </div>
    </div>
</nav>