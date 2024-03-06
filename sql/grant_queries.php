<?php

// @ This is for organizing name alphabetically
$name_order = "SELECT `id`, `organization`, `date`, `amount_granted` FROM `grant_applications` ORDER BY `organization` ASC;";

// ! This is for organizing name alphabetically
$name_order_rev = "SELECT `id`, `organization`, `date`, `amount_granted` FROM `grant_applications` ORDER BY `organization` DESC;";

// @ This is for organizing earliest Date
$earliest_date = "SELECT `id`, `organization`, `date`, `amount_granted` FROM `grant_applications` ORDER BY `date` ASC;";

// ! This is for organizing latest Date
$latest_date = "SELECT `id`, `organization`, `date`, `amount_granted` FROM `grant_applications` ORDER BY `date` DESC;";

// @ This is for organizing highest grant Amount
$highest_total = "SELECT `id`, `organization`, `date`, `amount_granted` FROM `grant_applications` ORDER BY `amount_granted` DESC;";

// ! This is for organizing lowest grant Amount
$lowest_total = "SELECT `id`, `organization`, `date`, `amount_granted` FROM `grant_applications` ORDER BY `amount_granted` ASC;";

// ? This is for if the user wants to search for an organization
$grant_search = "SELECT `id`, `organization`, `date`, `amount_granted` FROM `grant_applications` WHERE `organization` = ?;";