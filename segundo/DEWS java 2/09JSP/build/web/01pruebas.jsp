<%@page import="java.util.Date"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <ul>
            <li>Fecha actual <%= new Date() %></li>
            <li>Remote IP <%= request.getRemoteAddr() %></li>
            <li>Id de la sesión <%= session.getId() %></li>
            <li>
                Parámetro saludo
                <%= (request.getParameter("saludo")==null)? "sin param": request.getParameter("saludo") %>
            </li>
            <li>
                <%
                    if(Math.random()<0.5){
                        %>Que pases un buen dia<%
                    }else{
                        %>Que te den por culo<%
                    }
                %>
            </li>
        </ul>
    </body>
</html>
