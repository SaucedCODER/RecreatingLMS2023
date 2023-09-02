<?php
session_start();
$UID = $_SESSION['userid'] = $_GET["userid"];
$username = $_SESSION['username'] = $_GET["username"];


if (isset($_SESSION['message'])) {
    unset($_SESSION['message']);
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <script src="./js/jsforloader.js" defer></script>
    <link rel="stylesheet" href="./css/cssloader.css">
    <link rel="stylesheet" href="./css/bookcollection.css">
</head>

<body>
    <load class="containerloader">
        <div class='loader'>
            <div class="loaditem"></div>
            <div class="loaditem"></div>
            <div class="loaditem"></div>
            <div class="loaditem"></div>
            <div class="loaditem"></div>
        </div>
    </load>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        .btncatactive {
            background: black;
            color: white;

        }

        body {
            margin: 0;
            background: #eee;

        }

        main {
            max-width: 900px;
            width: 100%;
            height: auto;
            margin: 1em auto;
            box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
            position: relative;

        }

        section {
            width: 100%;
            height: auto;
            padding-top: 2em;
            position: absolute;
            top: 0;
            background: whitesmoke;
            color: white;
            display: none;

            border-radius: 10px;
            box-shadow: 0px 1px 4px grey;
        }
    </style>