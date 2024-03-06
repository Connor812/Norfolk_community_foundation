<?php

// Get the raw POST data
$inputJSON = file_get_contents('php://input');

// Decode the JSON data into a PHP array
$data = json_decode($inputJSON, true);

// You can now access the data as an associative array
$transaction_id = $data['transaction_id'];
$donation_amount = $data['donation_amount'];
$donation_status = $data['donation_status'];
$donation_currency = $data['donation_currency'];
$fund_name = $data["fund_name"];
$donor_full_name = $data['donor_full_name'];
$donor_email = $data['donor_email'];
$donor_address = $data['donor_address'];
$donor_zip_code = $data['donor_zip_code'];

// Your database insertion logic goes here

// Echo all the received data
// echo "Transaction ID: $transaction_id\n";
// echo "Donation Amount: $donation_amount\n";
// echo "Donation Status: $donation_status\n";
// echo "Donation Currency: $donation_currency\n";
// echo "Donor Fund Name: $fund_name\n";
// echo "Donor Full Name: $donor_full_name\n";
// echo "Donor Email: $donor_email\n";
// echo "Donor Address: $donor_address\n";
// echo "Donor Zip Code: $donor_zip_code\n";

require_once("../db/db.php");

// Insert statement
$sql = "INSERT INTO `ncf_donations` (`transaction_id`, `donation_amount`, `donation_status`, `donation_currency`, `fund_name`, `donor_full_name`, `donor_email`, `donor_address`, `donor_zip_code`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    $stmt = $conn->prepare($sql);
    exit;
}

// Bind parameters to the prepared statement
$stmt->bind_param("sssssssss", $transaction_id, $donation_amount, $donation_status, $donation_currency, $fund_name, $donor_full_name, $donor_email, $donor_address, $donor_zip_code);

// Execute the statement
if ($stmt->execute()) {
    // Insertion successful
    echo json_encode(array("status" => "success", "message" => "Donation inserted successfully."));
    $stmt->close();
    exit;
} else {
    // Insertion failed
    echo json_encode(array("status" => "error", "message" => "Failed to insert donation."));
    $stmt->close();
    exit;
}