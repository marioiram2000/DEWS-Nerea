<%-- 
    Document   : registro
    Created on : 16-ene-2020, 9:45:19
    Author     : dw2_alum4
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <h1>LOGIN</h1>
        <form action="ServletRegistro" method="POST">
            <table border="1">
                <tr><th>Usuario</th><td><input type="text" name="username" id="username"></td></tr>
                <tr><th>Contraseña</th><td><input type="password" name="password" id="password"</td></tr>
                <tr><th>Domicilio</th><td><input type="text" name="domicilio" id="domicilio"></td></tr>
                <tr><th>CP</th><td><input type="text" name="zip" id="zip" pattern="[0-9]{5}"></td></tr>
                <tr><th>Teléfono</th><td><input type="tel" name="telefono" id="telefono" pattern="[0-9]{9}"></td></tr>
                <tr><th>E-mail</th><td><input type="email" name="email" id="email"</td></tr>
            </table>
            <input type="submit" name="registrarse" value="REGISTRARSE">
            <input type="reset" name="reset" value="Reset">
        </form>
    </body>
</html>
