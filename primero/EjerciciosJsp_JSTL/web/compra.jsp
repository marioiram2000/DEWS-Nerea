<%@page import="java.util.Map"%>
<%@page import="java.util.Iterator"%>
<%@page import="java.util.ArrayList"%>
<%@page import="java.util.HashMap"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Compra.jsp</title>
    </head>
    <body>
        <%
            
            
        %>
        <table>
            <tr><th>PRODUCTO</th><th>PEDIR</th></tr>
            <%
                HashMap<String, ArrayList> productos = (HashMap<String, ArrayList>)session.getAttribute("productos");
                Iterator it = productos.entrySet().iterator();
                while(it.hasNext()){
                    Map.Entry e = (Map.Entry)it.next();
                    System.out.println(e.getKey()+ " " + e.getValue());
                }
            %>
        </table>
    </body>
</html>
