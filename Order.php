<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Order
{
    public static $CART_STATUS = 'CART';
    public static $SHIPPING_ADDRESS_SET_STATUS = 'SHIPPING_ADDRESS_SET';
    public static $SHIPPING_METHOD_SET_STATUS = 'SHIPPING_METHOD_SET';
    public static $PAID_STATUS = 'PAID';
    public static $MAX_PRODUCT_PER_ORDER = 5;
    public static $BLACKLISTED_CUSTOMER = 'David Robert';
    public static $UNIQUE_PRODUCT_PRICE = 5;
    public static $AUTHORIZED_SHIPPING_COUNTRIES = ['France', 'Belgique', 'Luxembourg'];
    public static $AVAILABLE_SHIPPING_METHODS = ['chronopost Express', 'point relais', 'domicile'];
    public static $PAID_SHIPPING_METHOD = 'chronopost Express';
    public static $PAID_SHIPPING_METHOD_COST = 5;
    private int $id;
    private array $products;
    private float $totalPrice;
    private ?string $shippingMethod = null;
    private ?string $shippingCity = null;
    private ?string $shippingAddress = null;
    private ?string $shippingCountry = null;
    private string $customerName;
    private DateTime $createdAt;
    private string $status;

    public function __construct(string $customerName, array $products)
    {
        $this->id = rand();
        if (count($products) > Order::$MAX_PRODUCT_PER_ORDER) {
            throw new Error('No more than ' . Order::$MAX_PRODUCT_PER_ORDER . ' products allowed');
        }
        $this->products = $products;
        $this->totalPrice = count($products) * Order::$UNIQUE_PRODUCT_PRICE;
        if ($customerName === Order::$BLACKLISTED_CUSTOMER) {
            throw new Error('We don\'t serve rude people!');
        }
        $this->customerName = $customerName;
        $this->createdAt = new DateTime();
        $this->status = Order::$CART_STATUS;

        echo "<br>Order n°{$this->id} created<br>";
    }

    // Remove a product (5€ per product)
    public function removeProduct(string $product)
    {
        if (!in_array($product, $this->products)) {
            throw new Error('Sorry, this product is not in your cart');
        }
        $key = array_search($product, $this->products);
        unset($this->products[$key]);
        $this->totalPrice -= Order::$UNIQUE_PRODUCT_PRICE;
    }

    // Add a product (5€ per product)
    public function addProduct(string $product)
    {
        if (in_array($product, $this->products)) {
            throw new Error('This product is already in your cart');
        }
        if ($this->status !==  Order::$CART_STATUS) {
            throw new Error('You can\'t add a product to a cart that is already paid');
        }
        $this->products[] = $product;
        $this->totalPrice += Order::$UNIQUE_PRODUCT_PRICE;
    }

    // Shipping address (for country: choice between France, Belgium or Luxembourg)
    public function setShippingAddress(string $address, string $city, string $country)
    {
        if ($this->status !==  Order::$CART_STATUS) {
            throw new Error('You can\'t set a shipping address to a cart that is already paid');
        }
        if (!in_array($country, Order::$AUTHORIZED_SHIPPING_COUNTRIES)) {
            throw new Error('Sorry, we only deliver in France, Belgium and Luxembourg');
        }
        $this->shippingAddress = $address;
        $this->shippingCity = $city;
        $this->shippingCountry = $country;
        $this->status =  Order::$SHIPPING_ADDRESS_SET_STATUS;
    }

    // Shipping method (choice between Chronopost Express, relay point or at home)
    public function setShippingMethod(string $method)
    {
        if ($this->shippingAddress === null) {
            throw new Error('You can\'t choose how you want to be delivered if we don\'t know where to deliver');
        }
        if (!in_array($method, Order::$AVAILABLE_SHIPPING_METHODS)) {
            throw new Error('Sorry, we only deliver with Chronopost Express, in a relay point or at home');
        }
        if ($this->shippingMethod === Order::$PAID_SHIPPING_METHOD) {
            $this->totalPrice += Order::$PAID_SHIPPING_METHOD_COST;
        }
        $this->shippingMethod = $method;
        $this->status = Order::$SHIPPING_METHOD_SET_STATUS;
    }

    // Pay
    public function pay()
    {
        if ($this->shippingMethod === null) {
            throw new Error('You can\'t pay a cart if we don\'t know how to deliver it');
        }
        $this->status = Order::$PAID_STATUS;
    }

    // Status available: "CART", "SHIPPING_ADDRESS_SET", "SHIPPING_METHOD_SET" & "PAID"
}


// Test
$order = new Order('John Doe', ['product1', 'product2', 'product3']);

// Blacklisted name (David Robert)
try {
    $order2 = new Order('David Robert', ['product1', 'product2', 'product3']);
} catch (Error $e) {
    echo $e->getMessage();
}

?>
</br>
<?php

// More than 5 products in the order
try {
    $order3 = new Order('John Doe', ['product1', 'product2', 'product3', 'product4', 'product5', 'product6']);
} catch (Error $e) {
    echo $e->getMessage();
}

?>
</br>
<?php

$order->removeProduct('product2');

// Removing a product that is not in the cart
try {
    $order->removeProduct('product2');
} catch (Error $e) {
    echo $e->getMessage();
}

?>
</br>
<?php

$order->addProduct('product2');

// Adding a product that is already in the cart
try {
    $order->addProduct('product2');
} catch (Error $e) {
    echo $e->getMessage();
}

?>
</br>
<?php

$order->setShippingAddress('1 rue de Paris', 'Paris', 'France');

// Trying to set a shipping address outside France, Belgium, or Luxembourg
try {
    $order->setShippingAddress('1 rue de Paris', 'Paris', 'Espagne');
} catch (Error $e) {
    echo $e->getMessage();
}

?>
</br>
<?php

$order->setShippingMethod('chronopost Express');

// Shipping method without an address
try {
    $order->setShippingMethod('chronopost');
} catch (Error $e) {
    echo $e->getMessage();
}

$order->pay();

?>
</br>
<?php

$order2 = new Order('John Doe', ['product1', 'product2', 'product3']);
$order2->setShippingAddress('1 rue de Paris', 'Paris', 'France');

// Trying to pay without setting the shipping method
try {
    $order2->pay();
} catch (Error $e) {
    echo $e->getMessage();
}

?>
</br>
<?php

$order3 = new Order('John Doe', ['product1', 'product2', 'product3']);

// Trying to set the shipping method without setting the address first
try {
    $order3->setShippingMethod('chronopost Express');
} catch (Error $e) {
    echo $e->getMessage();
}

?>