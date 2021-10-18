
package servlets;

import java.io.IOException;
import java.io.PrintWriter;
import java.util.Date;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;


public class Servlet2 extends HttpServlet {

    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        
    } 

    protected void doGet(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        HttpSession s = request.getSession();
        
        if(request.getParameter("fin")!=null && request.getParameter("fin").equals("si")){
            s.invalidate();
            s = request.getSession();
        }
        
        if(s.getAttribute("nombre")==null){
            response.sendRedirect("index.html");
        }else{
            long t1 = s.getCreationTime();
            Date d1 = new Date(t1);
            
            long t2 = s.getLastAccessedTime();
            Date d2 = new Date(t2);
            
            Date dif = new Date(t2-t1);
            
            response.setContentType("text/html;charset=UTF-8");
            try (PrintWriter out = response.getWriter()) {

                out.println("<!DOCTYPE html>");
                out.println("<html>");
                out.println("<head>");
                out.println("<title>Servlet Servlet2</title>");  
                out.println("</head>");
                out.println("<body>");
                    out.println("<h1>Buenos días " + s.getAttribute("nombre") + "</h1>");
                    out.println("<h2>Tu ID de sesion es:" + s.getId()+ "</h2>");
                    out.println("<h2>Sesion creada en " + d1.toString() + "</h2>");
                    out.println("<h2>Sesion accedida por ultima vez" + d2.toString() + "</h2>");
                    out.println("<h2>Y llevas conectado " + dif.getMinutes() + "Minutos y " + dif.getSeconds()+ " segundo</h2>");
                    String enlace = request.getRequestURI();
                    out.print("<p><a href='"+enlace+"?fin=no'>Refrescar</a></p>");
                    out.print("<p><a href='"+enlace+"?fin=si'>Acabar sesión</a></p>");
                out.println("</body>");
                out.println("</html>");
            }
        }
        
    } 

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        response.sendError(403);
    }
}
