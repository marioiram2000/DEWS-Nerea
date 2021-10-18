<%@page import="java.util.HashSet"%>
<%@page import="beans.Empresa"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <%
        if(application.getAttribute("todasempresas")==null){
            application.setAttribute("todasempresas", new HashSet<Empresa>() );
        }
        
        HashSet<Empresa> todasEmpresas = (HashSet<Empresa>) application.getAttribute("todasempresas");
            
        if(request.getParameter("submitEmpresa")!=null){
            try{
                String nombre = request.getParameter("nombre");
                float beneficio = Float.parseFloat(request.getParameter("beneficio"));
                int maxTrab = Integer.parseInt(request.getParameter("maxTrab"));

                Empresa e = new Empresa(nombre, beneficio, maxTrab);
                if(!todasEmpresas.contains(e)){
                    session.setAttribute("empresa", e);
                    todasEmpresas.add(e);
                }
                
                
            }catch(NumberFormatException e){
                request.setAttribute("error", e);
                %>
                <jsp:include page="nuevaEmpresaError.jsp" />
                <%             
            }
        }
            if(request.getAttribute("noEmpresa")!=null){
                out.print("<p>"+request.getAttribute("noEmpresa")+"</p>");
            }
        %>
        <form method="POST" action="<%= request.getRequestURI() %>">
            <table>
                <tr>
                    <td>Nombre</td>
                    <td><input type="text" name="nombre" required></td>
                </tr>     
                <tr>
                    <td>Beneficio</td>
                    <td><input type="text" name="beneficio" required></td>
                </tr>    
                <tr>
                    <td>Máximo de trabajadores de la empresa</td>
                    <td><input type="text" name="maxTrab" required></td>
                </tr> 
                <tr>
                    <td colspan="2"><input type="submit" name="submitEmpresa" value="GUARDAR EMPRESA"></td>
                </tr>
            </table>
        </form>
            
        <%
        if(session.getAttribute("empresa")!=null){
            out.print("<p><a href='trabajadores.jsp'>Ver trabajadores</a></p>");
            out.print("<p>"+session.getAttribute("empresa").toString()+"</p>");
        }    
            
        %>
    </body>
</html>
