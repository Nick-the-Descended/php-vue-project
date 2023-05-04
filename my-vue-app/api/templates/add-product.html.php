<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Product</title>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Add Product</h1>
    <form action="index.php?action=add-product" method="post" id="product_form">
        <label for="sku">SKU:</label>
        <input type="text" name="sku" id="sku" required>

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="price">Price:</label>
        <input type="number" name="price" id="price" step="0.01" min="0" required>

        <label for="productType">Product Type:</label>
        <select name="productType" id="productType" required>
            <option value="">Select a type</option>
            <option value="DVD">DVD</option>
            <option value="Book">Book</option>
            <option value="Furniture">Furniture</option>
        </select>

        <div id="product-attributes"></div>

        <input type="submit" value="Save">
        <a href="index.php">Cancel</a>
    </form>

    <script>
        const productAttributes = {
            'DVD': {
                html: '<label for="size">Size (MB):</label><input type="number" name="size" id="size" min="0" required>',
            },
            'Book': {
                html: '<label for="weight">Weight (Kg):</label><input type="number" name="weight" id="weight" step="0.01" min="0" required>',
            },
            'Furniture': {
                html: '<label for="height">Height (cm):</label><input type="number" name="height" id="height" min="0" required>' +
                      '<label for="width">Width (cm):</label><input type="number" name="width" id="width" min="0" required>' +
                      '<label for="length">Length (cm):</label><input type="number" name="length" id="length" min="0" required>',
            },
        };

        $("#productType").on("change", function () {
            const selectedType = $(this).val();
            $("#product-attributes").html(selectedType ? productAttributes[selectedType].html : '');
        });
    </script>
</body>
</html>
