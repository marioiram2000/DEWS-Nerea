<%-- 
    Document   : libros
    Created on : 17-dic-2019, 13:29:21
    Author     : pei4
--%>
<%@taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <c:if test="${sessionScope.libros==null}">            
            <jsp:forward page="ServletLibros" />
        </c:if>
        
        
        <c:forEach items="${sessionScope.libros}" var="titulo" >
            <p>${titulo}</p>
        </c:forEach>
    </body>
</html>
