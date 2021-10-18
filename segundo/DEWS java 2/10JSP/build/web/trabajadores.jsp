<%@page import="beans.Movil"%>
<%@page import="beans.Trabajador"%>
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
        
            
            
        if(session.getAttribute("empresa")==null){
            request.setAttribute("noEmpresa", "Debes crear una empresa");
        %>
            <jsp:forward page="nuevaempresa.jsp" />
        <%
        }
        Empresa e = (Empresa)session.getAttribute("empresa");
        

        if(request.getParameter("trabajar")!=null){
            e.trabajar();
        }
        if(request.getParameter("trabajarT")!=null){
            Trabajador[] trabajadores = e.getTrabajadores();
            int i = Integer.parseInt(request.getParameter("trabajarT"));
            trabajadores[i].trabajar();
        }
        if(request.getParameter("submitTrabajador")!=null){
                String nombre = request.getParameter("nombre");
                String dni = request.getParameter("dni");
                String numero = request.getParameter("numero");
                int bateria = Integer.parseInt(request.getParameter("bateria"));
                
                Trabajador t = new Trabajador(nombre, dni, 0, new Movil(numero, bateria));
                
                if(!e.contratar(t)){
                    out.print("<p>La empresa no admite más trabajadores</p>");
                }else{
                    Trabajador[] trabajadores = e.getTrabajadores();
                    out.print("<table border='1'>");
                    for (int i = 0; i < e.getTrabAct(); i++) {
                            out.print("<tr>");
                                out.print("<td>"+trabajadores[i].getNombre()+"</td>");
                                out.print("<td>"+trabajadores[i].getDni()+"</td>");
                                out.print("<td>"+trabajadores[i].getDinero()+"</td>");
                                out.print("<td>"+trabajadores[i].getMovil().getNumero()+"</td>");
                                out.print("<td>"+trabajadores[i].getMovil().getBateria()+"</td>");
                                String enlace = request.getRequestURI()+"?trabajarT="+i;
                                out.print("<td><a href='"+enlace+"'>TRABAJAR</a></td>");
                            out.print("</tr>");
                        }
                    out.print("</table>");
                    }

        }

        out.print("<p>"+e.toString()+"</p>");
        %>
        
        <form method="POST" action="<%= request.getRequestURI() %>">
            <table>
                <tr>
                    <td>Nombre</td>
                    <td><input type="text" name="nombre" required></td>
                </tr>     
                <tr>
                    <td>DNI</td>
                    <td><input type="text" name="dni" required></td>
                </tr>    
                <tr>
                    <td>Numero del movil</td>
                    <td><input type="text" name="numero" required></td>
                </tr> 
                <tr>
                    <td>Batería del telefono</td>
                    <td><input type="text" name="bateria" required></td>
                </tr> 
                <tr>
                    <td colspan="2"><input type="submit" name="submitTrabajador" value="GUARDAR EMPRESA"></td>
                </tr>
            </table>
        </form>
        <p><a href="<%= request.getRequestURI() %>?trabajar">TRABAJAR</a></p>
    </body>
</html>
