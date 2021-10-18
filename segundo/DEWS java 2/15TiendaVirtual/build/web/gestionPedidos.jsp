<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@page import="java.util.HashSet"%>
<%@page import="beans.Pedido"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <h1>GESTION DE PEDIDOS</h1>
        <form method="POST" action="ServletGestionPedidos">
            <table>
                <tr><th>Nº pedido</th><th>Cliente</th><th>Precio €</th><th>Enviado</th></tr>
                <%
                Pedido[][] pedidos = (Pedido[][])request.getSession().getAttribute("pedidos");
                for (int i = 0; i < pedidos[0].length; i++) {
                    out.print("<tr>");
                        Pedido pedido = pedidos[0][i];
                        out.print("<td>P "+pedido.getId()+"</td>");
                        out.print("<td>"+pedido.getCliente().getNombre()+"</td>");
                        out.print("<td>"+pedido.getTotal()+"</td>");
                        out.print("<td><input type='checkbox' name='enviar' value='"+pedido.getId()+"'></td>");
                    out.print("</tr>");
                }  

                %>
            </table>
                <input type="submit" name="submitEnviar" value="ENVIAR">
        </form>
        <table>
            <tr><th>Nº pedido</th><th>Cliente</th><th>Precio €</th><th>Recibido</th></tr>
            <%
            for (int i = 0; i < pedidos[1].length; i++) {
                out.print("<tr>");
                    Pedido pedido = pedidos[1][i];
                    out.print("<td>P "+pedido.getId()+"</td>");
                    out.print("<td>"+pedido.getCliente().getNombre()+"</td>");
                    out.print("<td>"+pedido.getTotal()+"</td>");
                    if(request.getSession().getAttribute("recibidos")!=null && ((HashSet<Integer>)request.getSession().getAttribute("recibidos")).contains(pedido.getId())){
                        out.print("<td><a href='ServletGestionPedidos?norecibido="+pedido.getId()+"'>Marcar como NO recibido</a></td>");
                    }else{
                        out.print("<td><a href='ServletGestionPedidos?recibido="+pedido.getId()+"'>Marcar como recibido</a></td>");
                    }
                    
                out.print("</tr>");
            }  
            %>
        </table>    
            <c:if test="${sessionScope.recibidos != null && sessionScope.recibidos.size()>0}">
                <p><a href="ServletGestionPedidos?guardar">Guardar recibidos</a></p>
            </c:if>
        
    </body>
</html>
