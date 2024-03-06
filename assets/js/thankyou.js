import { getEnvVariables, getToken } from "./getToken.js";

// Function to get URL parameter by name
function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

// Example usage to get the 'paymentId' and 'PayerID' parameters
var paymentId = getParameterByName('paymentId');
var payerId = {
    "payer_id": getParameterByName('PayerID')
};

// Use the obtained parameters as needed
console.log('Payment ID:', paymentId);
console.log('Payer ID:', payerId);



// Construct the PayPal execute URL
const paypalExecuteUrl = `https://api.sandbox.paypal.com/v1/payments/payment/${paymentId}/execute`;

const variables = await getEnvVariables();

const accessToken = await getToken(variables.username, variables.password);

console.log(accessToken);

try {

    if (accessToken) {

        // Make a POST request to Execute the PayPal payment
        const response = await fetch(paypalExecuteUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${accessToken}`
            },
            body: JSON.stringify(payerId)
        });

        // Parse the response
        const responseData = await response.json();
        console.log(responseData);
        // Check if the payment was successfully execute
        if (response.ok) {

            document.getElementById("loading").remove();
            document.getElementById("thank-you").classList.remove("hide");

            const transaction_id = responseData.transactions[0].related_resources[0].authorization.id;
            const donation_amount = responseData.transactions[0].amount.total;
            const donation_status = "Completed";
            const donation_currency = responseData.transactions[0].amount.currency;
            const fund_name = responseData.transactions[0].custom;
            const donor_full_name = `${responseData.payer.payer_info.first_name} ${responseData.payer.payer_info.last_name}`
            const donor_email = responseData.payer.payer_info.email;
            const donor_address = `${responseData.payer.payer_info.shipping_address.line1}, ${responseData.payer.payer_info.shipping_address.city}, ${responseData.payer.payer_info.shipping_address.state}`;
            const donor_zip_code = responseData.payer.payer_info.shipping_address.postal_code;

            await saveToDateBase(transaction_id, donation_amount, donation_status, donation_currency, fund_name, donor_full_name, donor_email, donor_address, donor_zip_code);

        } else {
            console.error('Failed to Execute PayPal payment:', responseData);
            displayError();
        }
    } else {
        console.error('Failed to get access token');
        displayError();
    }
} catch (error) {
    console.error('Error executing PayPal payment:', error);
    displayError();
}

function displayError() {
    document.getElementById("loading").remove();
    document.getElementById("error").classList.remove("hide");
}




async function saveToDateBase(transaction_id, donation_amount, donation_status, donation_currency, fund_name, donor_full_name, donor_email, donor_address, donor_zip_code) {
    // Assuming your PHP file is named handleDonation.php
    const phpFileUrl = 'includes/add-donation.php';

    // Data to be sent to the PHP file
    const requestData = {
        "transaction_id": transaction_id,
        "donation_amount": donation_amount,
        "donation_status": donation_status,
        "donation_currency": donation_currency,
        "fund_name": fund_name,
        "donor_full_name": donor_full_name,
        "donor_email": donor_email,
        "donor_address": donor_address,
        "donor_zip_code": donor_zip_code,
    };

    console.log(requestData);

    // Fetch request options
    const requestOptions = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(requestData),
    };

    // Make the fetch request
    fetch(phpFileUrl, requestOptions)
        .then(response => response.json())
        .then(data => {
            console.log('Response from PHP file:', data);
        })
        .catch(error => {
            console.error('Error during fetch request:', error);
        });
}