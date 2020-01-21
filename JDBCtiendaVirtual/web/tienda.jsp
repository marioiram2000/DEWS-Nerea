<%-- 
    Document   : tienda
    Created on : 16-ene-2020, 10:06:16
    Author     : dw2_alum4
--%>

<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@page import="beans.Item"%>
<%@page import="dao.GestionPedidos"%>
<%@page import="java.util.HashMap"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <h1>Tienda</h1>
        <table border="1">
            <tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Cantidad</th><th>Añadir</th></tr>
            <!--<c:out value="${sessionScope.mapaItems}"/>-->
            <c:forEach items="${sessionScope.mapaItems}" var="it">
                <tr>
                    <form action="ServletAgregarLineaPedido" method="POST">
                        <td style="padding:5px">${it.key}<input type="hidden" value="${it.key}" name="id" id="id"></td>
                        <td style="padding:5px">${it.value.nombre}<input type="hidden" value="${it.value.nombre}" name="nombre" id="nombre"></td>
                        <td style="padding:5px">${it.value.precio}<input type="hidden" value="${it.value.precio}" name="precio" id="precio"></td>
                        <td style="padding:5px"><input type="number" name="cantidad" id="cantidad"/></td>
                        <td style="padding:5px"><input type="submit" name="aniadir" id="aniadir" value="Añadir al carro"/></td>
                    </form>
                </tr>
            </c:forEach>
        </table>
        <div>
            <a href="listar_cesta.jsp"><button>Ver cesta</button></a>
            <a href="pedir.jsp"><button>Hacer pedido</button></a>
            <a href="ServletListaPedidos"><button>Mis pedidos</button></a>
        </div>        
    </body>
</html>
