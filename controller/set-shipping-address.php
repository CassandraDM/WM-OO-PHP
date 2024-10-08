<?php

require_once('../model/Order.php');

session_start();

if (isset($_SESSION['order'])) {
    $order = $_SESSION['order'];
    $shippingAddress = $_POST['shippingAddress'];
    $shippingCity = $_POST['shippingCity'];
    $shippingCountry = $_POST['shippingCountry'];
    $order->setShippingAddress($shippingAddress, $shippingCity, $shippingCountry);
    require_once('../view/shipping-address-set.php');
} else {
    echo "No order in progress";
}

//l'adresse de livraison mise via le fichier controller/set-shipping-address.php soit issue d'un formulaire