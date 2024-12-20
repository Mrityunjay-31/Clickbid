document.getElementById('payButton').addEventListener('click', function (e) {
    e.preventDefault();

    // Get input field values
    const cardNumber = document.getElementById('cardNumber').value;
    const expiryDate = document.getElementById('expiryDate').value;
    const cvv = document.getElementById('cvv').value;
    const cardholderName = document.getElementById('cardholderName').value;
    const billingAddress = document.getElementById('billingAddress').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const couponCode = document.getElementById('couponCode').value;

    // Simple form validation
    if (!cardNumber || !expiryDate || !cvv || !cardholderName || !billingAddress || !email || !phone) {
        alert("Please fill in all required fields.");
        return;
    }

    // Check if card number is valid (basic validation)
    if (!/^\d{16}$/.test(cardNumber)) {
        alert("Please enter a valid card number.");
        window.location.href = "paymenterror.html"; // Redirect to error page
        return;
    }

    // Check if CVV is valid
    if (!/^\d{3}$/.test(cvv)) {
        alert("Please enter a valid CVV.");
        window.location.href = "paymenterror.html"; 
        return;
    }

    // Simulate a successful payment by redirecting to success page
    if (cardNumber && expiryDate && cvv && cardholderName && billingAddress && email && phone) {
        // Here we simulate a payment success. In a real app, you would integrate Razorpay API for actual payment processing.
        window.location.href = "paymentsuccess.html?transaction_id=" + generateTransactionID();
    }
});

// Function to generate a random transaction ID
function generateTransactionID() {
    return 'TXN' + Math.floor(Math.random() * 1000000); // Example Transaction ID
}
