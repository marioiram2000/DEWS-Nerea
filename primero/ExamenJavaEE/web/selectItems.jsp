<%-- 
    Document   : selectItems
    Created on : 23-ene-2020, 10:16:31
    Author     : dw2_alum4
--%>

<%@page import="beans.Item"%>
<%@page import="java.util.Iterator"%>
<%@page import="java.util.HashSet"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>selectItems</title>
    </head>
    <body>
        <h1>Introduce rango de precios</h1>
        <form action="ServletItemsPrecio" method="POST">
            <p>entre <input type="text" name="min" value="<% out.print(session.getAttribute("precioMin")); %>"> y 
                <input type="text" name="max" value="<% out.print(session.getAttribute("precioMax")); %>">€
            <input type="submit" name="submit" value="Var items con ventas"> </p>
        </form>
        <p style="color:red">
            <% 
            if(request.getAttribute("error")!=null){
                out.print(request.getAttribute("error"));
            } %>
        </p>
        <% out.print("Minimo: "+session.getAttribute("precioMin")); %>
        <% out.print("Maximo "+session.getAttribute("precioMax")); %>
        
        
        <%@ include file="tablaitems.jsp"%>
    </body>
</html>
