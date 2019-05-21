<!DOCTYPE html>
<html lang="sk">
<head>
    <title>Rozdelenie
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

</head>

<body>

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

    <table class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th>Úloha</th>
            <th>Vypracoval</th>
            <th>Popis</th>
        </tr>
        </thead><tbody>
        <tr>
            <td>1</td>
            <td>Richard Diosi</td>
            <td>Vypracoval celú úlohu 1.</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Jakub Lazúr</td>
            <td>Vypracoval pohľad študenta.</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Tomáš Tomčo</td>
            <td>Vypracoval pohľad administrátora.</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Jakub Jančík</td>
            <td>Formulár, rozoslanie mailov pomocou šablóny. Zápis do databázy a tabulka o odoslanych mailoch.</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Daniel Cobrda</td>
            <td>Načítanie CSV súborov, vygenerovanie hesla.</td>
        </tr>
        </tbody>
    </table>

</div>


<?php
/**
 * Created by PhpStorm.
 * User: j4jan
 * Date: 21/05/2019
 * Time: 12:30 PM
 */

?>