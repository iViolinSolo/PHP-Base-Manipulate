<?php
/**
 * Created by PhpStorm.
 * User: violinsolo
 * Date: 01/10/2017
 * Time: 3:10 PM
 */

$string = "123, one,6788";

list($str1, $str2, $str3) = explode(',', $string);

echo "[$str1][$str2][$str3]";
