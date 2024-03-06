import { getEnvVariables, getToken } from "./getToken.js";


const donationModal = document.getElementById("donationModal");
const donateBtns = document.querySelectorAll(".donate-button");

donateBtns.forEach(donateBtn => {
    donateBtn.addEventListener("click", function (event) {
        event.preventDefault();
        const donation = donateBtn.value;
        donationModal.setAttribute("donation-name", donation);
    });
});

const donationSubmitBtn = document.getElementById("donation-submit");

donationSubmitBtn.addEventListener("click", async function () {

    const whoDonationIsFor = document.getElementById("donationModal").getAttribute("donation-name");
    const errorMessage = document.getElementById("error-message");
    const name = document.getElementById("name").value;
    const address = document.getElementById("address").value;
    const city = document.getElementById("city").value;
    const province = document.getElementById("province").value;
    const country = document.getElementById("country").value;
    const postalCode = document.getElementById("postal-code").value;
    const donationAmount = document.getElementById("donation-amount").value;

    if (
        name.trim() === "" ||
        address.trim() === "" ||
        city.trim() === "" ||
        province.trim() === "" ||
        country.trim() === "" ||
        postalCode.trim() === "" ||
        donationAmount.trim() === ""
    ) {
        errorMessage.classList.remove("hide");
        return;
    }

    const variables = await getEnvVariables();
    const accessToken = await getToken(variables.username, variables.password);

    let donation =
    {
        "intent": "AUTHORIZE",
        "payer": {
            "payment_method": "paypal"
        },
        "transactions": [
            {
                "amount": {
                    "total": donationAmount,
                    "currency": "CAD",
                    "details": {
                        "subtotal": donationAmount,
                        "tax": "0.00",
                        "insurance": "0.00"
                    }
                },
                "description": "Thank You For Your Donation!",
                "custom": whoDonationIsFor,
                "invoice_number": "",
                "payment_options": {
                    "allowed_payment_method": "INSTANT_FUNDING_SOURCE"
                },
                "soft_descriptor": "DONATION"
            }
        ],
        "note_to_payer": "Thank you for your donation!",
        "redirect_urls": {
            "return_url": "https://localhost/Norfolk/thankyou.php", // Change these urls before production
            "cancel_url": "https://localhost/Norfolk/cancelled.php"
        }
    }

    try {

        if (accessToken) {
            const paymentApiEndpoint = 'https://api-m.sandbox.paypal.com/v1/payments/payment';

            // Make a POST request to initiate the PayPal payment
            const response = await fetch(paymentApiEndpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${accessToken}`
                },
                body: JSON.stringify(donation)
            });

            // Parse the response
            const responseData = await response.json();

            // Check if the payment was successfully initiated
            if (response.ok) {
                // Redirect the user to the PayPal approval URL
                window.location.href = responseData.links.find(link => link.rel === 'approval_url').href;
            } else {
                console.error('Failed to initiate PayPal payment:', responseData);
            }
        } else {
            console.error('Failed to get access token');
        }
    } catch (error) {
        console.error('Error initiating PayPal payment:', error);
    }
});