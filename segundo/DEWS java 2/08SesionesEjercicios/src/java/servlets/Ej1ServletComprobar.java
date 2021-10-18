
package servlets;

import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;


public class Ej1ServletComprobar extends HttpServlet {

    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        response.sendError(403);
    } 

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        HttpSession s = request.getSession();
        String palabra = request.getParameter("palabra");
        if(palabra.equals(s.getAttribute("palabra"))){
            response.sendRedirect("Ej1ServletJuego?correcto=si");
        }else{
            response.sendRedirect("Ej1ServletJuego?correcto=no");            
        }
    }
}
