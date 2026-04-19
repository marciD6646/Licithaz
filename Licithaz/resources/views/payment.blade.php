@vite('resources/css/app.css')
@vite('resources/js/app.js')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="Payment-container">
        <h1 class="Payment-title">Payment</h1>
        <div class="Payment-methods">
        </div>
        <div class="Payment-details">
            <h2>Payment Details</h2>
            <form>
                <label for="CN">Number:</label>
                <input type="text" id="CN" name="CN">

                <label for="expiry-date">Expiry Date:</label>
                <input type="text" id="expiry-date" name="expiry-date">

                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv">
            </form>
        </div>
        <p>Amount: {paymentValue}</p>
        <button class="Payment-button">Pay Now</button>
    </div>
</body>

</html>