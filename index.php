<?php
//start session
session_start();

if(!empty($_SESSION['status'])){
    //get status from session
    $status = $_SESSION['status'];
    $msg = $_SESSION['msg'];

    //remove status from session
    unset($_SESSION['status']);
    unset($_SESSION['msg']);
}


?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <title>Import
    </title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=j8x9q4mk0ieu32yb17p5fm3pfdfb1n9794zedlwivfpe40v8"></script>
    <script src='script.js'></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>



    <script>
        tinymce.init({
            selector: '#mytextarea'
        });

    </script>
</head>

<body>
<script src="sort.js"></script>
<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="http://147.175.121.210:8042/sem/public/index.php">Semestralne zadanie - WebTech 2</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto"></ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                <li><a class="nav-link" href="http://147.175.121.210:8042/sem/public/index.php/admin/uloha1">Uloha1</a></li>
                <li><a class="nav-link" href="http://147.175.121.210:8042/sem/public/index.php/admin/uloha2">Uloha2</a></li>
                <li><a class="nav-link" href="http://147.175.121.210:8062/Projekt/" target="_blank">Uloha3</a></li>
                <li><a class="nav-link" href="http://147.175.121.210:8062/Projekt/rozdelenie.php" target="_blank">Rozdelenie ulôh</a></li>
            </ul>
        </div>
    </div>
</nav>


<div class="container">
<div class="import">
    <h2>Prvé načítanie údajov</h2>
</div>
    <hr>
<div class="tablevzor">
    <p>Vzor udajov (4 stĺpce)</p>
    <table class="table table-striped" style="width: 100%"><thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Meno</th>
            <th>Email</th>
            <th>Login</th>
        </tr></thead></table></div>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="form-group" id="form" enctype="multipart/form-data">


        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="file">Upload</span>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="file" id="file"
                       aria-describedby="inputGroupFileAddon01" required>
                <label class="custom-file-label" for="file">Choose CSV file</label>
            </div>
        </div>


        <div class="form-group">
       <input type="text" class="form-control" name="parameter" id="parameter" maxlength="1" size="1" placeholder="Ciarka alebo bodkociarka" required />
        </div>


        <div class="mt-1">
            <input type="submit" name="submit" id="sub" class="btn btn-primary mb-2" />

            </div>

    </form>


<?php
/**
 * Created by PhpStorm.
 * User: j4jan
 * Date: 17/05/2019
 * Time: 12:37 PM
 */


include_once ("utf8.php");
include("gen.php");

mb_internal_encoding("UTF-8");

if ( isset($_POST["submit"]) ) {

    echo "<a class=\"btn btn-primary\" href='download.php'>Stiahni upravený CSV súbor</a><p>Použiť ho v nižšie uvedenom formulári</p>";
    /*
    if ( isset($_FILES["file"])) {

        //if there was an error uploading the file
        if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br />";

        }
        else {
            //Print file details
            echo "Upload: " . $_FILES["file"]["name"] . "<br />";
            echo "Type: " . $_FILES["file"]["type"] . "<br />";
            echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
            echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

            //if file already exists
            if (file_exists("upload/" . $_FILES["file"]["name"])) {
                echo $_FILES["file"]["name"] . " already exists. ";
            }
            else {
                //Store file in directory "upload" with the name of "uploaded_file.txt"
                $storagename = "uploaded_file.txt";
                move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $storagename);
                echo "Stored in: " . "upload/" . $_FILES["file"]["name"] . "<br />";
            }
        }
    } else {
        echo "No file selected <br />";
    }
*/
    $filename = $_FILES["file"]["tmp_name"];

// The nested array to hold all the arrays
    $the_big_array = [];

// Open the file for reading
    if (($h = fopen("{$filename}", "r")) !== FALSE)
    {
        // Each line in the file is converted into an individual array that we call $data
        // The items of the array are comma separated
        //echo $_POST["parameter"];
        $delimiter = $_POST["parameter"];
        while (($data = fgetcsv($h, 1000, $delimiter )) !== FALSE)
        {
            // Each individual array is being pushed into the nested array
            $the_big_array[] = $data;
        }

        // Close the file
        fclose($h);
    }

// Display the code in a readable format

    //echo count($the_big_array);
    //var_dump($the_big_array[1][5]);

    $the_big_array = utf8_converter($the_big_array);
    //var_dump($the_big_array);
    echo "<table class=\"table table-hover\"><thead class=\"thead-dark\">
<tr>
<th>ID</th>
<th>Meno</th>
<th>Email</th>
<th>Login</th>
<th>Heslo</th>
</tr></thead>
<tbody>";
    //var_dump($the_big_array[0]);


    if($delimiter == ";"){

    for($i=0;$i < count($the_big_array);$i++){
        //var_dump($the_big_array[$i]);
        echo "<tr>";


        $split = (explode(",",$the_big_array[$i][0]));

        //echo $split[1];
        for($j=0;$j < count($split);$j++){
        echo "<td>",$split[$j],"</td>";
        }
        echo "<td>",$pass = randomPassword(15),"</td>";
        array_push($the_big_array[$i], $pass);
        echo "</tr>";
    }

        session_start();

        $_SESSION['post_data'] = array();
        array_push($_SESSION['post_data'],$the_big_array);

        $_SESSION['delimiter'] = $delimiter;
        //var_dump($_SESSION['post_data'][0]);

    }
    elseif ($delimiter == ","){

        for($i=0;$i < count($the_big_array);$i++){

            echo "<tr>";
            //var_dump($the_big_array[$i][0]);

            $array2 = count($the_big_array[$i]);


            for($j=0;$j < $array2;$j++){
                echo "<td>",$the_big_array[$i][$j],"</td>";

            }
            echo "<td>",$pass = randomPassword(15),"</td>";
            array_push($the_big_array[$i], $pass);
            echo "</tr>";


        }

        session_start();

        $_SESSION['post_data'] = array();
        array_push($_SESSION['post_data'],$the_big_array);

        $_SESSION['delimiter'] = $delimiter;
        //var_dump($_SESSION['post_data']);

    }

    else{
        ?>
        <script>alert("Zle zadany parameter!");</script>
<?php
    }



    echo "</tbody></table>";
}
?>

    <?php
include ("second_import.php");


?>

    <footer>
        <small>&copy; Copyright 2019, Jakub Jančík & Daniel Cobrda</small>

    </footer>
</div>
</body>
</html>