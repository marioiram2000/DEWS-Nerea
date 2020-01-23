<%-- 
    Document   : index.jsp
    Created on : 23-ene-2020, 9:48:14
    Author     : dw2_alum4
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <%
            if(request.getParameter("entrar")!=null){
                //request.getRequestDispatcher("ServletItemsPrecio");
                if(request.getParameter("radio")!=null){
                    
                    if(request.getParameter("radio").equals("incidencias")){
                        request.getRequestDispatcher("ServletIncidencias").forward(request, response);
                    }else{
                        request.getRequestDispatcher("ServletItemsPrecio").forward(request, response);
                    }
                }
                
            }
            %>
        <form action="index.jsp" method="GET">
            <hr><hr>              
            <input type="radio" value="items" name="radio" id="items">
            <label for="items">Ver items vendidos(por precio)</label>
            <br>
            <input type="radio" value="incidencias" name="radio" id="incidencias">
            <label for="incidencias">Ver Incidencias de pedidos</label>
            <br><br>
            <input type="submit" value="ENTRAR" name="entrar">      
            <hr><hr>
        </form>
        
    </body>
</html>
