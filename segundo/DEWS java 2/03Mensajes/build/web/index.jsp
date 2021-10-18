<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <h1>Nuevo mensaje</h1>
        <form action="ServletAniadirMensaje" method="POST">
            Emisor: <input type="text" name="emisor"/>
            Mensaje: <input type="text" name="texto"/>
            <input type="submit" name="submit" value="AÑADIR MENSAJE"/>
        </form>
    </body>
</html>
