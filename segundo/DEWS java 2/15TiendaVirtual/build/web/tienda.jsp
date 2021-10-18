<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <c:if test="${param.carroVacio != null}">
            <p style="color: red;">El carro está vacío</p>
        </c:if>
        <h1>Láminas</h1>
        <table>
            <tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Cantidad</th><th>Añadir</th></tr>
            <c:forEach items="${sessionScope.items}" var="item" varStatus="estado">
                <tr>
                    <form method="POST" action="ServletAgregarLineaPedido">
                        <input type="hidden" name="iditem" value="${item.key}" >

                            <td>${item.key}</td>
                            <td>${item.value.nombre}</td>
                            <td>${item.value.precio}</td>
                            <td><input type="number" name="cantidad" value="1" /></td>
                            <td><input type="submit" name="submitAniadir" value="Añadir al carro" /></td>
                    </form>
                </tr>
            </c:forEach>
        </table>
        <form method="POST" action="listarCesta.jsp"><input type="submit" name="submitVerCesta" value="Ver Cesta"></form>
        <form method="POST" action="pedir.jsp"><input type="submit" name="submitPedir" value="Hacer pedido"></form>
        <form method="POST" action="ServletPedidosCliente"><input type="submit" name="submitPedidosCliente" value="Mis pedidos"></form>
    </body>
</html>
