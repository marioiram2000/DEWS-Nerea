<%@page import="java.util.Map"%>
<%@page import="java.util.HashMap"%>
<%@page import="java.util.ArrayList"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
        <%
            HashMap<String, Integer> carro = (HashMap<String, Integer>) session.getAttribute("carro");
            if(carro == null){
                session.setAttribute("carro", new HashMap<String, Integer>());
                carro = (HashMap<String, Integer>) session.getAttribute("carro");
            }
            if(request.getParameter("submitPedir")!=null){
                String p = request.getParameter("producto");
                if(carro.containsKey(p)){
                    carro.put(p, carro.get(p)+1);
                }else{
                    carro.put(p, 1);
                }
            }
            %>
    </head>
    <body>
        <h1>Hello World!</h1>
        <table>
            <tr><th>PRODUCTO</th><th>PEDIR</th></tr>
            <%
                if(session.getAttribute("productos")!=null){
                    ArrayList<String> productos =  (ArrayList<String>) session.getAttribute("productos");
                    for (Object producto : productos) {
                            out.print("<tr>"
                                        + "<form method='POST' action='"+request.getRequestURI()+"'>"
                                            + "<td>"+producto+"</td>"
                                            + "<td><input type='submit' name='submitPedir' value='PEDIR'></td>");
                            if(carro.containsKey(producto)){
                                            out.print("<td>"+carro.get(producto)+" unidades</td>");
                            }
                                    out.print("<input type='hidden' value='"+producto+"' name='producto'>"
                                        + "</form>"
                                    + "</tr>");
                        }
                }
                %>
        </table>
        <%
        if(carro!=null){
            out.print("<ul>");
            for (Map.Entry<String, Integer> en : carro.entrySet()) {
                    Object key = en.getKey();
                    Object val = en.getValue();
                    out.print("<li><strong>"+key+"</strong>: "+val+" unidades</li>");
                }
            out.print("</ul>");
        }
        %>
    </body>
</html>
