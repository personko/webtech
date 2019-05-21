<?php
/**
 * Created by PhpStorm.
 * User: j4jan
 * Date: 17/05/2019
 * Time: 8:33 PM
 */

session_start();


$delimiter=$_SESSION['delimiter'];


header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="sample.csv"');


$fp = fopen('php://output', 'wb');
if($delimiter == ";"){

    for($i=0;$i < count($_SESSION['post_data'][0]);$i++){
        //fputcsv($fp, $_SESSION['post_data'][0][$i][0]);

        $split = (explode(",",$_SESSION['post_data'][0][$i]));

        //echo $split[1];
        for($j=0;$j < 3;$j++){
            //fputcsv($fp,$_SESSION['post_data'][0][$i][0]);
        }
        fputcsv($fp, $_SESSION['post_data'][0][$i]);
        continue;
    }
}
elseif ($delimiter == ","){

    for($i=0;$i < count($_SESSION['post_data']);$i++){

        //var_dump($the_big_array[$i][0]);
        $array2 = count($_SESSION['post_data'][$i]);

        for($j=0;$j < $array2;$j++){

         fputcsv($fp, $_SESSION['post_data'][$i][$j]);

        }
    }
    //var_dump($the_big_array);
    $url = 'download.php';

}
fclose($fp);

/*
foreach ( $_SESSION['post_data'] as $key=>$line) {
    $val = explode(",", $line);
    fputcsv($fp, $val);
}
*/

?>