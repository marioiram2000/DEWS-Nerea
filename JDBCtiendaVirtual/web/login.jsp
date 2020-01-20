<%-- 
    Document   : login
    Created on : 16-ene-2020, 8:24:47
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
        <% if(request.getAttribute("error")!=null){ %>
            <script type="text/javascript">
                alert(" <% out.print(request.getAttribute("error")); %>")              
            </script>
        <% } %>
        
        <h1>LOGIN</h1>
        <form action="ServletLogin" method="POST">
            <table>
                <tr><td>Usuario</td><td><input type="text" name="username" id="username"></td></tr>
                <tr><td>Contraseña</td><td><input type="password" name="password" id="password"</td></tr>
            </table>
            <input type="submit" name="login" value="Login">
            <input type="reset" name="reset" value="Reset">
            <a href="registro.jsp">REGISTRARSE</a>            
        </form>
    </body>
</html>
