<?php
/**
 * Created by PhpStorm.
 * User: violinsolo
 * Date: 01/10/2017
 * Time: 12:25 AM
 */
$filename = 'database.txt';

$input = $_POST['name'];

$exist = 0;

foreach (file($filename) as $line) {
    if ($line == $input . "\n") {
        $exist = 1;
        break;
    }
}

if ($exist == 1) {

    echo "The input is exist! 
<br/>
<br/>
Please enter another one via <a href='client.html'>client.html</a>";
}else {
    $file = fopen($filename, 'a');

    fwrite($file, $input."\n");

    fclose($file);

    echo "The input is added to the database.txt. 
<br/>
<br/>
Please try to enter the same input again via <a href='client.html'>client.html</a>";

}
