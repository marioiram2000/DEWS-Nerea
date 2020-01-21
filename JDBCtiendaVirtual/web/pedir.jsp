<%-- 
    Document   : pedir
    Created on : 21-ene-2020, 20:07:09
    Author     : mario
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <h1>PEDIDO</h1>
        <h2>TUS DATOS</h2>
        <form action="ServletGrabarCompra">
            <table border="1">
                <tr>
                    <th>Nombre</th><td><input type="text" name="nombre" id="nombre" disabled="true"/></td>
                    <th>ZIP</th><td><input type="text" name="zip" id="zip"/></td>
                    <th>DIRECCION</th><td><input type="text" name="direccion" id="direccion"/></td>
                    <th>TELEFONO</th><td><input type="text" name="telefono" id="telefono"/></td>
                    <th>E-mail</th><td><input type="text" name="email" id="email"/></td>
                </tr>
            </table>
            <h2>TU CARRO (<a href="listar_cesta.jsp"></a>)</h2>
            <table border="1">
                <tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Num</th></tr>
            </table>
            <div>
                <input type="submit" value="COMPRAR" name="submitComprar">
                <input type="reset" value="RESET">
                <a href="pedir.jsp"><button>MODIFICAR COMPRA</button></a>
            </div> 
        </form>
    </body>
</html>
