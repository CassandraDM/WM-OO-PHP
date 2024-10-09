<?php require_once('../view/partials/header.php'); ?>
<main>
    <form method="POST" action="../controller/set-shipping-method.php">
        <label for="shippingMethod">Shipping Method</label>
        <br>
        <select id="shippingMethod" name="shippingMethod">
            <option value="chronopost Express">Chronopost Express</option>
            <option value="point relais">Relay point</option>
            <option value="domicile">At home</option>
        </select>
        <br>
        <button type="submit">Submit</button>
    </form>
</main>
<?php require_once('../view/partials/footer.php'); ?>