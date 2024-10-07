<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Order
{
    private int $id;

    private array $products;

    private float $totalPrice;

    private ?string $shippingMethod;

    private ?string $shippingAddress;

    private string $customerName;

    private DateTime $createdAt;

    private string $status;


    public function __construct(string $customerName, array $products)
    {
        $this->id = rand();
        if (count(value: $products) > 5) {
            throw new Error('You can\'t order more than 5 products');
        }
        $this->products = $products;
        $this->totalPrice = count(value: $products) * 5;
        if ($customerName === 'David Robert') {
            throw new Error('You are blacklisted');
        }
        $this->customerName = $customerName;
        $this->createdAt = new DateTime();
        $this->status = 'CART';

        echo "Order n°{$this->id} created";
    }


    public function removeProduct(string $product)
    {
        if (!in_array(needle: $product, haystack: $this->products)) {
            throw new Error('Product not found');
        }
        $key = array_search(needle: $product, haystack: $this->products);
        unset($this->products[$key]);
    }
}

$order = new Order(customerName: 'John Doe', products: ['product1', 'product2', 'product3']);

try {
    $order2 = new Order(customerName: 'David Robert', products: ['product1', 'product2', 'product3']);
} catch (Error $e) {
    echo $e->getMessage();
}

try {
    $order3 = new Order(customerName: 'John Doe', products: ['product1', 'product2', 'product3', 'product4', 'product5', 'product6']);
} catch (Error $e) {
    echo $e->getMessage();
}


$order->removeProduct(product: 'product2');

try {
    $order->removeProduct(product: 'product2');
} catch (Error $e) {
    echo $e->getMessage();
}
