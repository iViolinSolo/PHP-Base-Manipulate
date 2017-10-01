<?php
/**
 * Created by PhpStorm.
 * User: violinsolo
 * Date: 01/10/2017
 * Time: 12:08 AM
 */

$file = fopen('database.txt', 'a');

$content = 'this is the content';
$target = $_POST['targettext'];

fwrite($file, $target . "\n");

print "<p> you submit a text : $target</p>
<p>Go back click <a href='client.html'>here</a></p>";

fclose($file);