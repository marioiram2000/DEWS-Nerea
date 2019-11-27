
package servlets;

import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class ServletLogin extends HttpServlet {

    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            /* TODO output your page here. You may use following sample code. */
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet ServletLogin</title>");            
            out.println("</head>");
            out.println("<body>");
            out.println("<h1>Servlet ServletLogin at " + request.getContextPath() + "</h1>");
            out.println("</body>");
            out.println("</html>");
        }
    }

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        String error = "";
        if(request.getParameter("error")!=null){
            error = "Contraseña erronea";
        }
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet ServletLogin</title>");            
            out.println("</head>");
            out.println("<body>");            
            out.println("<h1>Introduce la contraseña</h1>");
            out.println("<form method='post' action='ServletRedir'>");
            out.println("<input type='password' name='pass'/>");
            out.println(error);
            out.println("<input type='submit' name='submitlogin' value='ENTRAR'/>");
            out.println("</form>");
            out.println("</body>");
            out.println("</html>");
        }
        
    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
    }

    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

}
