<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@page contentType="text/html" pageEncoding="UTF-8"%>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <c:if test="${param.error!=null}">     
        <script type="text/javascript">
            alert("Usuario o contraseña incorrectos");
        </script>
        </c:if>
        
        <% if (request.getParameter("registrado")!=null) { %>
            <p style="color: green;">Usuario registrado</p>
        <%}%>
        
        <h1>LOGIN</h1>
        <form method="POST" action="ServletLogin">
            <table>
                <tr><th>Usuario</th><td><input type="text" name="usuario" value=""required/></td></tr>
                <tr><th>Contraseña</th><td><input type="password" name="password" value="" required/></td></tr>
            </table>
            <p>
                <input type="submit" name="submitLogin" value="LOGIN"/>
                <a href="registro.jsp">REGISTRARSE</a>
            </p>
        </form>
    </body>
</html>
