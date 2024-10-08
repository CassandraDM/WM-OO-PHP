<?php

require_once '../model/Order.php';

try {
    $order = new Order('John Doe', ['product1', 'product2', 'product3']);
    require_once '../view/order-created.php';
} catch (Error $e) {
    require_once ' ../view/order-error.php';
}
