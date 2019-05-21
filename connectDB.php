<?php
/**
 * Created by PhpStorm.
 * User: j4jan
 * Date: 18/05/2019
 * Time: 7:12 PM
 */

/**
 * Created by PhpStorm.
 * User: j4jan
 * Date: 10/03/2019
 * Time: 5:15 PM
 */

$servername = "localhost:3306";
$username = "xjancikj";
$password = "LiverpoolFC1892";
$dbname = "projekt";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset(utf8);

?>

