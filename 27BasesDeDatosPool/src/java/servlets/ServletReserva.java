package servlets;

import dao.DaoBiblio;
import java.io.IOException;
import java.util.HashSet;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

public class ServletReserva extends HttpServlet {

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        HttpSession session = request.getSession();
        
        if(request.getParameter("reservar")!=null){
            for(Integer idlibro : (HashSet<Integer>) session.getAttribute("reservados")){
                DaoBiblio.reservar(idlibro);
            }
            HashSet<Integer> reservados= (HashSet<Integer>) session.getAttribute("reservados");
            request.setAttribute("numreservas", reservados.size());
            session.removeAttribute("reservados");
            
            request.getRequestDispatcher("reservas.jsp").forward(request,response);
        }
        
        if(session.getAttribute("mapaAutores")==null)
            session.setAttribute("mapaAutores", DaoBiblio.mapaAutores());
        
        response.sendRedirect("reservas.jsp");
        
    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
       HttpSession session = request.getSession();
       if(request.getParameter("submit_reserva")!=null){
           
           if(session.getAttribute("reservados")==null){
               session.setAttribute("reservados",new HashSet<Integer>());
           }
           
           HashSet<Integer> reservados =(HashSet<Integer>) session.getAttribute("reservados");
           
           reservados.add(Integer.parseInt(request.getParameter("idlibro")));
           
           response.sendRedirect("reservas.jsp");
           
       }
    }

}
