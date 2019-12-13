<%-- 
    Document   : e2grado
    Created on : 13-dic-2019, 11:17:39
    Author     : dw2_alum4
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
        <%
          if(request.getParameter("resolver")!=null){
              int a = Integer.parseInt(request.getParameter("a"));
              int b = Integer.parseInt(request.getParameter("b"));
              int c = Integer.parseInt(request.getParameter("c"));
              
              if(a==0){
                  //división entre cero
%>
                <jsp:include page="e2grado_error.jsp">
                    <jsp:param name="error" value="No es ecuacion de 2. grado"/>
                </jsp:include>
<%
              }else if((b*b - 4*a*c)<0){
                  //Error: soluciones complejas
%>
                <jsp:include page="e2grado_error.jsp">
                    <jsp:param name="error" value="Soluciones imaginarias"/>
                </jsp:include>
<%                  
                  
              }else{
                  //Bien
%>
                <jsp:include page="e2grado_solucion.jsp"/>
<%
                  
              }
          }  
        %>
    </head>
    <body>
        <h1>Ecuación de segundo grado</h1>
        <form action="post" action="<%= request.getRequestURI() %>">
            <input type="number" name="a">x<sup>2</sup>+
            <input type="number" name="b">x+
            <input type="number" name="c"> = 0
            <p><input type="submit" name="submit" value="submit"/></p>
        </form>
    </body>
</html>
