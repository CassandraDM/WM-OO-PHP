<?php

require_once '../model/Order.php';
require_once 'inputValidation.php';

session_start();

try {
    if (!isset($_POST['customerName']) || !isset($_POST['products'])) {
        $errorMessage = "Would you mind filling the fields, thank you!";
        require_once '../view/order-error.php';
        return;
    }
    $customerName = $_POST['customerName'];
    $products = $_POST['products'];

    if (!inputValidation($customerName)) {
        echo "Invalid input. Please enter a valid customer name.";
    } else {

        $order = new Order($customerName, $products);
        $_SESSION['order'] = $order;

        require_once '../view/order-created.php';
    }
} catch (Error $e) {

    $errorMessage = $e->getMessage();
    require_once '../view/order-error.php';
}

function persistOrder(Order $order)
{
    $_SESSION['order'] = $order;
}
