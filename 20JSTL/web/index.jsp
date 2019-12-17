<%-- 
    Document   : index
    Created on : 17-dic-2019, 12:49:39
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
        <c:if test="${param.user=='admin'}">
            <p>Egunon, admin</p>            
        </c:if>
            
        <c:if test="${requestScope.trabajadores.size()==0}">
            <p>Empresa sin trabajadores</p>            
        </c:if>
         <c:if test="${requestScope.trabajadores.size()>0}">
               <table>
                    <c:forEach items="${requestScope.trabajadores}" var="trab">
                        <tr>
                            <td><c:out value="${trab.nombre}" /></td>
                            <td>${trab.dinero} €</td>
                            <td>${trab.movil.numero} €</td>
                        </tr>           

                    </c:forEach>                
                </table>       
        </c:if>    
            
            
             
            
    </body>
</html>
