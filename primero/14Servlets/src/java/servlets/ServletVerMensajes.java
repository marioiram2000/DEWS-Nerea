
package servlets;

import beans.AlmacenMensajes;
import beans.Mensaje;
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class ServletVerMensajes extends HttpServlet {

   
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            /* TODO output your page here. You may use following sample code. */
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet ServletVerMensajes</title>");            
            out.println("</head>");
            out.println("<body>");
            out.println("<h1>Servlet ServletVerMensajes at " + request.getContextPath() + "</h1>");
            out.println("</body>");
            out.println("</html>");
        }
    }

   
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        String aniadido="";
        if (request.getParameter("aniadido")!=null)
            aniadido="Mensaje aniadido";
        
        
        if (request.getParameter("afavor")!=null){            
            int i=Integer.parseInt(request.getParameter("pos"));
            AlmacenMensajes.votoAFavor(i);
        }
        
        if (request.getParameter("encontra")!=null){            
            int i=Integer.parseInt(request.getParameter("pos"));
            AlmacenMensajes.votoEnContra(i);
        }
        
        
         response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            /* TODO output your page here. You may use following sample code. */
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet ServletVerMensajes</title>");            
            out.println("</head>");
            out.println("<body>");
            out.println("<p>"+aniadido+"</p>");
            out.println("<table>");
            out.println("<tr><th>Emisor</th><th>Mensaje</th>"
                    + " <th>A favor</th><th>En contra</th><th>Votar a favor"
                    + "</th><th>Votar en contra</th>");
            for (int i=0; i<AlmacenMensajes.tamAlmacen(); i++){                
                Mensaje m=AlmacenMensajes.dameMensaje(i);
                out.println("<tr>");
                out.println("<td>"+m.getEmisor()+"</td>");
                out.println("<td>"+m.getTexto()+"</td>");
                out.println("<td>"+m.getaFavor()+"</td>");
                out.println("<td>"+m.getEnContra()+"</td>");
                
                String enlace1=request.getRequestURI()+"?pos="+i + "&afavor";
                String enlace2=request.getRequestURI()+"?pos="+i + "&encontra";
                String carpe=this.getServletContext().getInitParameter("carpeta_img");                
                
                
                out.println("<td><a href='"+enlace1+"'><img height='20' src='"+carpe+"up.jfif'/></a></td>");
                out.println("<td><a href='"+enlace2+"'><img height='20' src='"+carpe+"/down.png'/></a></td>");
                out.println("<td></td>");               
                
                out.println("<tr>");
            }
            out.println("</table>");
            
            
            
            out.println("</body>");
            out.println("</html>");
        }
        
        
        
        
        
        
        
        
        
        
        
        
        
    }

  
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
       doGet(request,response);
    }

}
