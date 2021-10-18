
package servlets;

import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class ServletConversor extends HttpServlet {

    private double cf(double c){
        return c*9/5+32;
    }
    
    private double fc(double f){
        return (f-32)*5/9;
    }
    
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        String error = "";
        Double c = null;
        Double f = null;
        if(request.getParameter("cf")!=null){
            if(request.getParameter("c")!=""){
                c = Double.parseDouble(request.getParameter("c"));
                f = cf(c);
            }else{
                error = "Celsius";
            }
        }else if(request.getParameter("fc")!=null){
            if(request.getParameter("f")!=""){
                f = Double.parseDouble(request.getParameter("f"));
                c = cf(f);
            }else{
                error = "Faharenheit";
            }
        }else{
            response.sendError(403);
        }
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet ServletConversor</title>");  
            out.println("</head>");
            out.println("<body>");
            if(error!=""){
                out.println("<h1>ERROR: Debes indicar los grados "+error+"</h1>");
            }else{
                out.println("<h1>Resultado de la conversion:</h1>");
                out.println("<h3>Valor en celsius: "+c+"</h3>");
                out.println("<h3>Valor en faharenheit: "+f+"</h3>");
            }
            out.print("<p><a href='conversorCF.html'>Enlace para volver al formulario</a></p>");
            
            out.println("</body>");
            out.println("</html>");
        }
    } 

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        response.sendError(403);
    }

}
