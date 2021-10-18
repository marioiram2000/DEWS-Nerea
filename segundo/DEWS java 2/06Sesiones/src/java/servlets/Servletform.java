package servlets;

import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class Servletform extends HttpServlet {

    private void dibujaFormularioArriba(HttpServletRequest request, HttpServletResponse response, PrintWriter out){
        out.println("<form method='POST' action='"+request.getRequestURI()+"'>");
            out.print("<input type='submit' name='submitNumero' value='Generar campos'/>");
            out.print("<label> con </label><input type='number' name='numero' value='5'/>");
        out.println("</form>");
    }
    
    private void dibujaFormularioAbajo(HttpServletRequest request, HttpServletResponse response, PrintWriter out){
        out.println("<form method='POST' action='ServletGrabar'>");
            out.print("<table>");
            out.print("<tr><th>Num</th><th>Comida</th><th>Precio</th></tr>");
            for (int i = 1; i <= Integer.parseInt(request.getParameter("numero")); i++) {
                out.print("<tr>");
                    out.print("<td>Comida"+i+"</td>");
                    out.print("<td><input type='text' name='nombres' value=''></td>");
                    out.print("<td><input type='number' name='precios' value='1'></td>");
                out.print("</tr>");
            }
            out.print("</table>");
            out.print("<input type='submit' name='submitGrabar' value='Grabar fichero'>");

        out.println("</form>");
    }
    
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
                try (PrintWriter out = response.getWriter()) {

                    out.println("<!DOCTYPE html>");
                    out.println("<html>");
                    out.println("<head>");
                    out.println("<title>Servlet Servletform</title>");  
                    out.println("</head>");
                    out.println("<body>");
                    dibujaFormularioArriba(request, response, out);
                    out.println("</body>");
                    out.println("</html>");
                }
    } 

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        if(request.getParameter("submitNumero")!=null){
            response.setContentType("text/html;charset=UTF-8");
            try (PrintWriter out = response.getWriter()) {

                out.println("<!DOCTYPE html>");
                out.println("<html>");
                out.println("<head>");
                out.println("<title>Servlet Servletform</title>");  
                out.println("</head>");
                out.println("<body>");
                    dibujaFormularioArriba(request, response, out);
                    dibujaFormularioAbajo(request, response, out);
                out.println("</body>");
                out.println("</html>");
            }
        }
    }
}
