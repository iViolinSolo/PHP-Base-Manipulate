<?php
/**
 * Created by PhpStorm.
 * User: violinsolo
 * Date: 01/10/2017
 * Time: 1:40 PM
 */

$file = fopen('test.txt', 'a');

fwrite($file, 'helloworld');

fclose($file);