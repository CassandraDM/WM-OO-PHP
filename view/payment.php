<?php require_once '../view/partials/header.php'; ?>
<main>
    <h1>Payment</h1>
    <form action="../controller/payment.php" method="POST">
        <input type="hidden" name="action" value="payment">
        <button type="submit">Pay</button>
    </form>
</main>
<?php require_once '../view/partials/footer.php'; ?>