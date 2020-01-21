<%-- 
    Document   : listar_cesta
    Created on : 21-ene-2020, 18:43:36
    Author     : mario
--%>

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
            <c:forEach items="${sessionScope.carroCompra}" var="carro">
                <tr>
                    <form action="ServletAgregarLineaPedido" method="POST">
                        <td style="padding:5px">${carro.value.getLinea}<input type="hidden" value="${it.key}" name="id"></td>
                        <td style="padding:5px">${it.value.nombre}<input type="hidden" value="${it.value.nombre}" name="nombre" ></td>
                        <td style="padding:5px">${it.value.precio}<input type="hidden" value="${it.value.precio}" name="precio" ></td>
                        <td></td>
                        <td style="padding:5px"><input type="submit" name="borrar" value="BORRAR ITEM"/><input type="submit" name="cambiar" value="CAMBIAR CANTIDAD"/></td>
                    </form>
                </tr>
            </c:forEach>            
           
        </table>
        <div>
            <a href="ServletVaciarCesta"><button>VACIAR CESTA</button></a>
            <a href="tienda.jsp"><button>CONTINUAR LA COMPRA</button></a>
            <a href="pedir.jsp"><button>HACER PEDIDO</button></a>
        </div> 
    </body>
</html>
