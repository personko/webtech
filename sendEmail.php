<?php
/**
 * Created by PhpStorm.
 * User: j4jan
 * Date: 19/05/2019
 * Time: 12:19 PM
 */

require_once ("connectDB.php");
//replace template var with value

session_start();

$array = $_SESSION['array'];

if(isset($_POST['submit_email'])) {
    if (!empty($_POST['predmet']) && !empty($_POST['content']) && !empty($_POST['odosielatel']) && !empty($_POST['heslo'])) {

        for($i=0;$i<count($array);$i++){
        $token = array(
            'verejnaIP' => 'verejna',
            'login' => 'CodexWorld',
            'heslo' => $userName,
            'sender' => $userName,
            'http' => $userEmail
        );
        $pattern = '[%s]';
        foreach ($token as $key => $val) {
            $varMap[sprintf($pattern, $key)] = $val;
        }

        $emailContent = strtr($tempData['content'], $varMap);

//send email to user
        $to = $userEmail;
        $subject = "Contact us email with template";

// Set content-type header for sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// Additional headers
        $headers .= 'From: CodexWorld<sender@example.com>' . "\r\n";

// Send email
        if (mail($to, $subject, $emailContent, $headers)):
            $successMsg = 'Email has sent successfully.';
        else:
            $errorMsg = 'Email sending fail.';
        endif;
    }

}
    else{
        $_SESSION['status'] = 'err';
        $_SESSION['msg'] = 'Treba vyplnit vsetky polia!';

   }
}

header("Location: index.php");

?>