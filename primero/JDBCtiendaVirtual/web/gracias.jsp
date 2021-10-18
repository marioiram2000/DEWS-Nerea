<%-- 
    Document   : gracias
    Created on : 22-ene-2020, 17:44:43
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
        <h1>Gracias por realizar su pedido</h1>
        <h2>Estos son sus datos y los del pedido</h2>
        <!--<c:out value="${sessionScope.cliente}"/>-->
        <table border="1">
            <tr>
                <th>Nombre</th><td>${sessionScope.cliente.getNombre()}</td>
            </tr>
            <tr>
                <th>ZIP</th><td>${sessionScope.cliente.getCodigopostal()}</td>
            </tr> 
            <tr>
                <th>DIRECCION</th><td>${sessionScope.cliente.getDomicilio()}</td>
            </tr>
            <tr>
                <th>TELEFONO</th><td>${sessionScope.cliente.getTelefono()}</td>
            </tr>    
            <tr>
                <th>E-mail</th><td>${sessionScope.cliente.getEmail()}</td>
            </tr>
        </table>
        <h2>Se enviará a la mayor brecedad posible el sigueinte pedido:</h2>
        <table border="1">
            <tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Num</th></tr>
            <c:forEach items="${sessionScope.carroCompra.getLineasPedido()}" var="linea">
                <tr>
                        <td style="padding:5px">${linea.getItem().getNombre()}</td>
                        <td style="padding:5px">${linea.getItem().getPrecio()*linea.getCantidad()}</td>
                        <td style="padding:5px">${linea.getCantidad()}</td>
                </tr>
            </c:forEach>
                <tr><th colspan="3">TOTAL</th><td colspan="2"><c:out value="${0+sessionScope.carroCompra.total()}€"/></td></tr>
        </table>
        <div>
            <a href="">SALIR </a>
            <br>
            <a href="tienda.jsp"> VOLVER A LA TIENDA</a>
        </div> 
    </body>
</html>