/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlets;

import beans.AlmacenMensajes;
import beans.Mensaje;
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;


public class ServletNuevoMensaje extends HttpServlet {

    
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            /* TODO output your page here. You may use following sample code. */
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet ServletNuevoMensaje</title>");            
            out.println("</head>");
            out.println("<body>");
            out.println("<h1>Servlet ServletNuevoMensaje at " + request.getContextPath() + "</h1>");
            out.println("</body>");
            out.println("</html>");
        }
    }

    
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.sendRedirect("nuevomensaje.html");
    }

    
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        if (request.getParameter("submitmensaje")!=null){
            
            String emisor=request.getParameter("emisor");
            String texto=request.getParameter("texto");
            Mensaje m=new Mensaje(emisor,texto);
            AlmacenMensajes.aniadirMensaje(m);
            
            response.sendRedirect("ServletVerMensajes?aniadido");
            
            
        }
        else{
             response.sendRedirect("nuevomensaje.html");
        }
       
    }

   

}
