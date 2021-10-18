<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <%
            if(request.getParameter("submit")!=null){
                int a = Integer.parseInt(request.getParameter("a"));
                int b = Integer.parseInt(request.getParameter("b"));
                int c = Integer.parseInt(request.getParameter("c"));
                
                if(a==0){
%>
                <jsp:include page="04errores.jsp" >
                    <jsp:param name="error" value="No es una ecuación de 2º grado" />
                </jsp:include>
                
                <% } else if(b*b - 4*a*c < 0){ %>
                <jsp:include page="04errores.jsp" >
                    <jsp:param name="error" value="La solución son 2 imaginarios" />
                </jsp:include>
                <%    }
                    else{
                %>
                        <jsp:include page="04soluciones.jsp" /> 
                <%  }
            }
            %>
        
        <form method="POST" action="<%= request.getRequestURI() %>">
            <input type="text" name="a">x<sup>2</sup>
            +
            <input type="text" name="b"> x
            +
            <input type="text" name="c"> = 0
            <input type="submit" name="submit" value="SOLUCIONES">
        </form>
    </body>
</html>
