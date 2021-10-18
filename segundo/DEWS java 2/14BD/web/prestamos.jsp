<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <h1>Libros:</h1>
        <form method="POST" action="ServletPrestamos">
            <table>
                <tr><th>Prestar</th><th>Titulo</th><th>Genero</th><th>Paginas</th><th>Prestamos</th></tr>
                <c:forEach items="${sessionScope.libros}" var="libro">
                    <tr>
                        <td><input type="checkbox" name="idlibros" value="${libro.idlibro}"></td>
                        <td>${libro.titulo}</td>
                        <td>${libro.genero}</td>
                        <td>${libro.paginas}</td>
                        <td>
                            <c:choose>
                                <c:when test="${sessionScope.cantPrestamos.get(libro.idlibro) eq 0}">
                                    Sin prestamos
                                </c:when>
                                <c:otherwise>
                                    <a href="prestamos.jsp?idlibro=${libro.idlibro}">${sessionScope.cantPrestamos.get(libro.idlibro)} veces</a>
                                    <c:if test="${param.idlibro == libro.idlibro}">
                                        <table>
                                            <tr><th>Fecha</th><th></th><th>Fecha Devolucion</th></tr>
                                        <c:forEach items="${sessionScope.mapaPrestamos.get(libro.idlibro)}" var="prestamo">
                                                <tr>
                                                    <td>${prestamo.strFecha()}</td>
                                                    <c:choose>
                                                        <c:when test="${prestamo.fechaDev!=null}"><td></td><td>${prestamo.strFecha()}</td></c:when>
                                                        <c:otherwise><td></td><td>No ha sido devuelto</td></c:otherwise>
                                                    </c:choose>
                                                    
                                                </tr>
                                        </c:forEach>
                                        </table>
                                    </c:if>
                                </c:otherwise>
                            </c:choose>
                        </td>
                        
                    </tr>
                </c:forEach>
                    <tr><td><input type="submit" name="submit" value="TOMAR PRESTADOOS"></td></tr>
            </table>
        </form>
    </body>
</html>
