<?php

$plain = "SELECT `id`, `organization`, `date`, `amount_granted` FROM `grant_applications` WHERE approved = 'approved';";

$name_order = "SELECT `id`, `organization`, `date`, `amount_granted` FROM `grant_applications` WHERE approved = 'approved' ORDER BY `organization` ASC;";

$name_order_rev = "SELECT `id`, `organization`, `date`, `amount_granted` FROM `grant_applications` WHERE approved = 'approved' ORDER BY `organization` DESC;";

$earliest_date = "SELECT `id`, `organization`, `date`, `amount_granted` FROM `grant_applications` WHERE approved = 'approved' ORDER BY `date` ASC;";

$latest_date = "SELECT `id`, `organization`, `date`, `amount_granted` FROM `grant_applications` WHERE approved = 'approved' ORDER BY `date` DESC;";

$highest_total = "SELECT `id`, `organization`, `date`, `amount_granted` FROM `grant_applications` WHERE approved = 'approved' ORDER BY `amount_granted` DESC;";

$lowest_total = "SELECT `id`, `organization`, `date`, `amount_granted` FROM `grant_applications` WHERE approved = 'approved' ORDER BY `amount_granted` ASC;";

$approved_grant_search = "SELECT `id`, `organization`, `date`, `amount_granted` FROM `grant_applications` WHERE organization = ? AND approved = 'approved';";