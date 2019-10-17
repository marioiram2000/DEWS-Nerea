<?php
    session_start();
    $anterior = $_SESSION['actual'];
    session_destroy();
    header("Location:$anterior");
    
?>