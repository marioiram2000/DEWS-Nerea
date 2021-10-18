package servlets;
import beans.Persona;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;


public class ServletInicio extends HttpServlet {

    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        ArrayList<Persona> personas = new ArrayList<Persona>();
        personas.add(new Persona("mario", 20, new String[]{"Cocina", "Videojuegos", "Alcohol"}));
        personas.add(new Persona("Salama", 21, new String[]{"Comer", "Videojuegos", "Rezar"}));
        personas.add(new Persona("Ibai", 21, new String[]{"Basket", "Videojuegos", "Basket"}));
        
        request.getSession().setAttribute("personas", personas);
        response.sendRedirect("listaPersonas.jsp");
        
    } 

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        response.sendError(403);
    }
}
