<?php
/**
 * Created by PhpStorm.
 * User: violinsolo
 * Date: 02/10/2017
 * Time: 6:01 PM
 */

include "des.php";

$des_key = '';
foreach (file('../database/deskey.txt') as $item) {
    $des_key = $item;
    break;
}

echo "key: |" . $des_key . "|<br/>";

// PHP des encryption API (in des.php)
$ciphertext = $_POST['encrypted'];

echo "DES encrypted message: " . $ciphertext;
echo "<br/>";

// PHP des decryption API (in des.php)
$recovered_message = php_des_decryption($des_key, $ciphertext);
echo "DES decrypted message: " . $recovered_message;
echo "<br/>";

include "rsa.php";

$encrypted = $_POST['encrypted'];

// Get the private Key
$privateKey = get_rsa_privatekey('private.key');
// compute the decrypted value
$decrypted = rsa_decryption($encrypted, $privateKey);

list($product_a_name,
    $product_a_price,
    $product_a_quantity,
    $product_a_subtotal,
    $product_b_name,
    $product_b_price,
    $product_b_quantity,
    $product_b_subtotal,
    $product_c_name,
    $product_c_price,
    $product_c_quantity,
    $product_c_subtotal,
    $total_quantity,
    $total_price,
    $credit_card_no) = explode('&', $decrypted);


$filename = "../database/shoppingcart.txt";
$file = fopen($filename, 'a');
fwrite($file, $decrypted."\n");
fclose($file);

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

    <br>
    <br>

    Your Card Number:<p><?php echo $_POST["credit_card_no"]; ?></p>
    <br>
    <br>

    Your Encrypted Message :<p><?php echo $_POST["encrypted"]; ?></p>
    Your Decrypted Message :<p><?php echo $decrypted; ?></p>
    <br>
    <br>

    Your Encryted Table:

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
            <td><?php echo $product_a_name;?></td>
            <td><?php echo $product_a_price; ?></td>
            <td><?php echo $product_a_quantity;?></td>
            <td><?php echo $product_a_subtotal;?></td>
        </tr>
        <tr>
            <td><?php echo $product_b_name;?></td>
            <td><?php echo $product_b_price; ?></td>
            <td><?php echo $product_b_quantity;?></td>
            <td><?php echo $product_b_subtotal;?></td>
        </tr>
        <tr>
            <td><?php echo $product_c_name;?></td>
            <td><?php echo $product_c_price; ?></td>
            <td><?php echo $product_c_quantity;?></td>
            <td><?php echo $product_c_subtotal;?></td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <th>Total</th>
            <th></th>
            <th><?php echo $total_quantity; ?></th>
            <th><?php echo $total_price; ?></th>
        </tr>
        </tfoot>
    </table>
</body>
</html>
