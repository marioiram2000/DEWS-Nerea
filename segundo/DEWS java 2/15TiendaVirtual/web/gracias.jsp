<%@page import="beans.Cliente"%>
<%@page import="beans.CarroCompra"%>
<%@page import="beans.LineaPedido"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <h1>Gracias por realizar su pedido</h1>
        <h2>Estos son los datps de su pedido</h2>
        <table>
            
            <tr><th>Nombre</th><td><%= ((Cliente)request.getSession().getAttribute("cliente")).getNombre() %></td></tr>
            <tr><th>ZIP</th><td><%= ((Cliente)request.getSession().getAttribute("cliente")).getCodigopostal()%></td></tr>
            <tr><th>Dirección</th><td><%= ((Cliente)request.getSession().getAttribute("cliente")).getDomicilio() %></td></tr>
            <tr><th>Telefono</th><td><%= ((Cliente)request.getSession().getAttribute("cliente")).getTelefono() %></td></tr>
            <tr><th>Email</th><td><%= ((Cliente)request.getSession().getAttribute("cliente")).getEmail()%></td></tr>
        </table>
        <h2>Es enviará con la mayor brevedad posible el siguiente pedido:</h2>
        <table>
            <tr><th>Nombre</th><th>Precio</th><th>Cant</th></tr>
            <%
            for (LineaPedido linea : ((CarroCompra)request.getSession().getAttribute("carro")).getLineasPedido()) {
                out.print("<tr>");
                    out.print("<td>"+linea.getItem().getNombre()+"</td>");
                    out.print("<td>"+linea.getItem().getPrecio()+"</td>");
                    out.print("<td>"+linea.getCantidad()+"</td>");
                out.print("</tr>");
            }   
            out.print("<td colspan='3'>"+((CarroCompra)request.getSession().getAttribute("carro")).total()+"</td>");
            %>
        </table>
        
    </body>
</html>
