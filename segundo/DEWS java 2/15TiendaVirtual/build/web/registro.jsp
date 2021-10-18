<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <c:if test="${param.error != null}">
            <p style="color: red;">Ese usuario ya está siendo usado</p>
        </c:if>
        <h1>REGISTRO</h1>
        <form method="POST" action="ServletRegistro">
            <table>
                <tr><th>Usuario</th><td><input type="text" name="usuario" required></td></tr>
                <tr><th>password</th><td><input type="password" name="password" required></td></tr>
                <tr><th>domicilio</th><td><input type="text" name="domicilio" required></td></tr>
                <tr><th>zip</th><td><input type="text" name="zip" required></td></tr>
                <tr><th>telefono</th><td><input type="tel" name="telefono" required></td></tr>
                <tr><th>email</th><td><input type="email" name="email" required></td></tr>
            </table>
            <input type="submit" name="submitRegistro" value="Registrarse">
        </form>
    </body>
</html>
