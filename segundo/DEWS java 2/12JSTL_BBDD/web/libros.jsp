<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
    <c:if test="${sessionScope.libros==null}">
        <jsp:forward page="ServletLibros"/>
    </c:if>
    <c:forEach  items="${sessionScope.libros}" var="libro">
        <p>
            <a href="libros.jsp?idlibro=${libro.idlibro}"> ${libro.titulo}</a>
            <c:if test="${param.idlibro==libro.idlibro}">
                &nbsp; ${libro.genero}
            </c:if>
        </p>
    </c:forEach>
        
    <h2>INSERTAR NUEVO LIBRO</h2>
    <form method="POST" action="ServletLibros">
        <p>Titulo: <input type="text" name="titulo" required value="${param.titulo}"/></p>
        <p>Páginas: <input type="text" name="paginas" required value="${param.paginas}"/></p>
        <p>Género: <input type="text" name="genero" required value="${param.genero}"/></p>
        <p>Autor: 
            <select name="autor" required > 
                <c:forEach items="${sessionScope.autores}" var="autor">
                    <option value="${autor.key}">${autor.value.nombre}</option>
                </c:forEach>
            </select>
        </p>
        <p><input type="submit" name="submitInsertarLibro" value="INSERTAR LIBRO"></p>
    </form>
    <c:if test="${requestScope.errorInsercion != null}">
        <p style="color: red;">${requestScope.errorInsercion}</p>
    </c:if>
    </body>
</html>
