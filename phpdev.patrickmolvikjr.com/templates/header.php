<?php
  session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>
      <?php

        if($title != "")
        {
          echo $title;
        }
        else
        {
          echo "PJr.com";
        }

      ?>
    </title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lte IE 8]>
    <script src="js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="css/main.css" />
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="css/ie8.css"/><![endif]-->
</head>
<body class="homepage">
<div id="page-wrapper">

    <!-- Header -->
    <div id="header-wrapper">
        <div id="header" class="container">

            <!-- Logo -->
            <h1 id="Patrick_Molvik_Jr"><a href="index.php">PATRICK MOLVIK JR.COM</a></h1>
            <p>WELCOME TO MY WEBSITE. ISN'T IT COOOOOOOL?</p>

          <?php
            include 'templates/nav.php';
          ?>

        </div>
    </div>
  <div id="main-wrapper">
    <div id="main" class="container">
      <h1><?php echo "Welcome: {$_SESSION["name"]}"; ?></h1>
    <!-- HTML Content Here -->