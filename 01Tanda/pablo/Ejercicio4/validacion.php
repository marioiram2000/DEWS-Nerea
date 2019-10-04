<?php
    function comprobar()
    {
        $f=fopen("usuarios.txt", 'r');
        while (!feof($f))
        {
            $linea= trim(fgets($f));
            $lineasep=explode(";",$linea);
            if($lineasep[0]==$_POST['username'])
            {
               if($lineasep[1]!=$_POST['pass'])
               {
                header('Location: login.php?nombre='.$_POST['username'].'&error=err_type1');
                die();
               }
               else
               {
                   header('Location: charla.php?nombre='.$_POST['username']);
                die();
               }
            }
        }
           header('Location: alta.php?nombre='.$_POST['username'].'&pass='.$_POST['pass'].'');
    }

    if (isset($_POST['submit_login']))
    {
        comprobar();
    }
?>

