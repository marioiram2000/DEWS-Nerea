<%@page import="java.text.SimpleDateFormat"%>
<%@page import="java.text.DateFormat"%>
<%@page import="java.util.HashSet"%>
<%@page import="beans.LineaPedido"%>
<%@page import="java.util.HashMap"%>
<%@page import="java.util.Map"%>
<%@page import="beans.Pedido"%>
<%@page import="beans.Pedido"%>
<%@page import="beans.Cliente"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <h1>TUS PEDIDOS</h1>
        <form method="POST" action="ServletPedidosCliente">
            <table>
                <tr><th>Id</th><th>Coste</th><th>Fehca</th><th>Detalles</th><th>Anular pedido</th></tr>
                <%
                HashMap<Integer, Pedido> pedidos = ((Cliente)request.getSession().getAttribute("cliente")).getPedidos();

                for (Map.Entry<Integer, Pedido> entry : pedidos.entrySet()) {
                    Integer idPedido = entry.getKey();
                    Pedido pedido = entry.getValue();
                    DateFormat formateador = new SimpleDateFormat("dd-MM-yyyy");
                    
                    out.print("<tr>");
                        out.print("<td>"+idPedido+"</td>");
                        out.print("<td>"+pedido.getTotal()+"€</td>");
                        out.print("<td>"+formateador.format(pedido.getFecha())+"</td>");
                        out.print("<td><p><a href='listarPedidosCliente.jsp?idpedido="+idPedido+"'>Detalles del pedido</a></p>");
                        if(request.getParameter("idpedido")!=null && request.getParameter("idpedido").equals(idPedido+"")){
                            HashSet<LineaPedido> lineas = pedido.getLineas();
                            for (LineaPedido linea : lineas) {
                                out.print("<p>"+linea.getId()+". "+linea.getItem().getNombre()+" ("+linea.getItem().getPrecio()+"€) "+linea.getCantidad()+" unidades"+"</p>");
                            }
                        }
                        out.print("</td>");
                        out.print("<td><input type='checkbox' name='anular' value='"+idPedido+"'></td>");
                    out.print("</tr>");
                }   

                %>
            </table>
            <input type="submit" name="submitAnularPedidos" value="ANULAR PEDIDOS MARCADOS">
        </form>
            <p><a href="tienda.jsp">Volver a la tienda</a></p>
    </body>
</html>
