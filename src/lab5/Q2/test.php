<?php
/**
 * Created by PhpStorm.
 * User: violinsolo
 * Date: 01/10/2017
 * Time: 12:36 AM
 */

$origin = "one, two, three,four";
list($a, $b, $c) = explode(",", $origin);

echo "<p>|$a|</p>
<p>|$b|</p>
<p>|$c|</p>";