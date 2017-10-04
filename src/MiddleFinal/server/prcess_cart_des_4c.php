<?php
/**
 * Created by PhpStorm.
 * User: violinsolo
 * Date: 02/10/2017
 * Time: 6:01 PM
 */

// RSA DECRYPTION -----
include "rsa.php";

$rsa_encrypted = $_POST['rsa_encrypted'];

// Get the private Key
$privateKey = get_rsa_privatekey('private.key');
// compute the decrypted value
$rsa_decrypted = rsa_decryption($rsa_encrypted, $privateKey);

list($rsa_product_a_name,
    $rsa_product_a_price,
    $rsa_product_a_quantity,
    $rsa_product_a_subtotal,
    $rsa_product_b_name,
    $rsa_product_b_price,
    $rsa_product_b_quantity,
    $rsa_product_b_subtotal,
    $rsa_product_c_name,
    $rsa_product_c_price,
    $rsa_product_c_quantity,
    $rsa_product_c_subtotal,
    $rsa_total_quantity,
    $rsa_total_price,
    $rsa_credit_card_no) = explode('&', $rsa_decrypted);


// DES DECRYPTION -----
include "des.php";

$des_key = '';
$user_name = '';
foreach (file('../database/deskey.txt') as $item) {
//    $des_key = $item;
    list($user_name, $des_key) = explode(',',$item);
    break;
}

echo "des_key: [" . $des_key . "]<br/>";

// PHP des encryption API (in des.php)
$des_encrypted_content = $_POST['des_encrypted'];

echo "DES encrypted message: " . $des_encrypted_content;
echo "<br/>";

// PHP des decryption API (in des.php)
$recovered_message = php_des_decryption($des_key, $des_encrypted_content);
echo "DES decrypted message: " . $recovered_message;
echo "<br/>";


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
    $credit_card_no) = explode('&', $recovered_message);


$filename = "../database/shoppingcart.txt";
$file = fopen($filename, 'a');
fwrite($file, $recovered_message."\n");
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

<h1>4.a -> Received Form (What the customer submitted)</h1>


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


<h1>4.b -> Received Form (What the customer RSA Encrypted submitted)</h1>
<br>
Your Encrypted Message :<p><?php echo $rsa_encrypted; ?></p>
Your Decrypted Message :<p><?php echo $rsa_decrypted; ?></p>
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
        <td><?php echo $rsa_product_a_name;?></td>
        <td><?php echo $rsa_product_a_price; ?></td>
        <td><?php echo $rsa_product_a_quantity;?></td>
        <td><?php echo $rsa_product_a_subtotal;?></td>
    </tr>
    <tr>
        <td><?php echo $rsa_product_b_name;?></td>
        <td><?php echo $rsa_product_b_price; ?></td>
        <td><?php echo $rsa_product_b_quantity;?></td>
        <td><?php echo $rsa_product_b_subtotal;?></td>
    </tr>
    <tr>
        <td><?php echo $rsa_product_c_name;?></td>
        <td><?php echo $rsa_product_c_price; ?></td>
        <td><?php echo $rsa_product_c_quantity;?></td>
        <td><?php echo $rsa_product_c_subtotal;?></td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
        <th>Total</th>
        <th></th>
        <th><?php echo $rsa_total_quantity; ?></th>
        <th><?php echo $rsa_total_price; ?></th>
    </tr>
    </tfoot>
</table>
<br>
<br>

Your Card Number:<p><?php echo $rsa_credit_card_no; ?></p>
<br>
<br>

<h1>4.c -> Received Form (What the customer DES Encrypted submitted)</h1>
<br>
    Your Encrypted Message :<p><?php echo $des_encrypted_content; ?></p>
    Your Decrypted Message :<p><?php echo $recovered_message; ?></p>
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
    <br>
    <br>

    Your Card Number:<p><?php echo $credit_card_no; ?></p>
    <br>
    <br>
</body>
</html>
