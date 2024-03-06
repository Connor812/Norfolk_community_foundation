<?php require_once("../config-url.php"); ?>
<div class="index-button-container">
    <a id="button-1"
       class="<?php echo ($filename === "home.php") ? "button-active" : "" ?>"
       href="<?php echo ADMIN_URL . "home.php" ?>">
        Index
    </a>
    <a id="button-2"
       class="<?php echo ($filename === "donations.php" || $filename === "display-fund.php" || $filename === "new_fund.php") ? "button-active" : "" ?>"
       href="<?php echo ADMIN_URL . "donations.php" ?>">
        Donations
    </a>
    <a id="button-3"
       class="<?php echo ($filename === "funding.php" || $filename === "display-grant.php") ? "button-active" : "" ?>"
       href="<?php echo ADMIN_URL . "funding.php" ?>">
        Funding
    </a>
    <a id="button-4"
       class="<?php echo ($filename === "aboutus.php") ? "button-active" : "" ?>"
       href="<?php echo ADMIN_URL . "aboutus.php" ?>">
        About Us
    </a>
    <a id="button-5"
       class="<?php echo ($filename === "projects.php") ? "button-active" : "" ?>"
       href="<?php echo ADMIN_URL . "projects.php" ?>">
        Projects
    </a>
</div>