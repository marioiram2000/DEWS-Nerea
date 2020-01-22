<%-- 
    Document   : listarPedidosCliente
    Created on : 22-ene-2020, 21:07:30
    Author     : mario
--%>

<%@page import="java.util.Iterator"%>
<%@page import="java.util.Map"%>
<%@page import="beans.Pedido"%>
<%@page import="beans.Cliente"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>listarPedidosCliente</title>
    </head>
    <body>
        <h1>TUS PEDIDOS</h1>
        <table border="1">
            <form action="#" method="POST">
            <tr>
                <th>ID</th><th>Costo</th><th>Fecha</th><th>Detalles</th><th>Anular pedido</th>
            </tr>
            <%
                    Cliente c = (Cliente)session.getAttribute("cliente");
                    Map<Integer,Pedido> pedidos = c.getPedidos();
                    
                    for (Map.Entry<Integer, Pedido> entrySet : pedidos.entrySet()) {
                        Integer idPedido = entrySet.getKey();
                        Pedido pedido = entrySet.getValue();
                        %>
                        <tr>
                            <td><% out.print(idPedido); %></td>
                            <td><% out.print(pedido.getTotal()); %></td>
                            <td><% out.print(pedido.getFecha()); %></td>
                            <td><a href="listarPedidosCliente?id=<% out.print(idPedido); %>">Detalles del pedido</a></td>
                            <td><input type="checkbox" value="<% out.print(idPedido); %>" name="anular[]"/></td>
                        </tr>      
                
                <%
                    }
                %>
                <tr><td colspan="5"><input type="submit" name="anular" value="ANULAR PEDIDOS MARCADOS"></td></tr>
            </form>
        </table>
                <a href="tienda.jsp">VOLVER A LA TIENDA</a>
    </body>
</html>
