<%@page import="beans.CarroCompra"%>
<%@page import="beans.LineaPedido"%>
<%@page import="org.apache.jasper.tagplugins.jstl.ForEach"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <h1>PEDIDO</h1>
        <form method="POST" action="ServletGrabarCompra">
        <table>
            <input type="hidden" value="${sessionScope.cliente.nombre}" name="nom">
            <tr><th>Nombre</th><td><input type="text" name="nombre" value="${sessionScope.cliente.nombre}" disabled></td></tr>
            <tr><th>ZIP</th><td><input type="text" name="zip" value="${sessionScope.cliente.codigopostal}"></td></tr>
            <tr><th>Dirección</th><td><input type="text" name="domicilio" value="${sessionScope.cliente.domicilio}"></td></tr>
            <tr><th>Telefono</th><td><input type="text" name="telefono" value="${sessionScope.cliente.telefono}"></td></tr>
            <tr><th>Email</th><td><input type="text" name="email" value="${sessionScope.cliente.email}"></td></tr>
        </table>
        <h1>Tu carro <a href="listarCesta.jsp">(editar carro)</a></h1>
        <table>
            <tr><th>Id</th><th>Nombre</th><th>Precio</th><th>Cant</th></tr>
            <%
            for (LineaPedido linea : ((CarroCompra)request.getSession().getAttribute("carro")).getLineasPedido()) {
                out.print("<tr>");
                    out.print("<td>"+linea.getItem().getId()+"</td>");
                    out.print("<td>"+linea.getItem().getNombre()+"</td>");
                    out.print("<td>"+linea.getItem().getPrecio()+"</td>");
                    out.print("<td>"+linea.getCantidad()+"</td>");
                out.print("</tr>");
            }   
            out.print("<td colspan='3'>TOTAL</td><td>"+((CarroCompra)request.getSession().getAttribute("carro")).total()+"</td>");
            %>
        </table>
        
        
        <input type="submit" name="submitGrabar" value="Comprar">
        
        </form>
        <form method="POST" action="tienda.jsp"><input type="submit" name="submitContinuar" value="Continuar la compra"></form>
    </body>
</html>
