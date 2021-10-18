<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Reservas</title>
    </head>
    <body>
        <c:if test="${requestScope.numreservas!=null}">
            <p>Acabas de reservar ${requestScope.numreservas} libros</p>
        </c:if>
        
        
        <table>
            <c:forEach items="${sessionScope.mapaAutores}" var="par">
                <tr>
                    <form method="POST" action="ServletReserva">
                        <td>${par.key.nombre}</td>
                        <td>
                            <c:choose>
                                <c:when test="${par.value.size()==0}">
                                    Sin libros
                                </c:when>
                                <c:otherwise>
                                    <select name="idlibro">
                                        <c:forEach items="${sessionScope.mapaAutores.get(par.key)}" var="libro">
                                            <option value="${libro.idlibro}">${libro.titulo}</option>
                                        </c:forEach>
                                    </select>
                                </c:otherwise>
                            </c:choose>
                        </td>
                        <td>
                            <c:if test="${par.value.size()>0}">
                                <input type="submit" name="submit_reserva" value="Reservar"/>
                            </c:if>
                        </td>
                    </form>
                </tr>
            </c:forEach>
        </table>
        
        <c:if test="${sessionScope.reservados!=null}">
            <ul>
                <c:forEach items="${sessionScope.reservados}" var="idreservado">
                    <li>${idreservado}</li>
                </c:forEach>
            </ul>
            <p><a href="ServletReserva?reservar">RESERVAR</a></p>
        </c:if>
        
    </body>
</html>
