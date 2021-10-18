<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
     
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <table>
                <tr>
                    <th>PRODUCTO</th>
                    <th>PRECIO</th>
                    <th>ELIJA CANTIDAD</th>
                    <th>PEDIDO ACTUAL</th>
                </tr>
                <tr>
                    <?php ?>
                
            </table>
            <p>
                <input type="submit" name="aniadir" value="AÑADIR UNIDADES">
                <input type="submit" name="formalizar" value="FORMALIZAR COMPRA">
                <input type="submit" name="vaciar" value="VACIAR CARRO">
           </p>
        </form>
    </body>
</html>