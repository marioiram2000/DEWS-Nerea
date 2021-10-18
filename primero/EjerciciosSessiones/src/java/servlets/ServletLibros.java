package servlets;

import beans.Catalogo;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.Iterator;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

public class ServletLibros extends HttpServlet {

    Catalogo c = new Catalogo();
    String[] catalogo = c.getCatalogo();
    
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        HttpSession session = request.getSession(false);
        if(request.getParameter("eliminar")!=null && request.getParameter("eliminar").equals("eliminar")){
            if(session!=null){
                session.invalidate();
            }
        }     
        
        session = request.getSession(true);        
        session.setAttribute("elecciones", new ArrayList<>());
        
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet ServletLibros</title>");            
            out.println("</head>");
            out.println("<body>");
            out.println("<form method='POST' action='ServletLibros'>");
                out.println("<select name='libro' id='libro'>");
                    for (int i = 0; i < catalogo.length; i++) {
                        String str = catalogo[i];
                        out.println("<option value='"+str+"'>"+str+"</option>");
                    }                    
                out.println("</select>");
                out.println("<input type='submit' name='enviar' value='AGREGAR'>");
            out.println("</form>");
            out.println("<h1>No se han elegido libros</h1>");
            out.println("</body>");
            out.println("</html>");
        }
    }

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        
        String libroElegido = request.getParameter("libro");
        HttpSession session = request.getSession();
        ArrayList<String> elecciones = (ArrayList<String>) session.getAttribute("elecciones");
        if(elecciones.indexOf(libroElegido)<0){
            elecciones.add(libroElegido);
        }
        try (PrintWriter out = response.getWriter()) {
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet ServletLibros</title>");            
            out.println("</head>");
            out.println("<body>");
            out.println("<form method='POST' action='ServletLibros'>");
                out.println("<select name='libro' id='libro'>");
                    for (int i = 0; i < catalogo.length; i++) {
                        String str = catalogo[i];
                        if(str.equals(libroElegido)){
                            out.println("<option value='"+str+"' selected=\"selected\">"+str+"</option>");
                        }else{
                            out.println("<option value='"+str+"'>"+str+"</option>");
                        }                        
                    }                    
                out.println("</select>");
                out.println("<input type='submit' name='enviar' value='AGREGAR'>");
            out.println("</form>");
            out.println("<h1>Tu eleccion:</h1><ul>");
            for (Iterator<String> it = elecciones.iterator(); it.hasNext();) {
                String next = it.next();
                out.println("<li>"+next+"</li>");
            }
            out.println("</ul>");
            out.println("<a href='ServletLibros?eliminar=eliminar'>Eliminar todo</a>");
            out.println("</body>");
            out.println("</html>");
        }
    }
    
}
