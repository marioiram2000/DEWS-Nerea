<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <%
            if( request.getParameter("formato") != null && request.getParameter("formato").equalsIgnoreCase("excel")) {
                response.setContentType("application/vbd.ms-excel");
            }else{
                response.setContentType("text/html");
            }
            %>
        <h1>AAA</h1>
        <h1>BBB</h1>
        <h1>CCC</h1>
        <h1>DDD</h1>
        <h1>EEE</h1>
        <h1>FFF</h1>
    </body>
</html>
