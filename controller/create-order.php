<?php

require_once '../model/Order.php';

session_start();

try {
    $customerName = $_POST['customerName'];
    $products = $_POST['products'];

    $order = new Order($customerName, $products);

    $_SESSION['order'] = $order;

    require_once '../view/order-created.php';
} catch (Error $e) {

    require_once ' ../view/order-error.php';
}
