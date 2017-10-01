<?php
/**
 * Created by PhpStorm.
 * User: violinsolo
 * Date: 01/10/2017
 * Time: 12:01 AM
 */

$file = fopen('database.txt', 'a');
$content = 'helloworld';

fwrite($file, $content);

fclose($file);

echo 'Save success!';