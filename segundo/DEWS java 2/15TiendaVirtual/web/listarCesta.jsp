<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <h1>Listaco Carro</h1>
        
        <c:choose>
            <c:when test="${sessionScope.carro.vacio()==false}">
            <table>
                <tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Cantidad</th><th>Cambiar</th><th></th></tr>
                <c:forEach items="${sessionScope.carro.getLineasPedido()}" var="linea">
                    <tr>
                        <form method="POST" action="ServletUpdateLineaPedido">
                            <input type="hidden" name="iditem" value="${linea.item.id}" >
                            <td>${linea.item.id}</td>
                            <td>${linea.item.nombre}</td>
                            <td>${linea.item.precio}</td>
                            <td><input type="number" name="cantidad" value="${linea.cantidad}" /></td>
                            <td><input type="submit" name="submitBorrar" value="Borrar item" />
                                <input type="submit" name="submitCambiar" value="Cambiar cantidad" /></td>
                        </form>
                        <td>
                            <c:if test="${param.cantidad == linea.item.id}">
                                <p>Cantidad actualizada</p>
                            </c:if>
                        </td>
                    </tr>
                </c:forEach>
                <tr><td colspan="3"><strong>TOTAL</strong></td><td colspan="2">${sessionScope.carro.total()}€</td></tr>
            </table>
            <c:if test="${param.borrado != null}">
                <p>Artículo borrado</p>
            </c:if>
            
            
            <form method="POST" action="ServletVaciarCesta"><input type="submit" name="submitVaciarCesta" value="Vaciar cesta"></form>
            <form method="POST" action="tienda.jsp"><input type="submit" name="submitVerTienda" value="Continuar la compra"></form>
            <form method="POST" action="pedir.jsp"><input type="submit" name="submitPedir" value="Hacer pedido"></form>
            
            </c:when>
            <c:otherwise>
                <p>Su carro está vacio <a href="tienda.jsp">(Volver a la tienda)</a></p>
            </c:otherwise>
        </c:choose>
    </body>
</html>
