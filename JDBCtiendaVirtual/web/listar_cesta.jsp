<%-- 
    Document   : listar_cesta
    Created on : 21-ene-2020, 18:43:36
    Author     : mario
--%>
<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <h1>LISTADO CARRO</h1>
        <c:out value="${sessionScope.carroCompra}"/>
        <table border="1">
            <tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Num</th><th>CAMBIAR</th></tr>
            <c:forEach items="${sessionScope.carroCompra.getLineasPedido()}" var="linea">
                <tr>
                    <form action="ServletUpdateLineaPedido" method="POST">
                        <td style="padding:5px">${linea.getItem().getId()}<input type="hidden" value="${linea.getItem().getId()}" name="idItem"></td>
                        <td style="padding:5px">${linea.getItem().getNombre()}<input type="hidden" value="${linea.getItem().getNombre()}" name="nombre" ></td>
                        <td style="padding:5px">${linea.getItem().getPrecio()}<input type="hidden" value="${linea.getItem().getPrecio()}<}" name="precio" ></td>
                        <td style="padding:5px"><input type="text" value="${linea.getCantidad()}" name="cantidad" ></td>
                        <td style="padding:5px"><input type="submit" name="borrar" value="BORRAR ITEM"/><input type="submit" name="cambiar" value="CAMBIAR CANTIDAD"/></td>
                    </form>
                </tr>
            </c:forEach>
                <tr><th colspan="3">TOTAL</th><td colspan="2"><c:out value="${0+sessionScope.carroCompra.total()}€"/></td></tr>
        </table>
        <div>
            <form action="ServletVaciarCesta" method="POST"><input type="submit" value="VACIAR CESTA" name="vaciar"/></form>
            <form action="tienda.jsp" method="POST"><input type="submit" value="CONTINUAR LA COMPRA" name="continuar"/></form>
            <form action="pedir.jsp" method="POST"><input type="submit" value="HACER PEDIDO" name="pedido"/></form>
        </div> 
    </body>
</html>
