<!DOCTYPE html>
<html>

<head>
    <title>The Eshop at its best</title>
</head>

<body>
    <header>
        <h1>The Eshop at its best</h1>
    </header>
    <main>
        <form method="POST" action="../controller/create-order.php">

            <label for="customerName">Customer Name</label>
            <input type="text" name="customerName" id="customerName" required>
            <br>

            <label for="products">Products</label>

            <select name="products[]" id="product" multiple>
                <option value="tshirt">T-shirt</option>
                <option value="jeans">Jeans</option>
                <option value="shoes">Shoes</option>
                <option value="shorts">Shorts</option>
                <option value="cap">Cap</option>
                <option value="sweatshirt">Sweatshirt</option>
            </select>
            <br>

            <button type="submit">Add</button>
        </form>
    </main>
</body>

</html>