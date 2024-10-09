<?php
require_once '../model/Order.php';

session_start();

if (isset($_SESSION['order'])) {
    try {
        $order = $_SESSION['order'];
        $order->pay();
        $_SESSION['order'] = $order;
        require_once '../view/payment-success.php';
    } catch (Error $e) {
        $errorMessage = $e->getMessage();
        require_once '../view/order-error.php';
    }
} else {
    require_once '../view/404.php';
}
