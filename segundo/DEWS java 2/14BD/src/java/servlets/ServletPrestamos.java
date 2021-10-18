package servlets;
import beans.Libro;
import beans.Prestamo;
import dao.DaoBiblio;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.HashMap;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class ServletPrestamos extends HttpServlet {

    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        HashMap<Integer, ArrayList<Prestamo>> mapa = DaoBiblio.mapaPrestamos();
        request.getSession().setAttribute("mapaPrestamos", mapa);
        
        
        ArrayList<Libro> libros = dao.DaoBiblio.libros();
        HashMap<Integer, Integer> cantPrestamos = dao.DaoBiblio.mapCantidadPrestados();
        request.getSession().setAttribute("libros", libros);
        request.getSession().setAttribute("cantPrestamos", cantPrestamos);
        response.sendRedirect("prestamos.jsp");
        
        
    } 

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        
        if(request.getParameter("submit")!=null){
            String[] strIds=request.getParameterValues("idlibros");
            if(strIds!=null){
                int[] ids = new int[strIds.length];
                for (int i = 0; i < ids.length; i++) {
                    int id = Integer.parseInt(strIds[i]);
                    ids[i] = id;
                }
                DaoBiblio.prestarLibros(ids);
            }
        }
    }
}
