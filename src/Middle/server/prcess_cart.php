<?php
/**
 * Created by PhpStorm.
 * User: violinsolo
 * Date: 02/10/2017
 * Time: 6:01 PM
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart Server</title>

    <style>
        table {
            width: 400px;
            border-collapse: collapse;
        }
        th {
            width: 100px;
            text-align: center;
            background: #4CAF50;
            color: aliceblue;
        }
        td {
            width: 100px;
            text-align: center;
        }
    </style>
</head>
<body>

<h1>Received Form (What the customer submitted)</h1>


    <table>
        <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php echo $_POST["product_a_name"];?></td>
            <td><?php echo $_POST["product_a_price"]; ?></td>
            <td><?php echo $_POST["product_a_quantity"];?></td>
            <td><?php echo $_POST["product_a_subtotal"];?></td>
        </tr>
        <tr>
            <td><?php echo $_POST["product_b_name"];?></td>
            <td><?php echo $_POST["product_b_price"]; ?></td>
            <td><?php echo $_POST["product_b_quantity"];?></td>
            <td><?php echo $_POST["product_b_subtotal"];?></td>
        </tr>
        <tr>
            <td><?php echo $_POST["product_c_name"];?></td>
            <td><?php echo $_POST["product_c_price"]; ?></td>
            <td><?php echo $_POST["product_c_quantity"];?></td>
            <td><?php echo $_POST["product_c_subtotal"];?></td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <th>Total</th>
            <th></th>
            <th><?php echo $_POST["total_quantity"]; ?></th>
            <th><?php echo $_POST["total_price"]; ?></th>
        </tr>
        </tfoot>
    </table>

</body>
</html>
