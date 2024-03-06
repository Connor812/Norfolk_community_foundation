<?php

// @ This Filters the Funds By Name Alphabetically 
$name_order = "SELECT r.id, r.fund_name,
    r.start_date,
    SUM(d.donation_amount) AS total_donation_amount
FROM recipients r
    JOIN ncf_donations d ON r.fund_name = d.fund_name
GROUP BY r.id, r.fund_name,
    r.start_date
ORDER BY r.fund_name ASC;";

// ! This Filters the Funds By Name Alphabetically Reverse 
$name_order_rev = "SELECT r.id, r.fund_name,
    r.start_date,
    SUM(d.donation_amount) AS total_donation_amount
FROM recipients r
    JOIN ncf_donations d ON r.fund_name = d.fund_name
GROUP BY r.id, r.fund_name,
    r.start_date
ORDER BY r.fund_name DESC;";


// @ This Filters the Funds By Earliest Date
$earliest_date = "SELECT r.id, r.fund_name,
MIN(r.start_date) as start_date,
SUM(d.donation_amount) AS total_donation_amount
FROM recipients r
JOIN ncf_donations d ON r.fund_name = d.fund_name
GROUP BY r.id, r.fund_name
ORDER BY start_date ASC;";

// ! This Filters the Funds By Latest Date
$latest_date = "SELECT r.id, r.fund_name,
MIN(r.start_date) as start_date,
SUM(d.donation_amount) AS total_donation_amount
FROM recipients r
JOIN ncf_donations d ON r.fund_name = d.fund_name
GROUP BY r.id, r.fund_name
ORDER BY start_date DESC;";

// @ This Filters the Funds By Highest Total
$highest_total = "SELECT r.id, r.fund_name,
r.start_date,
SUM(d.donation_amount) AS total_donation_amount
FROM recipients r
JOIN ncf_donations d ON r.fund_name = d.fund_name
GROUP BY r.id, r.fund_name,
r.start_date
ORDER BY total_donation_amount DESC;";

// ! This Filters the Funds By Highest Total
$lowest_total = "SELECT r.id, r.fund_name,
r.start_date,
SUM(d.donation_amount) AS total_donation_amount
FROM recipients r
JOIN ncf_donations d ON r.fund_name = d.fund_name
GROUP BY r.id, r.fund_name,
r.start_date
ORDER BY total_donation_amount ASC;";

// % This is the plain query that will get basic unfiltered information
$plain = "SELECT r.id, r.fund_name,
r.start_date,
SUM(d.donation_amount) AS total_donation_amount
FROM recipients r
JOIN ncf_donations d ON r.fund_name = d.fund_name
GROUP BY r.id, r.fund_name,
r.start_date;";

$funding_search = "SELECT r.id, r.fund_name,
    r.start_date,
    SUM(d.donation_amount) AS total_donation_amount
FROM recipients r
    JOIN ncf_donations d ON r.fund_name = d.fund_name
WHERE r.fund_name = ?
GROUP BY r.id, r.fund_name,
    r.start_date;";