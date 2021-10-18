package servlets;

import beans.Prestamo;
import dao.DaoBiblio;
import java.io.IOException;
import java.io.PrintWriter;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class ServletPrueba extends HttpServlet {

    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        response.sendRedirect("insertarprestamo.jsp");
    } 

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        if(request.getParameter("submit")!=null){
            try {
                int idLibro = Integer.parseInt(request.getParameter("idlibro"));
                String strFecha =  request.getParameter("fecha");
                String strFechaDev =  request.getParameter("fechadev");
                
                SimpleDateFormat formateador = new SimpleDateFormat("dd/MM/yyyy");
                java.util.Date fecha = formateador.parse(strFecha);
                java.util.Date fechaDev = formateador.parse(strFechaDev);
                
                Prestamo p = new Prestamo();
                p.setFecha(fecha);
                p.setFechaDev(fechaDev);
                
                boolean insertado = DaoBiblio.insertarPrestamo(p);
                if(insertado){
                    request.setAttribute("prestamo", p);
                }else{
                    request.setAttribute("prestamo", null);
                }
                
            } catch (ParseException ex) {
                Logger.getLogger(ServletPrueba.class.getName()).log(Level.SEVERE, null, ex);
            }
            
            request.getRequestDispatcher("insertarprestamo.jsp").forward(request, response);
        }
    }
}
