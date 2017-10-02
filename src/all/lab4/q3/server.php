<?php
/**
 * Created by PhpStorm.
 * User: violinsolo
 * Date: 01/10/2017
 * Time: 2:12 PM
 */

$content = $_POST['msg'];
$filename = 'database.txt';

$file = fopen($filename, 'a');

fwrite($file, $content."\n");

fclose($file);

echo "String $content has been stored.";