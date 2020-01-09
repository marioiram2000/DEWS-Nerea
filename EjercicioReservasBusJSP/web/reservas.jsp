<%@page import="java.util.ArrayList"%>
<%@page import="beans.Ruta"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <table border="1">
            <thead>
                <tr>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Bus</th>
                    <th>Tarifa</th>
                </tr>
            </thead>
            <tbody>
                <%
                    ArrayList<Ruta> rutas = (ArrayList<Ruta>)session.getAttribute("rutas");
                    if(rutas.size()<1){
                        System.out.println("EL TAMAÑO ES "+rutas.size());
                    }
                    %>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

    </body>
</html>
