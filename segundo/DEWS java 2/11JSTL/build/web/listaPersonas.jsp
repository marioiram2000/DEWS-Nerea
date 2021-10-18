<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <c:if test="${sessionScope.personas==null}">
            <jsp:forward page="ServletInicio"/>
        </c:if>
        <table>
            <tr><th>Nombre</th><th>Edad</th></tr>
        <c:forEach items="${sessionScope.personas}" var="persona">
            <tr>
                <td>${persona.nombre}</td>
                <td>${persona.edad}</td>
                <c:forEach items="${persona.aficiones}" var="aficion">
                    <td>${aficion}</td>
                </c:forEach>
            </tr>
        </c:forEach>
        </table>
    </body>
</html>
