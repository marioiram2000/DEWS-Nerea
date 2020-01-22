<%-- 
    Document   : pedir
    Created on : 21-ene-2020, 20:07:09
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
        <h1>PEDIDO</h1>
        <h2>TUS DATOS</h2>
        <!--<c:out value="${sessionScope.cliente}"/>-->
        <form action="ServletGrabarCompra">
            <table border="1">
                <tr>
                    <th>Nombre</th><td><input type="text" name="nombre"  value="${sessionScope.cliente.getNombre()}" id="nombre" disabled="true"/></td>
                </tr>
                <tr>
                    <th>ZIP</th><td><input type="text" name="zip"  value="${sessionScope.cliente.getCodigopostal()}" id="zip"/></td>
                </tr> 
                <tr>
                    <th>DIRECCION</th><td><input type="text" name="direccion"  value="${sessionScope.cliente.getDomicilio()}" id="direccion"/></td>
                </tr>
                <tr>
                    <th>TELEFONO</th><td><input type="text" name="telefono"  value="${sessionScope.cliente.getTelefono()}" id="telefono"/></td>
                </tr>    
                <tr>
                    <th>E-mail</th><td><input type="text" name="email"  value="${sessionScope.cliente.getEmail()}" id="email"/></td>
                </tr>
            </table>
            <h2>TU CARRO (<a href="listar_cesta.jsp">Editar carro</a>)</h2>
            <table border="1">
                <tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Num</th></tr>
                <c:forEach items="${sessionScope.carroCompra.getLineasPedido()}" var="linea">
                    <tr>
                        <form action="ServletUpdateLineaPedido" method="POST">
                            <td style="padding:5px">${linea.getItem().getId()}</td>
                            <td style="padding:5px">${linea.getItem().getNombre()}</td>
                            <td style="padding:5px">${linea.getItem().getPrecio()*linea.getCantidad()}</td>
                            <td style="padding:5px">${linea.getCantidad()}</td>
                        </form>
                    </tr>
                </c:forEach>
                    <tr><th colspan="3">TOTAL</th><td colspan="2"><c:out value="${0+sessionScope.carroCompra.total()}€"/></td></tr>
            </table>
            <div>
                <input type="submit" value="COMPRAR" name="submitComprar">
                <input type="reset" value="RESET">                
            </div> 
        </form>
        <form action="tienda.jsp" method="POST"><input type="submit" value="MODIFICAR COMPRA" name="continuar"/></form>
    </body>
</html>
