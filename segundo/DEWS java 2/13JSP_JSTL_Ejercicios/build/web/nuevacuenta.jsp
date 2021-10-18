<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <c:choose>
            <c:when test="${param.error.equals('titular')}">
                <p style="color:red;">Inserte un titular para la cuenta</p>
            </c:when>
            <c:when test="${param.error.equals('titularProhibido')}">
                <p style="color:red;">Ese titular no puede crear cuentas</p>
            </c:when>
            <c:when test="${param.error.equals('saldo')}">
                <p style="color:red;">Inserte un saldo</p>
            </c:when>
            <c:when test="${param.error.equals('saldoNoNum')}">
                <p style="color:red;">Inserte un valor adecuado para el saldo</p>
            </c:when>
        </c:choose>
        <h1>NUEVA CUENTA</h1>
        <table>
            <form method="POST" action="ServletNuevaCuenta">
                <tr><th>Titular</th><td><input type="text" name="titular" value="${sessionScope.cuenta.titular}"></td></tr>
                <tr><th>Saldo inicial</th><td><input type="text" name="saldo" value="${sessionScope.cuenta.saldo}"></td></tr>
                <tr><td colspan="2"><input type="submit" name="submitNuevaCuenta" value="Crear Nueva Cuenta"/></td></tr>
            </form>
        </table>
    </body>
</html>
