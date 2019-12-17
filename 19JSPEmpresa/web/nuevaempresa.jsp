<%-- 
    Document   : nuevaempresa
    Created on : 13-dic-2019, 11:52:11
    Author     : pei4
--%>

<%@page import="beans.Empresa"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        
        <%
            
            if (request.getParameter("submit_empresa")!=null){
                
                    String nombre=request.getParameter("nombre");
                    float beneficio=Float.parseFloat(request.getParameter("beneficio"));
                    int max_trab=Integer.parseInt(request.getParameter("max_trabajadores"));
                    Empresa empresa=new Empresa(nombre, beneficio,max_trab);
                    session.setAttribute("empresa",empresa);
%>

                    <jsp:forward page="empresa.jsp" />
<%
            }

 %>
        
        
        
        
        
        
        <form method='post' action="<%= request.getRequestURI() %>">
        <table>
             <td colspan="2">
                  NUEVA EMPRESA
             </td>
               
            <tr>
                <td>Nombre</td>
                <td><input type='text' name='nombre' /></td>
            </tr>
            <tr>
                <td>Beneficio</td>
                <td><input type='text' name='beneficio' /></td>
            </tr>
            <tr>
                <td>Máximo de trabajadores</td>
                <td><input type='text' name='max_trabajadores' /></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type='submit' name='submit_empresa' value='CREAR EMPRESA' />
                </td>
               
            </tr>
            
        </table>
        </form>
    </body>
</html>
