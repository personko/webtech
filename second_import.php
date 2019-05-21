<div class="second">


    <?php
    if(isset($_POST["name"])){
        session_start();
        $_SESSION["pos"] = $_POST["name"];

        echo $_SESSION["pos"];
    }
    ?>


<?php



/*
    <form>
        <input type="file" name="thefile" id="thefile" />

    </form>

    <div id="text"></div>
*/


/**
 * Created by PhpStorm.
 * User: j4jan
 * Date: 18/05/2019
 * Time: 12:43 AM
 */


include_once ("utf8.php");
include_once ("connectDB.php");


if ( isset($_POST["submit_email"])  ) {
        if (!empty($_POST['predmet']) && !empty($_POST['content']) && !empty($_POST['odosielatel']) && !empty($_POST['heslo'] && !empty($_POST['parameter']))) {

            $filename = $_FILES["file"]["tmp_name"];

// The nested array to hold all the arrays


            $the_big_array = [];

// Open the file for reading
            if (($h = fopen("{$filename}", "r")) !== FALSE) {
                // Each line in the file is converted into an individual array that we call $data
                // The items of the array are comma separated
                //echo $_POST["parameter"];
                echo $delimiter = $_POST["parameter"];
                while (($data = fgetcsv($h, 1000, $delimiter)) !== FALSE) {
                    // Each individual array is being pushed into the nested array
                    $the_big_array[] = $data;
                }

                // Close the file
                fclose($h);


                //array_push($_SESSION["big_array"],$the_big_array);
            }


// Display the code in a readable format
            //var_dump($the_big_array);
            echo "<table class=\"table table-hover\"><thead class=\"thead-dark\">
<tr>
<th>ID</th>
<th>Meno</th>
<th>Email</th>
<th>Login</th>
<th>Heslo</th>
<th>VerejnaIP</th>
<th>PrivatnaIP</th>
<th>ssh</th>
<th>http</th>
<th>https</th>
<th>misc1</th>
<th>misc1</th>
</tr></thead>
<tbody>";

            $array = [];

            $the_big_array = utf8_converter($the_big_array);


            if ($delimiter == ";") {

                for ($i = 0; $i < count($the_big_array); $i++) {
                    //var_dump($the_big_array[$i]);
                    echo "<tr>";


                    $split = (explode(",", $the_big_array[$i][0]));

                    //echo $split[1];
                    for ($j = 0; $j < count($split); $j++) {
                        echo "<td>", $split[$j], "</td>";
                        $array[$i][$j] = str_replace('"', '', $split[$j]);
                    }
                    $k = $i + 1;

                    echo "<td>147.175.121.210</td>
                    <td>192.168.0." . $k . "</td>
                    <td>2201</td>
                    <td>8001</td>
                    <td>4401</td>
                    <td>9001</td>
                    <td>1901</td>";
                    array_push($array[$i], "147.175.121.210", "192.168.0." . $k . "", "2201", "8001", "4401", "9001", "1901");


                    //echo "<td>",$pass = randomPassword(15),"</td>";
                    //array_push($the_big_array[$i], $pass);
                    echo "</tr>";
                }
            } elseif ($delimiter == ",") {

                for ($i = 0; $i < count($the_big_array); $i++) {

                    echo "<tr>";
                    //var_dump($the_big_array[$i][0]);

                    $array2 = count($the_big_array[$i]);


                    for ($j = 0; $j < $array2; $j++) {
                        echo "<td>", $the_big_array[$i][$j], "</td>";
                        $array[$i][$j] = $the_big_array[$i][$j];
                    }
                    $k = $i + 1;
                    echo "<td>147.175.121.210</td>
                    <td>192.168.0." . $k . "</td>
                    <td>2201</td>
                    <td>8001</td>
                    <td>4401</td>
                    <td>9001</td>
                    <td>1901</td>";
                    array_push($array[$i], "147.175.121.210", "192.168.0." . $k . "", "2201", "8001", "4401", "9001", "1901");
                    //echo "<td>",$pass = randomPassword(15),"</td>";
                    //array_push($the_big_array[$i], $pass);
                    echo "</tr>";

                }
            } else {
                ?>
                <script>alert("Zle zadany parameter!");</script>
                <?php
            }
            echo "</tbody></table>";

            //EMAIL SENDING
            //var_dump($array);

            for($i=0;$i<count($array);$i++) {

                $token = array(
                    'meno' => $array[$i][1],
                    'verejnaIP' => $array[$i][5],
                    'login' => $array[$i][3],
                    'heslo' => $array[$i][4],
                    'sender' => "Jozko Mrkvicka",
                    'http' => $array[$i][8]
                );
                $pattern = '[%s]';
                foreach ($token as $key => $val) {
                    $varMap[sprintf($pattern, $key)] = $val;
                }

                $emailContent = strtr($_POST['content'], $varMap);


//send email to user
                /*
                echo "<br>Prijemca: ".$array[$i][2];
                echo "<br>Predmet: ".$_POST['predmet'];
                echo "<br>Odosielatel: ".$_POST["odosielatel"];
*/
                $to = $array[$i][2];
                $subject = $_POST['predmet'];
                $odosielatel = $_POST["odosielatel"];

                $heslo = $_POST["heslo"];

                $name = $array[$i][1];

                $title = $_POST['predmet'];
// Set content-type header for sending HTML email

                //$date= date("Y-m-d");
                require_once('class.phpmailer.php');
                require_once('class.smtp.php');

                $mail = new PHPMailer(true); // create a new object


                try {

                    $mail->isSMTP(true); // enable SMTP

                    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
                    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only

                    $mail->SMTPAuth = true; // authentiction enabled
                    $mail->Host = "mail.stuba.sk";

                    $mail->Port = 587; // or 587
                    $mail->IsHTML(true);

                    $mail->Username = $odosielatel;
                    $mail->Password = $heslo;

                    if (isset($_FILES['attachment']) &&
                        $_FILES['attachment']['error'] == UPLOAD_ERR_OK) {
                        $mail->AddAttachment($_FILES['attachment']['tmp_name'],
                            $_FILES['attachment']['name']);
                    }

                    $mail->setFrom($odosielatel);


                    $mail->Subject = $subject;
                    $mail->Body = $emailContent;
                    $mail->AddAddress($to);


                    if (!$mail->send()) {
                        echo "Mailer Error: " . $mail->ErrorInfo;
                    } else {
                        echo "<p style=\"color: green;\">Message to $to has been sent.</p>";

                        $insert = $conn->query("INSERT into odoslane (full_name,title,id_sablony) VALUES ('$name','$title',1)");

                        if ($insert) {
                            $_SESSION['status'] = 'succ';
                            $_SESSION['msg'] = 'Email record has been created successfully.';
                        } else {
                            $_SESSION['status'] = 'err';
                            $_SESSION['msg'] = 'Some problem occurred with insert records, please try again.';
                        }

                    }
                }
                catch (phpmailerException $e) {
                    echo $e->errorMessage(); //Pretty error messages from PHPMailer
                    echo '<p style="color: red;">Wrong user email or password.</p>';
                }

            }

        }
        else{
            $_SESSION['status'] = 'err';
            $_SESSION['msg'] = 'All fields are mandatory, please fill all the fields.!';

        }
    }

$result = $conn->query("SELECT * FROM sablona");
//$row = mysqli_fetch_assoc($result);

if(!empty($status) && $status == 'success'){
    echo '<p style="color: green;">'.$msg.'</p>';
}elseif(!empty($status) && $status == 'error'){
    echo '<p style="color: red;">'.$msg.'</p>';
}

echo "<div class=\"import\" style='margin-top: 80px'>
    <h2>Formular </h2>
    <hr>
        </div>";

if(!empty($status) && $status == 'succ'){
    echo '<p style="color: green;">'.$msg.'</p>';
}elseif(!empty($status) && $status == 'err'){
    echo '<p style="color: red;">'.$msg.'</p>';
}

?>

<!-- START Demo Code -->

    <?php

    echo "<u>Na zaciatok vyber sablonu</u>
<form method='post' class='form-group'>
 <div class='input-group'>
            <select class=\"form-control\" id='template' name='template' style='width: 25%' onchange=\"this.form.submit();\">
            <option value=''>Vyber šablónu</option>";

    while($row = $result->fetch_assoc()) {


            echo "<option value='".$row["content"]."'>".$row["id"]."</option>";

    }
echo "</select></div></form>";



?>

    <script>
$('#template').on('change', function() {
  var str = this.value;
  var val = $.parseJSON(str);
  alert(val.id);
  alert(val.content);

});

</script>

<?php


if(isset($_POST['template'])){
    echo '<p style="color: green;">Sablona je nastavena</p>';
}

  echo " <form name='form' action='".$_SERVER["PHP_SELF"]."' method='post' class='form-group' enctype=\"multipart/form-data\">";


        /*action='".$_SERVER["PHP_SELF"]."'
        ?>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post"  id="form" >

*/
echo "
 <p><u>Druhe načítanie údajov</u> spoločne s formulárom</p>
    <div class='input-group'>
        <div class='input-group-prepend'>
            <span class='input-group-text' id='file'>Upload</span>
        </div>
        <div class='custom-file'>
            <input type='file' class='custom-file-input' name='file' id='file'
                   aria-describedby='inputGroupFileAddon01' required>

            <label class='custom-file-label' for='file'>Choose CSV file</label>
        </div>

    </div>


    <div class='form-group'>
        <input type='text' class='form-control' name='parameter' id='parameter' maxlength='1' size='1' placeholder='Ciarka alebo bodkociarka' required />
    </div>";

  
  /*    <div class='mt-1'>

          <input type='submit' name='submit2' id='sub' class='btn btn-primary mb-2' />

    </div>

*/

echo " <div class=\"row\">
    <div class=\"col\">
    <label for=\"odosielatel\">Odosielatel:</label>
      <input type=\"text\" name='odosielatel' id='odosielatel' class=\"form-control\" placeholder=\"Stuba mail odosielatela\" required/>
    </div>
    <div class=\"col\">
     <label for=\"heslo\">Heslo:</label>
      <input type=\"password\" name='heslo' id='heslo' class=\"form-control\" placeholder=\"Heslo na mail\" required/>
    </div>
  </div>

<div class=\"form-group\">
            <label for=\"predmet\">Predmet:</label>
            <input type='text' class=\"form-control\" name='predmet' id=\"predmet\" placeholder=\"Predmet\" value='' required/>
            </div>
           ";


echo "<div class=\"form-group\">
        <label for=\"comment\">Sprava:</label><br>
         <input type=\"checkbox\" id=\"formButton\" >
         <label for=\"formCheck\">Plain/HTML text</label>
        <textarea id=\"mytextarea\" class=\"form-control\" rows=\"12\" cols=\"55\" name=\"content\" required>".$_POST["template"]."</textarea>
        
        </div>";



         echo "<div class=\"mt-1\">";
        //echo count($array);
    echo "<input type=\"checkbox\" id=\"myCheck\" onclick=\"check()\">
         <label for=\"priloha\">Priloha</label>
        </div>";

            echo "
        <input type=\"file\" name=\"attachment\" id=\"text\" style=\"display:none\">
    ";

        
        echo "<div class=\"mt-1\">
            <input type=\"submit\" name=\"submit_email\" id=\"sub\" class=\"btn btn-primary mb-2\" />

            </div>";


echo "</form>";


$select = $conn->query("SELECT * FROM odoslane");

echo "
<div class=\"import\">
<hr>
        <h2>Údaje o odoslaných mailoch</h2>
    </div>
    <hr>

<div class=\"container\"> <table class=\"table table-bordered sortable\" id='tabulka1'>";

if ($select->num_rows > 0) {
    // output data of each row
    echo "<thead>
<tr>
<th>Celé meno</th>
<th>Predmet</th>
<th>ID šablóny</th>
<th>Datum odoslania</th>
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
echo "</tbody></table></div>";

?>

</div>





