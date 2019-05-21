<!DOCTYPE html>
<html lang="sk">
<head>
    <title>Table
    </title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css">

    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


</head>

<body>

<div class="container">

<?php
/**
 * Created by PhpStorm.
 * User: j4jan
 * Date: 20/05/2019
 * Time: 8:20 PM
 */
include_once ("connectDB.php");

$select = $conn->query("SELECT * FROM odoslane");

echo "<table id='table'>";

if ($select->num_rows > 0) {
    // output data of each row
    echo "<thead>
<tr>
<th>Cele meno</th>
<th>Predmet</th>
<th>Id sablony</th>
<th>Datum</th>
</tr>
</thead><tbody>
";

    while($row = $select->fetch_assoc()) {
        echo "<tr>
        <td>" . $row["full_name"]. "</td>
        <td>" . $row["title"]. "</td>
        <td>" . $row["id_sablony"]. "</td>
        <td>" . $row["date"]. "</td>
        </tr>";
    }
} else {
    echo "0 results";
}
echo "</tbody></table>";

?>


</div>
