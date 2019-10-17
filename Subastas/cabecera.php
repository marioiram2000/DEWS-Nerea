<!DOCTYPE html>

<?php include './config.php';
$cn = conectarse();
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="http://localhost/Subastas/css/stylesheet.css" type="text/css"/>
    </head>
    <body>
        <div id="header">
            <h1>SUBASTAS CIUDAD JARDIN</h1>            
        </div>
        <div id="menu">
            <a href="index.php">Home</a>
            <?php 
                if(!isset($_SESSION['id'])){
                    echo "<a href='login.php'>Login</a>";
                }else{
                    echo "<a href='login.php'>Logout</a>";
                }
            ?>
            
            <a href="">New item</a>
        </div>
        
            <div id="main">
               