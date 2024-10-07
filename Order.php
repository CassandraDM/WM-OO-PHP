<?php

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

    //create an order
    //delete products
    //add products
    //choose shipping method
    //fill shipping address
    //pay
    //cancel

    public function __construct(string $customerName, array $products)
    {
        $this->id = rand();
        $this->products = $products;
        $this->totalPrice = count(value: $products) * 5;
        $this->customerName = $customerName;
        $this->createdAt = new DateTime();
        $this->status = 'CART';

        echo "Order n°{$this->id} created";
    }
}

$order = new Order(customerName: 'John Doe', products: ['product1', 'product2', 'product3']);
