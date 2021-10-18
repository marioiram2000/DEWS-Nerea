
package servlets;

import java.io.IOException;
import java.io.PrintWriter;
import java.util.HashMap;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

/**
 *
 * @author pei4
 */
public class ServletLogin extends HttpServlet {

    @Override
    public void init() throws ServletException {
        super.init();         
        this.getServletContext().setAttribute("mapa_logins", new HashMap<String,Integer>());
    }

    
    
    
    
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
        processRequest(request, response);
    }

   
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        
        if (request.getParameter("submitlogin")!=null){            
            
            //Atributo de sesion "usuario"
            HttpSession session = request.getSession();
            String usuario=request.getParameter("usuario");
            session.setAttribute("usuario", usuario);
            
            //Atributo de contexto/aplicacion "totallogins"
            
            
            HashMap<String,Integer> mapa=
                    ( HashMap<String,Integer>)
                    this.getServletContext().getAttribute("mapa_logins");
            
            if (!mapa.containsKey(usuario))
                mapa.put(usuario,1);
            else
                mapa.put(usuario, mapa.get(usuario) + 1);
            
            
            
            response.sendRedirect("ServletPrincipal");            
        }
        else{
            response.sendRedirect("index.html");
        }
        
    }

   

}
