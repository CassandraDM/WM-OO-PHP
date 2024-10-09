<?php require_once('../view/partials/header.php'); ?>
<main>
    <form method="POST" action="../controller/process-shipping-address.php">
        <label for="shippingAddress">Shipping Address</label>
        <input type="text" name="shippingAddress" id="shippingAddress" required pattern="^(?=.*\S).{2,100}$" title="The address must contains between 2 to 100 characters">
        <br>

        <label for="shippingCity">Shipping City</label>
        <input type="text" name="shippingCity" id="shippingCity" required pattern="^(?=.*\S).{2,100}$" title="The address must contains between 2 to 100 characters">
        <br>

        <label for="shippingCountry">Shipping Country</label>
        <input type="text" name="shippingCountry" id="shippingCountry" required pattern="^(?=.*\S).{2,100}$" title="The address must contains between 2 to 100 characters">
        <br>

        <button type="submit">Submit</button>
    </form>
</main>
<?php require_once('../view/partials/footer.php'); ?>