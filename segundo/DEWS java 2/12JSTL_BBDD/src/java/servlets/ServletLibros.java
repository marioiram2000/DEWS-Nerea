package servlets;
import beans.Autor;
import beans.Libro;
import dao.GestorBD;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.LinkedHashMap;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class ServletLibros extends HttpServlet {

    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        GestorBD gbd = new GestorBD();
        request.getSession().setAttribute("libros", gbd.libros());
        request.getSession().setAttribute("autores", gbd.autores());
        request.getRequestDispatcher("libros.jsp").forward(request, response);
    } 

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        if(request.getParameter("submitInsertarLibro")!=null){
            try{
                GestorBD gbd = new GestorBD();
                Libro l = new Libro(request.getParameter("titulo"), Integer.parseInt(request.getParameter("paginas")), request.getParameter("genero"), Integer.parseInt(request.getParameter("autor")));
                if(!gbd.insertLibro(l)){
                    request.setAttribute("errorInsercion", "Introduce datos correctos");
                }
            }catch(NumberFormatException e){
                request.setAttribute("errorInsercion", "Introduce datos correctos");
                
            }
        }
        doGet(request, response);
    }
}
