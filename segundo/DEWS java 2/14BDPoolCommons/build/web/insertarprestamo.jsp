<%@page import="beans.Prestamo"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <%
            if(request.getAttribute("prestamo")!=null){
                out.print("Se ha insertado el prestamo del libro"+((Prestamo)request.getAttribute("prestamo")).getIdlibro());
            }
            %>
        <form method="POST" action="ServletPrueba">
            <p>Fecha<input type="text" name="fecha"></p>
            <p>Fecha Devolucion<input type="text" name="fechadev"></p>
            <p>id Libro<input type="text" name="idlibro"></p>
            <p><input type="submit" name="submit" value="Insertar libro"</p>
        </form>
    </body>
</html>