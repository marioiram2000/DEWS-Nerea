
package servlets;

import beans.Catalogo;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

public class Ej0 extends HttpServlet {
   
    private Catalogo c;

    @Override
    public void init() throws ServletException {
        super.init(); //To change body of generated methods, choose Tools | Templates.
        c = new Catalogo();
    }
    
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        HttpSession s = request.getSession();
        if(s.getAttribute("elecciones")==null){
            s.setAttribute("elecciones", new ArrayList());
        }
        ArrayList<String> elecciones = (ArrayList<String>) s.getAttribute("elecciones");
        
        if(request.getParameter("submit")!=null){
            if(!elecciones.contains(request.getParameter("libro")))
                elecciones.add(request.getParameter("libro"));
        }
        
        String[] libros = c.getLibros();
        String anterior = "";
        if(request.getParameter("libro")!=null){
            anterior = request.getParameter("libro");
        }
        
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet Ej0</title>");  
            out.println("</head>");
            out.println("<body>");
            out.println("<h1>Ejercicio 0</h1>");
            out.println("<form method='GET' action='Ej0'>");
                out.println("<select name='libro'>");
                for (String libro : libros) {
                    String isSelected = "";
                    if(anterior.equals(libro)){
                        isSelected = "selected";
                    }
                    out.print("<option value='"+libro+"' "+isSelected+">"+libro+"</option>");
                }
                out.println("</select>");
                out.print("<input type='submit' value='Agregar' name='submit'>");
            out.println("</form>");
            if(elecciones.isEmpty()){
                out.println("<h2>No se han elegido libros</h2>");
            }else{
                out.println("<h2>Tu eleccion</h2>");
                out.print("<ul>");
                for (String eleccion : elecciones) {
                    out.print("<li>");
                    out.print(eleccion);
                    out.print("</li>");
                }
                out.print("</ul>");
            }
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
