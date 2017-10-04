<?php
/**
 * Created by PhpStorm.
 * User: violinsolo
 * Date: 01/10/2017
 * Time: 12:05 PM
 */

$filename = '../database/database.txt';

$content = $_POST['text'];

$file = fopen($filename, 'a');

fwrite($file, $content."\n");

fclose($file);

echo "goood now!";