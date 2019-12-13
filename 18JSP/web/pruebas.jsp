<%-- 
    Document   : pruebas
    Created on : 13-dic-2019, 10:09:30
    Author     : dw2_alum4
--%>

<%@page import="java.io.IOException"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
        <%! 
            int accesos =0; 
            void tabla (JspWriter out, int numero){
                for (int i = 0; i < 10; i++) {
                    try{
                        out.println("<p>"+numero+" x "+i+" = "+(numero*i)+"</p>");
                    }catch(IOException e){

                    }
                }
            }
        %>
    </head>
    <body>
        <h1>Extensiones JSP</h1>
        <ul>
            <li><%= new java.util.Date()%></li>
            <li>IP remota<%= request.getRemoteAddr() %></li>
            <li>Id sesion: <%= session.getId() %></li>
            <li>Ultimo acceso: <%= session.getLastAccessedTime() %></li>
            <li>Parametro: <%= request.getParameter("nombre") %></li>
        </ul>
        
        <h2>Saludar</h2>
        <% if(Math.random()<0.5){ %>
            <p>Buenos días</p>
        <%}else{%>
            <p>Días buenos</p>
        <%}%>
        
        <h2>Acceso nº <%= accesos++ %></h2>
        
        <h2>Tabla del 5</h2>
        <% tabla(out, 5); %>
        
        
        <%  /*
            String formato= request.getParameter("formato");
            if(formato!=null && formato.equalsIgnoreCase("excel")){
                response.setContentType("application/vnd.ms-excel");
            }else{
                response.setContentType("text/plain");
            }
            */
        %>
        <h2>Cambiar tipo de respuesta</h2>
        <table>
            <tr>
                <td>1-1</td>
                <td>1-2</td>                
                <td>1-3</td>                
            </tr>
            <tr>
                <td>2-1</td>
                <td>2-2</td>                
                <td>2-3</td>                
            </tr>
        </table>
        
        <h2>Incluir páginas</h2>
        <% String micolor = "red"; %>
        <%@include file="incluida_directiva.jsp" %>
        <jsp:include page="incluida_accion.jsp" />
    </body>
</html>
