<?php
/**
 * Created by PhpStorm.
 * User: violinsolo
 * Date: 01/10/2017
 * Time: 2:47 PM
 */

$input = $_POST['msg'];

$filename = 'database.txt';

$exist = 0;

foreach (file($filename) as $line) {
//    echo $line;

    if ($line == $input."\n") {
        $exist = 1;
        break;
    }
}

if ($exist == 1) {
    echo "input $input has exists in db.txt";
} else {
    $file = fopen($filename, 'a');

    fwrite($file, $input."\n");

    fclose($file);

    echo "input $input has store!";
}

