<?php

require_once('../model/Order.php');
require_once('inputValidation.php');

session_start();

if (isset($_SESSION['order'])) {
    try {
        $order = $_SESSION['order'];
        $shippingAddress = $_POST['shippingAddress'];
        $shippingCity = $_POST['shippingCity'];
        $shippingCountry = $_POST['shippingCountry'];
        if (!inputValidation($shippingAddress)) {
            echo "Invalid input. Please enter a valid shipping address.";
        } elseif (!inputValidation($shippingCity)) {
            echo "Invalid input. Please enter a valid shipping city.";
        } elseif (!inputValidation($shippingCountry)) {
            echo "Invalid input. Please enter a valid shipping country.";
        } else {

            $order->setShippingAddress($shippingAddress, $shippingCity, $shippingCountry);
            require_once('../view/shipping-address-set.php');
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else {
    echo "No order in progress";
}
