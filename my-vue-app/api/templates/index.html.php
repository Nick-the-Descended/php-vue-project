<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
<!--    <title>Product List</title>-->
<!--</head>-->
<!--<body>-->
<!--    <h1>Product List</h1>-->
<!--    <a href="index.php?action=add-product">Add</a>-->
<!--    <form action="index.php?action=delete" method="post">-->
<!--        <input type="submit" value="Mass Delete">-->
<!--        <table>-->
<!--            <thead>-->
<!--                <tr>-->
<!--                    <th></th>-->
<!--                    <th>SKU</th>-->
<!--                    <th>Name</th>-->
<!--                    <th>Price</th>-->
<!--                    <th>Attribute</th>-->
<!--                </tr>-->
<!--            </thead>-->
<!--            <tbody>-->
<!--                --><?php //foreach ($products as $product): ?>
<!--                    <tr>-->
<!--                        <td><input type="checkbox" name="productIds[]" value="--><?php //= $product->getId() ?><!--" class="delete-checkbox"></td>-->
<!--                        <td>--><?php //= $product->getSku() ?><!--</td>-->
<!--                        <td>--><?php //= $product->getName() ?><!--</td>-->
<!--                        <td>--><?php //= $product->getPrice() ?><!--</td>-->
<!--                        <td>--><?php //= implode(', ', $product->getAttributes()) ?><!--</td>-->
<!--                    </tr>-->
<!--                --><?php //endforeach; ?>
<!--            </tbody>-->
<!--        </table>-->
<!--    </form>-->
<!--</body>-->
<!--</html>-->