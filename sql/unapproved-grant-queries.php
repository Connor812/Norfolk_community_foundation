<?php

$plain = "SELECT `id`, `organization`, `date`, `requested_amount`, `read_status` FROM `grant_applications` WHERE approved = 'unapproved';";

$name_order = "SELECT `id`, `organization`, `date`, `requested_amount`, `read_status` FROM `grant_applications` WHERE approved = 'unapproved' ORDER BY `organization` ASC;";

$name_order_rev = "SELECT `id`, `organization`, `date`, `requested_amount`, `read_status` FROM `grant_applications` WHERE approved = 'unapproved' ORDER BY `organization` DESC;";

$earliest_date = "SELECT `id`, `organization`, `date`, `requested_amount`, `read_status` FROM `grant_applications` WHERE approved = 'unapproved' ORDER BY `date` ASC;";

$latest_date = "SELECT `id`, `organization`, `date`, `requested_amount`, `read_status` FROM `grant_applications` WHERE approved = 'unapproved' ORDER BY `date` DESC;";

$highest_total = "SELECT `id`, `organization`, `date`, `requested_amount`, `read_status` FROM `grant_applications` WHERE approved = 'unapproved' ORDER BY `requested_amount` DESC;";

$lowest_total = "SELECT `id`, `organization`, `date`, `requested_amount`, `read_status` FROM `grant_applications` WHERE approved = 'unapproved' ORDER BY `requested_amount` ASC;";

$unapproved_grant_search = "SELECT `id`, `organization`, `date`, `requested_amount`, `read_status` FROM `grant_applications` WHERE organization = ? AND approved = 'unapproved';";

$read = "SELECT `id`, `organization`, `date`, `requested_amount`, `read_status` FROM `grant_applications` WHERE approved = 'unapproved' AND read_status = 'read'";

$un_read = "SELECT `id`, `organization`, `date`, `requested_amount`, `read_status` FROM `grant_applications` WHERE approved = 'unapproved' AND read_status = 'un-read'";