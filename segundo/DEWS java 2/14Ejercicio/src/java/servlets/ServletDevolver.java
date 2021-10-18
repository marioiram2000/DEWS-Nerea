package servlets;
import beans.Prestamo;
import dao.Dao;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class ServletDevolver extends HttpServlet {

    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        HashMap<Integer, Boolean> devueltos = (HashMap<Integer, Boolean>) request.getSession().getAttribute("devueltos");
        if(request.getParameter("marcardevolucion")!=null){
            devueltos.put(Integer.parseInt(request.getParameter("marcardevolucion")), Boolean.TRUE);
        }else if(request.getParameter("revertirdevolucion")!=null){
            devueltos.put(Integer.parseInt(request.getParameter("revertirdevolucion")), Boolean.FALSE);
        }else if(request.getParameter("gravardevoluciones")!=null){
            for (Map.Entry<Integer, Boolean> entry : devueltos.entrySet()) {
                Integer key = entry.getKey();
                Boolean value = entry.getValue();
                if(value){
                    dao.Dao.devolverLibro(key);
                }
            }
            ArrayList<Prestamo> prestamos = Dao.getPrestamosSinDevolver();
            devueltos = new HashMap<>();
            for (Prestamo prestamo : prestamos) {
                devueltos.put(prestamo.getIdprestamo(), Boolean.FALSE);
            }
            request.getSession().setAttribute("prestamos", prestamos);
            request.getSession().setAttribute("devueltos", devueltos);
        }else{
            ArrayList<Prestamo> prestamos = Dao.getPrestamosSinDevolver();
            devueltos = new HashMap<>();
            for (Prestamo prestamo : prestamos) {
                devueltos.put(prestamo.getIdprestamo(), Boolean.FALSE);
            }
            request.getSession().setAttribute("prestamos", prestamos);
            request.getSession().setAttribute("devueltos", devueltos);
        }
        
        
        int algundevueto = 0;
        for (Map.Entry<Integer, Boolean> entry : devueltos.entrySet()) {
            Integer key = entry.getKey();
            Boolean value = entry.getValue();
            if(value){
                algundevueto++;
            }
        }
        request.getSession().setAttribute("algundevueto", algundevueto);
        response.sendRedirect("devoluciones.jsp");
    } 

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        response.sendError(403);
    }
}
