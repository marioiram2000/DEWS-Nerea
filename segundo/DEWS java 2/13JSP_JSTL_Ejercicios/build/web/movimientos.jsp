<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <p style="color:red"><c:out value="${param.error}"/></p>
        <h1>MOVIMIENTOS</h1>
        <table>
            <form method="POST" action="ServletMovimientos">
                <tr><th>Titular</th><td>${sessionScope.cuenta.titular}</td></tr>
                <tr><th>Saldo inicial</th><td>${sessionScope.cuenta.saldo}</td></tr>
                <tr><th>CANTIDAD</th><td><input type="text" name="cantidad" value=""></td></tr>
                <tr><td><input type="submit" name="submitIngresar" value="INGRESAR"/></td><td><input type="submit" name="submitGastar" value="GASTAR"/></td></tr>
            </form>
        </table>
    </body>
</html>
