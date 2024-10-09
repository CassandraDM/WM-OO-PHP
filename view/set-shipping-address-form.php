<head>
    <title>The Eshop at its best</title>
</head>

<body>
    <header>
        <h1>The Eshop at its best</h1>
    </header>
    <main>
        <form method="POST" action="../controller/set-shipping-address.php">
            <label for="shippingAddress">Shipping Address</label>
            <input type="text" name="shippingAddress" id="shippingAddress" minlength="2" maxlength="100" pattern="^(?=.*\S).{2,100}$" required>
            <br>

            <label for="shippingCity">Shipping City</label>
            <input type="text" name="shippingCity" id="shippingCity" minlength="2" maxlength="100" pattern="^(?=.*\S).{2,100}$" required>
            <br>

            <label for="shippingCountry">Shipping Country</label>
            <input type="text" name="shippingCountry" id="shippingCountry" minlength="2" maxlength="100" pattern="^(?=.*\S).{2,100}$" required>
            <br>

            <button type="submit">Submit</button>
        </form>
    </main>
</body>