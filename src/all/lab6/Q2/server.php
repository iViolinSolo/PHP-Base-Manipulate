<?php
/**
 * Created by PhpStorm.
 * User: violinsolo
 * Date: 01/10/2017
 * Time: 4:27 PM
 */


$ipt_text = $_POST['txt'];

$file = fopen("users.txt", 'a');

fwrite($file, $ipt_text."\n");

fclose($file);

