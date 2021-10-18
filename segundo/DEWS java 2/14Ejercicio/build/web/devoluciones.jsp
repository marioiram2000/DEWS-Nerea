<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <ol>
        <c:forEach items="${sessionScope.prestamos}" var="prestamo">
            <li>
                <table>
                    <tr>
                        <td>${prestamo.getTituloLibro()} ${prestamo.getDiasPrestado()}</td>
                        <td>
                            <c:choose>
                                <c:when test="${sessionScope.devueltos.get(prestamo.idprestamo) == true}">
                                    <a href="ServletDevolver?revertirdevolucion=${prestamo.idprestamo}">Revertir devolucion</a>
                                </c:when>
                                <c:otherwise>
                                    <a href="ServletDevolver?marcardevolucion=${prestamo.idprestamo}">Marcar devolucion</a>
                                </c:otherwise>
                            </c:choose>
                            
                        </td>
                    </tr>
                </table>
            </li>
        </c:forEach>
        </ol>
        <c:if test="${sessionScope.algundevueto > 0}">
            <a href="ServletDevolver?gravardevoluciones">GRABAR DEVOLUCIONES ( ${sessionScope.algundevueto} libros)</a>
        </c:if>
    </body>
</html>